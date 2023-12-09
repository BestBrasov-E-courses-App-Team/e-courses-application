<template>
  <div>
    <Main :title="title">
      <slot/>
    </Main>
  </div>
</template>

<script setup>
  const props = defineProps({
    title: {
      default: 'Courses',
    }
  })
</script>

<style>

</style>