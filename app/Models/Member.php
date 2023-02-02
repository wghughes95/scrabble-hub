<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection as SupportCollection;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile_no',
        'joined',
    ];

    /**
     * Results where member is player 1
     * @return \Illuminate\Database\Eloquent\Collection|array<\Illuminate\Database\Eloquent\Builder>
     */
    public function resultsAsPlayerOne(): Collection | array
    {
        return Result::with('playerTwo')->where('player_1_id', $this->id)->get();
    }

    /**
     * Results where member is player 2
     * @return \Illuminate\Database\Eloquent\Collection|array<\Illuminate\Database\Eloquent\Builder>
     */
    public function resultsAsPlayerTwo(): Collection | array
    {
        return Result::with('playerOne')->where('player_2_id', $this->id)->get();
    }

    /**
     * Relationship for when member was player 1
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function playerOne(): HasMany
    {
        return $this->hasMany(Result::class, 'id', 'player_1_id');
    }

    /**
     * Relationship for when member was player 2
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function playerTwo(): HasMany
    {
        return $this->hasMany(Result::class, 'id', 'player_2_id');
    }

    /**
     * Returns collection of member's matches
     * @return Collection
     */
    public function allResults(): Collection
    {
        return $this->resultsAsPlayerOne()->merge($this->resultsAsPlayerTwo());
    }

    /**
     * Returns collection of member's wins
     * @return \Illuminate\Support\Collection
     */
    public function wins(): SupportCollection
    {
        $playerOne = $this->resultsAsPlayerOne();
        $playerTwo = $this->resultsAsPlayerTwo();
        $wins = [];

        foreach ($playerOne as $player) {
            if ($player->winner->value === 'Player 1') {
                $wins[] = $player;
            }
        }

        foreach ($playerTwo as $player) {
            if ($player->winner->value === 'Player 2') {
                $wins[] = $player;
            }
        }

        return collect($wins);
    }

    /**
     * Returns collection of member's losses
     * @return \Illuminate\Support\Collection
     */
    public function losses(): SupportCollection
    {
        $playerOne = $this->resultsAsPlayerOne();
        $playerTwo = $this->resultsAsPlayerTwo();
        $losses = [];

        foreach ($playerOne as $player) {
            if ($player->winner->value === 'Player 2') {
                $losses[] = $player;
            }
        }

        foreach ($playerTwo as $player) {
            if ($player->winner->value === 'Player 1') {
                $losses[] = $player;
            }
        }

        return collect($losses);
    }

    /**
     * Returns total amount of matches for member
     * @return int
     */
    public function totalMatchesPlayed(): int
    {
        return count($this->allResults());
    }

    /**
     * Returns total wins for member
     * @return int
     */
    public function totalWins(): int
    {
        return count($this->wins());
    }

    /**
     * Returns total losses for member
     * @return int
     */
    public function totalLosses(): int
    {
        return count($this->losses());
    }

    /**
     * Returns average score for member
     * @return float|int
     */
    public function averageScore(): float | int
    {
        $playerOne = $this->resultsAsPlayerOne();
        $playerTwo = $this->resultsAsPlayerTwo();

        $playerOneScore = 0;
        foreach ($playerOne as $player) {
            $playerOneScore += $player->player_1_score;
        }

        $playerTwoScore = 0;
        foreach ($playerTwo as $player) {
            $playerTwoScore += $player->player_2_score;
        }

        $totalScore = $playerOneScore + $playerTwoScore;
        $totalMatches = count($playerOne) + count($playerTwo);

        return $totalMatches !== 0 ? $totalScore / $totalMatches : 0;
    }

    /**
     * Get best result for member
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function bestResult(): Model|null
    {
        $maxPlayerOne = $this->resultsAsPlayerOne()->max('player_1_score');
        $maxPlayerTwo = $this->resultsAsPlayerTwo()->max('player_2_score');
        $highestScore = collect([$maxPlayerOne, $maxPlayerTwo])->max();
        $allResults = $this->allResults();
        $bestResult = null;

        if ($maxPlayerOne === $highestScore) {
            $bestResult = $allResults->where('player_1_score', $highestScore)->first();
        } else if ($maxPlayerTwo === $highestScore) {
            $bestResult = $allResults->where('player_2_score', $highestScore)->first();
        }

        return $bestResult;
    }

    /**
     * Get sorted collection of the top 10 average scores
     * @return SupportCollection
     */
    public static function getLeaderboard(): SupportCollection
    {
        $members = Member::all();
        $averageScores = [];

        foreach ($members as $member) {
            if ($member->totalMatchesPlayed() >= 10) {
                $averageScores[] = [
                    'name' => $member->name,
                    'averageScore' => $member->averageScore(),
                ];
            }
        }

        return collect($averageScores)->sortByDesc('averageScore')->take(10)->values();
    }
}
