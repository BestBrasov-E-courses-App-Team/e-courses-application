<template>
  <div class="card flex align-items-center justify-content-center">
    <Card style="">
        <template #header>
            <img alt="user header" src="https://primefaces.org/cdn/primevue/images/usercard.png" />
        </template>
        <template #title> {{ course?.title }} </template>
        <template #subtitle> {{ '' }} </template>
        <template #content>
            <p class="m-0">
                {{ course?.description ?? 'No description...' }}
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

const props = defineProps({
  course: Object
})

</script>

<style>

</style>