<template>
  <Courses>
    <Panel :header="course.title">
      <p class="m-0">
          {{ course.description }}
      </p>
  </Panel>
  </Courses>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Courses from '../Courses.vue';

const props = defineProps({
  course: {
    type: Object,
    default: {},
  }
})
</script>

<style></style>