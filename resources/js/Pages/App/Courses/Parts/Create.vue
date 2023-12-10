<template>
  <Courses title="Create Course">
    <div class="w-full sm:w-4/5 sm:max-w-3xl mx-auto">
      <Fieldset legend="New Course">
        <form class="flex flex-col gap-4"  @submit.prevent="newCourse.post(route('courses.store'))">
          <InputText type="text" v-model="newCourse.title" placeholder="Title" />
          <Textarea type="text" v-model="newCourse.description" placeholder="Description"/>
          <AutoComplete v-model="newCourse.tags" multiple :suggestions="suggestions" @complete="search" placeholder="Select your content tags" class="w-full" />
          <InputGroup class="w-full flex">
            <InputGroupAddon class="w-max">
              Thumbnail
            </InputGroupAddon>
            <InputText class="grow" type="file" accept="image/*" @input="newCourse.thumbnail = $event.target.files[0]" />
          </InputGroup>
          <InputGroup class="w-full flex">
            <InputGroupAddon class="w-max">
              Video Thumbnail
            </InputGroupAddon>
            <InputText class="grow" type="file" accept="video/*" @input="newCourse.video_thumbnail = $event.target.files[0]" />
          </InputGroup>
          <div class="text-center">
            <Button type="submit">Create Course</Button>
          </div>
        </form>
      </Fieldset>
    </div>
  </Courses>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Courses from '../Courses.vue';

const props = defineProps({
})

const newCourse = useForm({
  title: null,
  tags: "",
  description: null,
  thumbnail: null,
  video_thumbnail: null
})
const suggestions = ref([]);
const tags = ref([
  'Mathematics',
  'Science',
  'Technology',
  'Programming',
  'History',
  'Literature',
  'Art',
  'Music',
  'Language Arts',
  'Physics',
  'Biology',
  'Chemistry',
  'Computer Science',
  'Engineering',
  'Digital Marketing',
  'Business',
  'Finance',
  'Entrepreneurship',
  'Health',
  'Psychology',
  'Environmental Science',
  'Sustainability',
  'Cultural Studies',
  'Communication',
  'Critical Thinking',
  'Problem Solving',
  'Data Science',
  'Machine Learning',
  'Web Development',
  'Mobile App Development',
  'Graphic Design',
  'Photography',
  'Film',
  'Social Sciences',
  'Philosophy',
  'Religion',
  'Ethics',
  'Geography',
  'Economics',
  'Political Science',
  'Sociology',
  'Anthropology',
  'Education',
  'E-learning',
  'Study Skills',
  'Test Preparation',
  'Academic Writing',
  'Research Skills',
  'Time Management',
  'Self-improvement',
  'Soft Skills',
  'Career Development',
  'Leadership',
  'Project Management',
  'Teamwork',
  'Public Speaking',
  'Health and Wellness',
  'Fitness',
  'Nutrition',
  'Mindfulness',
  'Yoga',
  'Personal Finance',
  'Investing',
  'Data Analysis',
  'Cybersecurity',
  'Blockchain',
  'Game Development',
  'Artificial Intelligence',
  'Robotics',
  'Ethical Hacking',
  'Virtual Reality',
  'Augmented Reality',
  'Internet of Things (IoT)',
  'Cloud Computing',
  'Big Data',
  'Blockchain',
  'Cryptocurrency',
  'Environmental Conservation',
  'Climate Change',
  'Global Issues',
  'Social Justice',
  'Diversity and Inclusion',
  'Digital Literacy',
  'Cyber Ethics',
  'Online Safety',
  'Creative Writing',
  'Poetry',
  'Fiction',
  'Non-fiction',
  'Resume Writing',
  'Interview Skills',
  'Job Search Strategies',
  'Professional Development',
  'Language Learning',
  'Foreign Languages',
  'Coding Languages',
  'Learning Strategies',
  'Mind Mapping',
  'Educational Technology',
  'Virtual Classroom',
  'Gamification',
  'Assessment and Grading',
  'Learning Analytics',
  'Educational Psychology',
]);
const search = (event) => {
  suggestions.value = tags.value?.filter(el => el?.toLowerCase().includes(event.query?.toLowerCase()))
}
</script>

<style></style>