<template>
  <Courses title="Courses | Learn">
    <div>
      <div class="flex gap-4">
        <div class="basis-2/3 w-full">
          <LessonComponent v-if="activeLesson" :lesson="activeLesson"/>
          <Panel v-else :header="`Course Title: ${course.title}`">
            <div>
              <video class="w-full" v-if="course.video_thumbnail_url" :src="course.video_thumbnail_url" :poster="course.thumbnail_url" controls>
              </video>
              <img class="w-full" v-else-if="course.thumbnail_url" :src="course.thumbnail_url" alt="" srcset="">
            </div>
            <h3 class="font-bold py-4 text-lg">Course Description</h3>
            <div class="my-4 flex flex-col gap-2">
              <div>
                <b>Authored By:</b> {{ course?.author?.name }}
              </div>
              <div>
                <b>Created At:</b> {{ course.created_at }}
              </div>
            </div>
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
import { ref } from 'vue';
import Courses from '../Courses.vue';
import CourseSidebar from './CourseSidebar.vue';
import LessonComponent from '../../Lessons/Parts/LessonComponent.vue'

const props = defineProps({
  course: {
    type: Object,
    default: [],
  }
})
const activeLesson = ref(null)
const openLesson = (lesson) => {
  activeLesson.value = lesson
}
</script>

<style></style>