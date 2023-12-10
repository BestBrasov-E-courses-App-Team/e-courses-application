<template>
  <Courses class="">
    <Panel :header="course.title">
      <div>
        <video class="w-full" v-if="course.video_thumbnail_url" :src="course.video_thumbnail_url" :poster="course.thumbnail_url" controls>
        </video>
        <img class="w-full" v-else-if="course.thumbnail_url" :src="course.thumbnail_url" alt="" srcset="">
      </div>
      <div class="my-4 flex flex-col gap-2">
          <div>
            <b>Authored By:</b> {{ course?.author?.name }}
          </div>
          <div>
            <b>Created At:</b> {{ course.created_at }}
          </div>
        </div>
      <p class="my-4">
          {{ course.description }}
      </p>
    </Panel>
    <Panel header="Course Sections" class="mt-4">
      <AddSection :course-id="course.id"/>
      <div class="py-3">
        <ul>
          <li v-for="(section, index) in course.sections" :key="section.id" class="">
            <Divider />
            <div class="flex justify-between items-center">
              <div>
                Section {{ index+1 }}  -  {{ section.title }}
              </div>
              <Button size="small" @click="router.get(route('section-lessons.create', {
                course_id: course.id, section_id: section.id
              }))">Add Lesson</Button>
            </div>
            <div v-if="section?.lessons.length" class="pl-6">
              <ul>
                <li v-for="(lesson, index) in section.lessons" :key="lesson.id" class="">
                  <Divider />
                  <div class="flex justify-between items-center hover:cursor-pointer hover:opacity-60" @click="router.get(route('section-lessons.show', lesson?.id))">
                    <div>
                      Lesson {{ index + 1 }}  -  {{ lesson.title }}
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </Panel>
  </Courses>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import Courses from '../Courses.vue';
import AddSection from './AddSection.vue';

const props = defineProps({
  course: {
    type: Object,
    default: {},
  }
})
</script>

<style></style>