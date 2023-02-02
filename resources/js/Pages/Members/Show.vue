<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps(['member', 'wins', 'losses', 'totalWins', 'totalLosses', 'averageScore', 'bestResult']);
</script>

<template>

    <Head :title="'Member Details - ' + member.name" />

    <GuestLayout>
        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            <h1 class="font-medium leading-tight text-4xl mt-0 mb-2">Member Details - {{ member.name }}</h1>
            <table class="table-auto border border-slate-500 text-center">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="w-60 border border-slate-600">Name</th>
                        <th class="w-60 border border-slate-600">Email</th>
                        <th class="w-60 border border-slate-600">Mobile Number</th>
                        <th class="w-60 border border-slate-600">Date Joined</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white">
                        <td class="border border-slate-600">{{ member.name }}</td>
                        <td class="border border-slate-600">{{ member.email }}</td>
                        <td class="border border-slate-600">{{ member.mobile_no }}</td>
                        <td class="border border-slate-600">{{ member.joined }}</td>
                    </tr>
                </tbody>
            </table>

            <h1 class="font-medium leading-tight text-4xl mt-5 mb-2">Wins</h1>
            <table class="table-auto border border-slate-500 text-center">
                <thead>
                    <tr class="bg-green-500">
                        <th class="w-60 border border-slate-600">Opponent</th>
                        <th class="w-60 border border-slate-600">Player Score</th>
                        <th class="w-60 border border-slate-600">Opponent Score</th>
                        <th class="w-60 border border-slate-600">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="win in wins" class="bg-green-200">
                        <td class="border border-slate-600">
                            <a class="hover:font-bold"
                                :href="route('members.show', [win.winner === 'Player 1' ? win.player_two.id : win.player_one.id])">
                                {{ win.winner === 'Player 1' ? win.player_two.name : win.player_one.name }}
                            </a>

                        </td>
                        <td class="border border-slate-600">
                            {{ win.winner === 'Player 1' ? win.player_1_score : win.player_2_score }}
                        </td>
                        <td class="border border-slate-600">
                            {{ win.winner === 'Player 1' ? win.player_2_score : win.player_1_score }}
                        </td>
                        <td class="border border-slate-600">
                            {{ win.date }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <h1 class="font-medium leading-tight text-4xl mt-5 mb-2">Losses</h1>
            <table class="table-auto border border-slate-500 text-center">
                <thead>
                    <tr class="bg-red-500">
                        <th class="w-60 border border-slate-600">Opponent</th>
                        <th class="w-60 border border-slate-600">Player Score</th>
                        <th class="w-60 border border-slate-600">Opponent Score</th>
                        <th class="w-60 border border-slate-600">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="loss in losses" class="bg-red-200">
                        <td class="border border-slate-600">
                            <a class="hover:font-bold"
                                :href="route('members.show', [loss.winner === 'Player 1' ? loss.player_one.id : loss.player_two.id])">
                                {{ loss.winner === 'Player 1' ? loss.player_one.name : loss.player_two.name }}
                            </a>
                        </td>
                        <td class="border border-slate-600">
                            {{ loss.winner === 'Player 1' ? loss.player_2_score : loss.player_1_score }}
                        </td>
                        <td class="border border-slate-600">
                            {{ loss.winner === 'Player 1' ? loss.player_1_score : loss.player_2_score }}
                        </td>
                        <td class="border border-slate-600">
                            {{ loss.date }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <h1 class="font-medium leading-tight text-4xl mt-5 mb-2">Statistics</h1>
            <table class="table-auto border border-slate-500 text-center">
                <thead>
                    <tr class="bg-blue-500">
                        <th class="w-80 border border-slate-600">Total Wins</th>
                        <th class="w-80 border border-slate-600">Total Losses</th>
                        <th class="w-80 border border-slate-600">Average Score</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-blue-200">
                        <td class="border border-slate-600">{{ totalWins }}</td>
                        <td class="border border-slate-600">{{ totalLosses }}</td>
                        <td class="border border-slate-600">{{ averageScore }}</td>
                    </tr>
                </tbody>
            </table>

            <h1 class="font-medium leading-tight text-4xl mt-5 mb-2">Best Result</h1>
            <table v-if="bestResult" class="table-auto border border-slate-500 text-center">
                <thead>
                    <tr class="bg-yellow-500">
                        <th class="w-60 border border-slate-600">Opponent</th>
                        <th class="w-60 border border-slate-600">Player Score</th>
                        <th class="w-60 border border-slate-600">Opponent Score</th>
                        <th class="w-60 border border-slate-600">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-yellow-200">
                        <td class="border border-slate-600">
                            <a class="hover:font-bold"
                                :href="route('members.show', [bestResult.player_one ? bestResult.player_one.id : bestResult.player_two.id])">
                                {{ bestResult.player_one ? bestResult.player_one.name : bestResult.player_two.name }}
                            </a>
                        </td>
                        <td class="border border-slate-600">
                            {{ bestResult.player_one ? bestResult.player_2_score : bestResult.player_1_score }}
                        </td>
                        <td class="border border-slate-600">
                            {{ bestResult.player_one ? bestResult.player_1_score : bestResult.player_2_score }}
                        </td>
                        <td class="border border-slate-600">
                            {{ bestResult.date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <p v-else>No Matches Played</p>
        </div>
    </GuestLayout>
</template>
