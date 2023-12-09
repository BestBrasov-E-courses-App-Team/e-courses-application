<template>
  <Lessons title="Create Lesson">
    <div class="w-full sm:w-4/5 sm:max-w-3xl mx-auto">
      <Fieldset legend="New Lesson">
        <form class="flex flex-col gap-4"  @submit.prevent="newLesson.post(route('lessons.store'))">
          <InputText type="text" v-model="newLesson.title" placeholder="Title" />
          <Textarea type="text" v-model="newLesson.description" placeholder="Description"/>
          <div class="text-center">
            <Button type="submit">Add Lesson</Button>
          </div>
        </form>
      </Fieldset>
    </div>
  </Lessons>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Lessons from '../Lessons.vue';

const props = defineProps({
  sectionId: {
    required: true,
  },
  courseId: {
    required: true,
  },
})

const newLesson = useForm({
  title: null,
  description: null,
  course_section_id: props.sectionId,
  course_id: props.courseId,
})
</script>

<style></style>