<template>
  <Courses>
    <div class="flex py-6 justify-end">
      <Button v-if="can('courses.create')" @click="router.get(route('courses.create'))">Add New Course +</Button>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <Course v-for="course in courses" :key="course.id" :course="course"/>
    </div>
  </Courses>
</template>

<script setup>
import { router, useForm } from '@inertiajs/vue3';
import Courses from '../Courses.vue';
import Course from './Course.vue';

const props = defineProps({
  courses: {
    type: Array,
    default: [],
  }
})
</script>

<style></style>