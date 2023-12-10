<template>
  <Panel :header="lesson.title">
    <div class="my-4">
        <div v-if="lesson.media_type === 'video' && lesson.media_url">
          <video controls :src="lesson.media_url"></video>
        </div>
        <div v-if="lesson.media_type === 'audio' && lesson.media_url">
          <audio controls :src="lesson.media_url"></audio>
        </div>
        <div v-if="lesson.media_type?.toLowerCase() === 'youtube'">
          <iframe class="w-full min-h-[40vh]"
            :src="`https://www.youtube.com/embed/${lesson.media_path}?`">
          </iframe>
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
          {{ index + 1 }}  -  {{ attachment.title }}
        </li>
      </ul>
    </div>
  </Panel>
</template>

<script setup>
import AddAttachment from './AddAttachment.vue';
const props = defineProps({
  lesson : {
    type : Object,
    required: true,
  }
})
</script>

<style>

</style>