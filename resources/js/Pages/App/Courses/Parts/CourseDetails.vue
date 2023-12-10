<template>
  <Courses>
    <div>
      <div class="flex gap-4">
        <div class="basis-2/3 w-full">
          <LessonComponent v-if="activeLesson" :lesson="activeLesson"/>
          <Panel v-else :header="course.title">
            <p class="m-0">
                {{ course.description }}
            </p>
          </Panel>
        </div>
        <div class="basis-1/3 w-full">
          <CourseSidebar :course="course" @change-lesson="openLesson"  @course-details="activeLesson.value = null"/>
        </div>
      </div>
    </div>
  </Courses>
</template>

<script setup>
import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Courses from '../Courses.vue';
import CourseSidebar from './CourseSidebar.vue';
import LessonComponent from '../../Lessons/Parts/LessonComponent.vue'

const props = defineProps({
  course: {
    type: Array,
    default: [],
  }
})
const activeLesson = ref(null)
const openLesson = (lesson) => {
  activeLesson.value = lesson
}
const openLCourseDetails = (event) => {

}
</script>

<style></style>