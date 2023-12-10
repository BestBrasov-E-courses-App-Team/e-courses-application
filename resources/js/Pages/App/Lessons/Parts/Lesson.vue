<template>
  <div class="card flex align-items-center justify-content-center">
    <Card style="width: 25em">
        <template #header>
            <img alt="user header" src="https://primefaces.org/cdn/primevue/images/usercard.png" />
        </template>
        <template #title> Title: {{ lesson?.title }} </template>
        <template #subtitle> {{ '' }} </template>
        <template #content>
            <p class="m-0">
                {{ lesson?.description ?? 'No description...' }}
            </p>
        </template>
        <template #footer>
            <Button icon="pi pi-book" label="Go to lesson" @click="router.get(route('lessons.show', lesson.id))" />
            <Button icon="pi pi-clock" label="Take Later" severity="secondary" style="margin-left: 0.5em" />
        </template>
    </Card>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
  lesson: Object
})

</script>

<style>

</style>