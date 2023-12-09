<template>
  <Lessons class="">
    <Panel :header="lesson.title">
      <div class="my-4">
          <div v-if="lesson.media_type === 'video' && lesson.media_url">
            <video controls :src="lesson.media_url"></video>
          </div>
          <div v-if="lesson.media_type === 'audio' && lesson.media_url">
            <audio controls :src="lesson.media_url"></audio>
          </div>
        </div>
        <p class="m-0">
          <h4 class="text-lg font-semibold">Description</h4>
            {{ lesson.description ?? 'No description' }}
        </p>
    </Panel>
    <Panel header="Attachments" class="mt-4">
      <!-- <AddAttachment :lesson-id="lesson.id"/> -->
      <div v-if="!lesson?.attachments?.length">
        No attachments have been added on this lesson
      </div>
      <div class="py-3">
        <ul>
          <li v-for="(attachment, index) in lesson.attachments" :key="attachment.id" class="">
            <Divider />
            {{ index+1 }}  -  {{ attachment.title }}
          </li>
        </ul>
      </div>
    </Panel>
  </Lessons>
</template>

<script setup>
import Lessons from '../Lessons.vue';
import AddAttachment from './AddAttachment.vue';

const props = defineProps({
  lesson: {
    type: Object,
    default: {},
  }
})
</script>

<style></style>