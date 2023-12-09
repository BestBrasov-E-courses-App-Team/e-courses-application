<template>
  <Courses>
    <div class="flex flew">
      <Course v-for="course in courses" :key="course.id" :course="course"/>
    </div>
  </Courses>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Courses from '../Courses.vue';
import Course from './Course.vue';

const props = defineProps({
  courses: {
    type: Array,
    default: [],
  }
})

const newCourse = useForm({
  title: null,
  description: null,
  thumbnail: null,
  video_thumbnail: null
})
</script>

<style></style>