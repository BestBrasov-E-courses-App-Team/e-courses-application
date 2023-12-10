<template>
  <div>
    <Tree :value="nodes" :filter="true" filterMode="lenient" class="w-full md:w-30rem">
       <template #default="slotProps">
          <b>{{ slotProps.node.label }}</b>
      </template>
      <template #url="slotProps">
          <div @click="$emit('changeLesson', slotProps.node.self)">{{ slotProps.node.label }}</div>
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

const nodes = ref([])

onMounted(() => {
  nodes.value = props.course.sections.map((el, index) => {
      return {
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
      }
    })
})
</script>

<style>

</style>