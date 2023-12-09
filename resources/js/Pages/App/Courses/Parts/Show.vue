<template>
  <Courses class="">
    <Panel :header="course.title">
      <p class="m-0">
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
              <!-- {{ section?.lessons }} -->
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
        <!-- <Tree :value="nodes" class="w-full md:w-30rem_">
        </Tree> -->
        <!-- <template #default="slotProps">
            <b>{{ slotProps.node.title }}</b>
        </template> -->
      </div>
    </Panel>
  </Courses>
</template>

<script setup>
import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Courses from '../Courses.vue';
import AddSection from './AddSection.vue';

const props = defineProps({
  course: {
    type: Object,
    default: {},
  }
})
const nodes = ref(props.course.sections.map(
  (el, index) => {
    return {
      key: index,
      label: el.title,
      children: el?.courses?.map(
        (el, index_i) => {
          return {
            key: `${index}-${index_i}`,
            label: el.title,
          }
        })
    }
  }
))
</script>

<style></style>