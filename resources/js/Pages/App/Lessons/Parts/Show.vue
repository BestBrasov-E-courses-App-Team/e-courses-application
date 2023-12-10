<template>
  <Lessons class="">
    <LessonComponent :lesson="lesson"/>
  </Lessons>
</template>

<script setup>
import Lessons from '../Lessons.vue';
import LessonComponent from './LessonComponent.vue';

const props = defineProps({
  lesson: {
    type: Object,
    default: {},
  }
})
</script>

<style></style>