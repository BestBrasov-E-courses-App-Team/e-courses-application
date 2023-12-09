<template>
  <Lessons class="">
    <Panel :header="course.title">
      <p class="m-0">
          {{ course.description }}
      </p>
    </Panel>
    <Panel header="Sections" class="mt-4">
      <AddSection :course-id="course.id"/>
      <div class="py-3">
        <ul>
          <li v-for="(section, index) in course.sections" :key="section.id" class="">
            <Divider />
            {{ index+1 }}  -  {{ section.title }}
          </li>
        </ul>
      </div>
    </Panel>
  </Lessons>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Lessons from '../Lessons.vue';
import AddSection from './AddSection.vue';

const props = defineProps({
  course: {
    type: Object,
    default: {},
  }
})
</script>

<style></style>