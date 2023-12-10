<template>
  <div>
    <Tree :value="nodes" :filter="true" filterMode="lenient" class="w-full md:w-30rem">
       <template #default="slotProps">
          <b class="hover:cursor-pointer">{{ slotProps.node.label }}</b>
      </template>
      <template #url="slotProps">
          <div class="hover:cursor-pointer" @click="$emit('changeLesson', slotProps.node.self)">{{ slotProps.node.label }}</div>
      </template>
      <template #home="slotProps">
          <b class="hover:cursor-pointer" @click="$emit('changeLesson', slotProps.node.self)">{{ slotProps.node.label }}</b>
      </template>
    </Tree>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue"

const props = defineProps({
  course: {
    type: Object,
    required: true,
  }
})

const emit = defineEmits(['changeLesson', 'courseDetail'])

const nodes = ref([
  {
    key: 'xx',
    label: 'Course Overview',
    self: null,
    data: 'home',
    type: 'home',
  }
])

onMounted(() => {
  props.course.sections.forEach((el, index) => {
      nodes.value.push({
        key: index,
        label: el?.title,
        data: '',
        self: el,
        children: el?.lessons?.map(
          (el_i, index_i) => {
            return {
              key: `${index}-${index_i}`,
              label: el_i.title,
              self: el_i,
              data:  route('section-lessons.show', el_i.id),
              type: 'url',
            }
          })
      })
    })
})
</script>

<style>

</style>