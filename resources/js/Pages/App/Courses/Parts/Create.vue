<template>
  <Courses title="Create Course">
    <!-- <div class="flex py-6 justify-start">
      <Button @click="router.get(route('courses.index'))"><i class="pi pi-arrow-left mr-2"></i> Back</Button>
    </div> -->
    <div class="w-full sm:w-4/5 sm:max-w-3xl mx-auto">
      <Fieldset legend="New Course">
        <form class="flex flex-col gap-4"  @submit.prevent="newCourse.post(route('courses.store'))">
          <InputText type="text" v-model="newCourse.title" placeholder="Title" />
          <Textarea type="text" v-model="newCourse.description" placeholder="Description"/>
          <InputGroup class="w-full flex">
            <InputGroupAddon class="w-max">
              Thumbnail
            </InputGroupAddon>
            <InputText class="grow" type="file" accept="image/*" @input="newCourse.thumbnail = $event.target.files[0]" />
          </InputGroup>
          <InputGroup class="w-full flex">
            <InputGroupAddon class="w-max">
              Video Thumbnail
            </InputGroupAddon>
            <InputText class="grow" type="file" accept="video/*" @input="newCourse.video_thumbnail = $event.target.files[0]" />
          </InputGroup>
          <div class="text-center">
            <Button type="submit">Create Course</Button>
          </div>
        </form>
      </Fieldset>
    </div>
  </Courses>
</template>

<script setup>
import { router, useForm } from '@inertiajs/vue3';
import Courses from '../Courses.vue';

const props = defineProps({
})

const newCourse = useForm({
  title: null,
  description: null,
  thumbnail: null,
  video_thumbnail: null
})
</script>

<style></style>