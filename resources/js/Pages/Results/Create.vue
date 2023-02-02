<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const form = useForm({
    player_1_id: 'Player 1',
    player_2_id: 'Player 2',
    player_1_score: '',
    player_2_score: '',
    date: ''
});

defineProps(['members']);
</script>
 
<template>

    <Head title="Add a New Result" />

    <GuestLayout>
        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Add a New Result</h3>
                        </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form @submit.prevent="form.post(route('results.store'))">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="bg-white px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <select id="player_1_id"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                v-model="form.player_1_id">
                                                <option selected>Player 1</option>
                                                <option v-for="member in members" :value="member.id">{{ member.name }}
                                                </option>
                                            </select>
                                            <InputError :message="form.errors.player_1_id" class="mt-2" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <select id="player_2_id"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                v-model="form.player_2_id">
                                                <option selected>Player 2</option>
                                                <option v-for="member in members" :value="member.id">{{ member.name }}
                                                </option>
                                            </select>
                                            <InputError :message="form.errors.player_2_id" class="mt-2" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="name" class="block text-sm font-medium text-gray-700">Player 1
                                                Score</label>
                                            <TextInput type="text" name="name" id="name" v-model="form.player_1_score"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </TextInput>
                                            <InputError :message="form.errors.player_1_score" class="mt-2" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="name" class="block text-sm font-medium text-gray-700">Player 1
                                                Score</label>
                                            <TextInput type="text" name="name" id="name" v-model="form.player_2_score"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </TextInput>
                                            <InputError :message="form.errors.player_1_score" class="mt-2" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="name" class="block text-sm font-medium text-gray-700">Date
                                                (YYYY-MM-DD)</label>
                                            <TextInput type="text" name="name" id="name" v-model="form.date"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </TextInput>
                                            <InputError :message="form.errors.date" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                    <PrimaryButton
                                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Add New Match Record</PrimaryButton>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>