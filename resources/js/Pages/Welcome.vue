<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>
 
<template>

    <Head title="Home" />

    <GuestLayout>
        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            <h1 class="font-medium leading-tight text-4xl mt-0 mb-2">Welcome to ScrabbleHub</h1>

            <div class="mt-10">
                <a :href="route('members.index')"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Go to Members Page
                </a>
            </div>

            <div class="mt-10">
                <a :href="route('results.index')"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Go to Results Page
                </a>
            </div>
        </div>
    </GuestLayout>
</template>