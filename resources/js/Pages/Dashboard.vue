<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import Course from './App/Courses/Parts/Course.vue';
const props = defineProps(['coursesCount', 'hoursThisWeek', 'completedTasks', 'recentCourses'])
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white_dark:bg-gray-800 flex flex-col gap-4 overflow-auto w-full">
                    <div>
                        <InlineMessage v-if="Math.random() > 0.4" severity="info">You are on a {{ parseInt(Math.random()*46) }} day streak. Reach 60 to win a branded Hoodie!🔥</InlineMessage>
                        <InlineMessage v-else severity="success">Congratulations steady owl. You have achiebed a 60 day streak and just won a branded Hoodie!🎊</InlineMessage>
                    </div>
                    <Welcome :courses-count="coursesCount" :hours-this-week="hoursThisWeek" :completed-tasks="completedTasks" :recent-courses="recentCourses"/>
                    <div class="text-2xl pt-8">
                        Recently Added Courses
                    </div>
                    <div class="bg-gray-200 dark:bg-gray-700 rounded-md">
                        <Carousel :value="recentCourses" :numVisible="3" :numScroll="3">
                            <template #item="slotProps">
                                <div class="border-1 surface-border border-round m-2_ text-center py-5 px-3">
                                    <Course class="w-full basis-1/1 md:basis-1/3 shrink-0" :course="slotProps.data"/>
                                </div>
                            </template>
                        </Carousel>
                    </div>
                    <!-- <div class="w-full overflow-auto flex flex-row gap-4">
                        <Course class="w-full basis-1/1 md:basis-1/3 shrink-0" v-for="course in recentCourses ?? []" :key="course.id" :course="course"/>
                    </div> -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
