<template>
  <Courses>
    <Toolbar>
      <template #start>
          <Button v-if="can('courses.create')" @click="router.get(route('courses.create'))" size="small" class="mr-2"><i class="pi pi-plus mr-2"></i> Add New Course</Button>
      </template>

      <template #center>
          <span class="p-input-icon-left">
              <i class="pi pi-search" />
              <InputText placeholder="Start typing to search..." v-model="searchVal" />
          </span>
      </template>

      <template #end></template>
  </Toolbar>
    <div class="flex py-6 justify-end">
      <!-- <Button v-if="can('courses.create')" @click="router.get(route('courses.create'))">Add New Course +</Button> -->
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <Course v-for="course in courses?.data" :key="course.id" :course="course"/>
    </div>
  </Courses>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import Courses from '../Courses.vue';
import Course from './Course.vue';
import { useDebounceFn, useUrlSearchParams } from '@vueuse/core'
import { ref, watch } from 'vue';

const props = defineProps({
  courses: {
    type: Object,
    default: [],
  }
})
const params = useUrlSearchParams('history')
const searchVal = ref(params?.q ?? null)
const searchCourse = useDebounceFn((val) => {
    router.get(route('courses.index', {q:val}), {}, {
    preserveState: true,
  })
  }, 500)

watch(searchVal, (newVal, oldVal) => {
    searchCourse(newVal)
})
</script>

<style></style>