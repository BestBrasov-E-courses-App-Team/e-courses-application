<template>
  <div class="w-full sm:w-4/5 sm:max-w-3xl">
      <form class="flex gap-4" @submit.prevent="newSection.post(route('course-sections.store', {
        course_id: courseId
      }), {preserveScroll:true})">
        <InputText type="text" v-model="newSection.title" placeholder="Title" />
        <div class="text-center">
          <Button type="submit">Add Section</Button>
        </div>
      </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  courseId: {
    type: Number,
  }
})

const newSection = useForm({
  title: null,
})
</script>

<style></style>