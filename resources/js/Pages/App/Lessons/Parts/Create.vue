<template>
  <Lessons title="Create Lesson">
    <div class="w-full sm:w-4/5 sm:max-w-3xl mx-auto">
      <Fieldset legend="New Lesson">
        <form class="flex flex-col gap-4"  @submit.prevent="newLesson.post(route('section-lessons.store'))">
          <InputText type="text" v-model="newLesson.title" placeholder="Course Title" />
          <Textarea type="text" v-model="newLesson.description" placeholder="Course Description/Notes"/>
          <SelectButton v-model="newLesson.media_type" :options="mediaTypes" aria-labelledby="basic" />
          <InputGroup class="w-full flex">
              <InputGroupAddon class="w-max">
                {{ newLesson.media_type?.toUpperCase() }}
              </InputGroupAddon>
              <InputText v-if="newLesson.media_type === 'audio'" class="grow" type="file" accept="audio/*"  @input="newLesson.media = $event.target.files[0]" />
              <InputText v-else-if="newLesson.media_type === 'video'" class="grow" type="file" accept="video/*"  @input="newLesson.media = $event.target.files[0]" />
              <InputText v-else-if="newLesson.media_type?.toLowerCase() === 'youtube'" class="grow" type="text" v-model="newLesson.media" placeholder="Paste your YouTube Id text here" />
            </InputGroup>
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
import { ref } from 'vue';
import Lessons from '../Lessons.vue';

const props = defineProps({
  section: {
    type: Object,
    required: true,
  },
})

const mediaTypes = ref([
  'audio',
  'video',
  'youtube',
])

const newLesson = useForm({
  title: null,
  description: null,
  media_type: 'video',
  media: null,
  section_id: props.section.id,
})
</script>

<style></style>