<template>
  <Lessons title="Create Lesson">
    <div class="w-full sm:w-4/5 sm:max-w-3xl mx-auto">
      <Fieldset legend="New Lesson">
        <form class="flex flex-col gap-4"  @submit.prevent="newLesson.post(route('section-lessons.store'))">
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
  section: {
    type: Object,
    required: true,
  },
})

const newLesson = useForm({
  title: null,
  description: null,
  section_id: props.section.id,
})
</script>

<style></style>