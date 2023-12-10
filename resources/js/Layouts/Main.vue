<template>
  <AppLayout :title="title">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ title }}
        </h2>
    </template>
    <div class="py-6 sm:py-12 w-full mx-2 sm:w-5/6_ max-w-7xl sm:mx-auto">
      <slot/>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from './AppLayout.vue';

import { usePage } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";
import Swal from 'sweetalert2'

const props = defineProps({
  title: {
    type: String,
    default: ''
  },
});

const page = usePage();
const errors = ref(page.props?.errors ?? []);

const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});

function runSessionMessages($obj) {
  for (const [key, value] of Object.entries($obj?.props.messages ?? {})) {
    if (value) {
      Toast.fire({
        icon: key,
        title: value,
      });
    }
  }
  for (const [key, value] of Object.entries($obj.props?.errors ?? {})) {
    if (value) {
      Toast.fire({
        icon: "error",
        title: value,
      });
    }
  }
}

onMounted(() => {
  runSessionMessages(page)
});

watch(page, async (oldpage, newpage) => {
  runSessionMessages(page)
});

</script>

<style>

</style>