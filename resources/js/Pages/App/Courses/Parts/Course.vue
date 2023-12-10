<template>
  <div class="rounded-md">
    <Card style="">
        <template #header>
            <img class="rounded-md_ w-full h-[12rem] object-cover" alt="user header" :src="course?.thumbnail_url ?? 'https://primefaces.org/cdn/primevue/images/usercard.png'" />
        </template>
        <template #title> {{ course?.title }} </template>
        <template #subtitle>
          <div>
            Authored By: {{ course?.author?.name }} - {{ course.created_at }}
          </div>
        </template>
        <template #content>
            <p class="m-0">
                {{ course?.description ?? 'No description...' }}
                <div class="w-full flex flex-row gap-1 overflow-auto my-1">
                  <Tag v-for="(tag, index) in course?.misc?.tags" :key="index" :value="tag"></Tag>
                </div>
            </p>
        </template>
        <template #footer>
          <div class="flex flex-wrap justify-center_ gap-4">
            <Button v-if="is('admin|content-manager|teacher')" icon="pi pi-book" label="Open Course" @click="router.get(route('courses.show', course.id))" />
            <Button v-if="is('student')" icon="pi pi-book" label="Go to Course" @click="router.get(route('courses.details', course.id))" />
            <Button icon="pi pi-clock" label="Take Later" severity="secondary" style="" />
          </div>
        </template>
    </Card>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import Courses from '../Courses.vue';
import Tag from 'primevue/tag';

const props = defineProps({
  course: Object
})

</script>

<style>

</style>