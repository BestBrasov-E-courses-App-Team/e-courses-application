<template>
  <Courses>
    <Toolbar>
      <template #start>
          <Button v-if="can('courses.create')" @click="router.get(route('courses.create'))" size="small" class="mr-2"><i class="pi pi-plus mr-2"></i> Add New Course</Button>
      </template>

      <template #center>
          <span class="p-input-icon-left" v-tooltip.bottom="'Search by course title, description, tags and author\'s name'">
              <i class="pi pi-search" />
              <InputText placeholder="Start typing to search..." v-model="searchVal" />
          </span>
      </template>

      <template #end>
        <div class="flex gap-1 justify-end">
          <Dropdown v-model="sort.sort_by" :options="['title', 'description', 'created_at']" placeholder="Sort By" class="" />
          <SelectButton v-model="sort.sort_order" :options="['asc', 'desc']" aria-labelledby="basic" />
          <Calendar v-model="dateRange" selectionMode="range" :manualInput="false" />
        </div>
      </template>
  </Toolbar>
    <div class="flex py-6 justify-end">
      <!-- <Button v-if="can('courses.create')" @click="router.get(route('courses.create'))">Add New Course +</Button> -->
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <Course v-for="course in courses?.data" :key="course.id" :course="course" class="w-full"/>
    </div>
  </Courses>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import Courses from '../Courses.vue';
import Course from './Course.vue';
import { useDebounceFn, useUrlSearchParams } from '@vueuse/core'
import { reactive, ref, watch } from 'vue';

const props = defineProps({
  courses: {
    type: Object,
    default: [],
  }
})
const params = useUrlSearchParams('history')
const searchVal = ref(params?.q ?? null)
const dateRange = ref([]);
const sort = reactive({
  sort_by: params?.sort_by ?? 'created_at',
  sort_order: params?.sort_order ?? 'desc',
});
const searchCourse = useDebounceFn((val) => {
    router.get(route('courses.index', {
      q:val,
      ...sort,
      s_date:dateRange?.value[0] ?? null,
      e_date:dateRange?.value[1] ?? null,
    }), {}, {
    preserveState: true,
  })
  }, 500)

watch([searchVal, dateRange, sort], (newVal, oldVal) => {
    searchCourse(searchVal.value)
})
</script>

<style></style>