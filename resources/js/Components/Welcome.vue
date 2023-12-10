<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps(['coursesCount', 'hoursThisWeek', 'completedTasks', 'recentCourses'])
</script>

<template>
    <div>
        <div class="grid grid-cols-3 gap-4 justify-between">
            <div class="p-12 rounded-xl flex flex-col gap-2 justify-center bg-white dark:bg-gray-700 hover:opacity-90 hover:cursor-pointer" @click="router.get(route('courses.index'))">
                <div class="text-2xl">
                    Courses
                </div>
                <div class="font-mono text-7xl">
                    {{ coursesCount }}
                </div>
            </div>
            <div class="p-6 rounded-xl flex flex-col gap-2 justify-center bg-white dark:bg-gray-700">
                <div class="text-2xl">
                    Hours this week
                </div>
                <div class="font-mono text-7xl">
                    {{ hoursThisWeek }}
                </div>
            </div>
            <div class="p-6 rounded-xl flex flex-col gap-2 justify-center bg-white dark:bg-gray-700">
                <div class="text-2xl">
                    Completed Tasks
                </div>
                <div class="font-mono text-7xl">
                    {{ completedTasks }}
                </div>
            </div>
        </div>
    </div>
</template>
