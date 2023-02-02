<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps(['results', 'resultsCount', 'leaderboard', 'leaderboardCount', 'highestScore', 'lowestScore']);
</script>

<template>

    <Head title="Results" />

    <GuestLayout>
        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="mb-5">
                <a :href="route('results.create')"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Add New Result
                </a>
            </div>

            <h1 v-if="resultsCount > 0" class="font-medium leading-tight text-4xl mt-0 mb-2">Most Recent Results</h1>
            <table v-if="resultsCount > 0" class="table-auto border border-slate-500 text-center">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="w-60 border border-slate-600">Player 1</th>
                        <th class="w-60 border border-slate-600">Player 1 Score</th>
                        <th class="w-60 border border-slate-600">Player 2 Score</th>
                        <th class="w-60 border border-slate-600">Player 2</th>
                        <th class="w-60 border border-slate-600">Winner</th>
                        <th class="w-60 border border-slate-600">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="result in results" class="bg-white">
                        <td class="border border-slate-600 bg-white">
                            <a class="hover:font-bold" :href="route('members.show', [result.player_one.id])">
                                {{ result.player_one.name }}
                            </a>
                        </td>
                        <td class="border border-slate-600 bg-blue-200">
                            {{ result.player_1_score }}
                        </td>
                        <td class="border border-slate-600 bg-yellow-200">
                            {{ result.player_2_score }}
                        </td>
                        <td class="border border-slate-600 bg-white">
                            <a class="hover:font-bold" :href="route('members.show', [result.player_two.id])">
                                {{ result.player_two.name }}
                            </a>
                        </td>
                        <td class="border border-slate-600"
                            :class="result.winner === 'Player 1' ? 'bg-blue-200' : 'bg-yellow-200'">
                            {{ result.winner === 'Player 1' ? result.player_one.name : result.player_two.name }}
                        </td>
                        <td class="border border-slate-600">
                            {{ result.date }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <h1 v-if="leaderboardCount > 0" class="font-medium leading-tight text-4xl mt-2 mb-2">Leaderboard</h1>
            <table v-if="leaderboardCount > 0" class="table-auto border border-slate-500 text-center">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="w-60 border border-slate-600">Ranking</th>
                        <th class="w-60 border border-slate-600">Player Name</th>
                        <th class="w-60 border border-slate-600">Player Score</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(player, index) in leaderboard" class="bg-white">
                        <td class="border border-slate-600 bg-white">
                            {{ ++index }}
                        </td>
                        <td class="border border-slate-600 bg-white">
                            {{ player.name }}
                        </td>
                        <td class="border border-slate-600 bg-white">
                            {{ player.averageScore }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <h1 v-if="highestScore !== null" class="font-medium leading-tight text-4xl mt-4 mb-2">Highest Score</h1>
            <table v-if="highestScore !== null" class="table-auto border border-slate-500 text-center">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="w-60 border border-slate-600">Player 1</th>
                        <th class="w-60 border border-slate-600">Player 1 Score</th>
                        <th class="w-60 border border-slate-600">Player 2 Score</th>
                        <th class="w-60 border border-slate-600">Player 2</th>
                        <th class="w-60 border border-slate-600">Winner</th>
                        <th class="w-60 border border-slate-600">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white">
                        <td class="border border-slate-600 bg-white">
                            {{ highestScore.player_one.name }}
                        </td>
                        <td class="border border-slate-600 bg-blue-200">
                            {{ highestScore.player_1_score }}
                        </td>
                        <td class="border border-slate-600 bg-yellow-200">
                            {{ highestScore.player_2_score }}
                        </td>
                        <td class="border border-slate-600 bg-white">
                            {{ highestScore.player_two.name }}
                        </td>
                        <td class="border border-slate-600"
                            :class="highestScore.winner === 'Player 1' ? 'bg-blue-200' : 'bg-yellow-200'">
                            {{
                                highestScore.winner === 'Player 1'
                                    ? highestScore.player_one.name
                                    : highestScore.player_two.name
                            }}
                        </td>
                        <td class="border border-slate-600">
                            {{ highestScore.date }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <h1 v-if="lowestScore !== null" class="font-medium leading-tight text-4xl mt-4 mb-2">Lowest Score</h1>
            <table v-if="lowestScore !== null" class="table-auto border border-slate-500 text-center">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="w-60 border border-slate-600">Player 1</th>
                        <th class="w-60 border border-slate-600">Player 1 Score</th>
                        <th class="w-60 border border-slate-600">Player 2 Score</th>
                        <th class="w-60 border border-slate-600">Player 2</th>
                        <th class="w-60 border border-slate-600">Winner</th>
                        <th class="w-60 border border-slate-600">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white">
                        <td class="border border-slate-600 bg-white">
                            {{ lowestScore.player_one.name }}
                        </td>
                        <td class="border border-slate-600 bg-blue-200">
                            {{ lowestScore.player_1_score }}
                        </td>
                        <td class="border border-slate-600 bg-yellow-200">
                            {{ lowestScore.player_2_score }}
                        </td>
                        <td class="border border-slate-600 bg-white">
                            {{ lowestScore.player_two.name }}
                        </td>
                        <td class="border border-slate-600"
                            :class="lowestScore.winner === 'Player 1' ? 'bg-blue-200' : 'bg-yellow-200'">
                            {{
                                lowestScore.winner === 'Player 1'
                                    ? lowestScore.player_one.name
                                    : lowestScore.player_two.name
                            }}
                        </td>
                        <td class="border border-slate-600">
                            {{ lowestScore.date }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </GuestLayout>
</template>
