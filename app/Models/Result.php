<?php

namespace App\Models;

use App\Enums\PlayerEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_1_id',
        'player_2_id',
        'player_1_score',
        'player_2_score',
        'winner',
        'date',
    ];

    protected $casts = [
        'winner' => PlayerEnum::class,
    ];

    /**
     * The Player 1 the result belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function playerOne(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'player_1_id');
    }

    /**
     * The Player 2 the result belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function playerTwo(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'player_2_id');
    }

    /**
     * Return result that has highest score
     * @return mixed
     */
    public static function highestScore(): mixed
    {
        $highestPlayerOneScore = Result::with(['playerOne', 'playerTwo'])->orderByDesc('player_1_score')->first();
        $highestPlayerTwoScore = Result::with(['playerOne', 'playerTwo'])->orderByDesc('player_2_score')->first();

        if (!empty($highestPlayerOneScore) && !empty($highestPlayerTwoScore)) {
            if ($highestPlayerOneScore->player_1_score > $highestPlayerTwoScore->player_2_score) {
                return $highestPlayerOneScore;
            } else {
                return $highestPlayerTwoScore;
            }
        }

        return null;
    }

    /**
     * Return result that has lowest score
     * @return mixed
     */
    public static function lowestScore(): mixed
    {
        $highestPlayerOneScore = Result::with(['playerOne', 'playerTwo'])->orderBy('player_1_score')->first();
        $highestPlayerTwoScore = Result::with(['playerOne', 'playerTwo'])->orderBy('player_2_score')->first();

        if (!empty($highestPlayerOneScore) && !empty($highestPlayerTwoScore)) {
            if ($highestPlayerOneScore->player_1_score > $highestPlayerTwoScore->player_2_score) {
                return $highestPlayerTwoScore;
            } else {
                return $highestPlayerOneScore;
            }
        }

        return null;
    }
}
