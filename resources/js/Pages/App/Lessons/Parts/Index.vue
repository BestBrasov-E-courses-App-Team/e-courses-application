<template>
  <Lessons>
    <div class="flex flew">
      <Lesson v-for="lesson in lessons" :key="lesson.id" :lesson="lesson"/>
    </div>
  </Lessons>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Lessons from '../Lessons.vue';

const props = defineProps({
  lessons: {
    type: Array,
    default: [],
  }
})
</script>

<style></style>