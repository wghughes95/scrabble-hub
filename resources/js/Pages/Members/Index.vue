<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import { PencilSquareIcon, IdentificationIcon } from '@heroicons/vue/24/outline';

defineProps(['members', 'membersCount']);
</script>
 
<template>

    <Head title="Members" />

    <GuestLayout>
        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            <h1 v-if="membersCount > 0" class="font-medium leading-tight text-4xl mt-0 mb-2">Members</h1>
            <table v-if="membersCount > 0" class="table-auto border border-slate-500 bg-white">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="w-60 border border-slate-600">Name</th>
                        <th class="w-60 border border-slate-600">Email</th>
                        <th class="w-60 border border-slate-600">Mobile Number</th>
                        <th class="w-60 border border-slate-600">Date Joined</th>
                        <th class="w-30 border border-slate-600">Edit</th>
                        <th class="w-30 border border-slate-600">Show</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="member in members" class="text-center">
                        <td class="border border-slate-600">{{ member.name }}</td>
                        <td class="border border-slate-600">{{ member.email }}</td>
                        <td class="border border-slate-600">{{ member.mobile_no }}</td>
                        <td class="border border-slate-600">{{ member.joined }}</td>
                        <td class="border border-slate-600">
                            <a :href="route('members.edit', [member.id])"
                                class="inline-flex justify-center rounded-md border border-transparent bg-yellow-600 p-2 text-sm font-medium text-white shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                <PencilSquareIcon class="h-5 w-5" />
                            </a>
                        </td>
                        <td class="border border-slate-600">
                            <a :href="route('members.show', [member.id])"
                                class="inline-flex justify-center rounded-md border border-transparent bg-green-600 p-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                <IdentificationIcon class="h-5 w-5" />
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-10">
                <a :href="route('members.create')"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Add New Member
                </a>
            </div>
        </div>
    </GuestLayout>
</template>