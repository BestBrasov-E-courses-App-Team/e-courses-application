<template>
  <Users title="Create User">
    <!-- <div class="flex py-6 justify-start">
      <Button @click="router.get(route('users.index'))"><i class="pi pi-arrow-left mr-2"></i> Back</Button>
    </div> -->
    <div class="w-full sm:w-4/5 sm:max-w-3xl mx-auto">
      <Fieldset legend="New User">
        <form class="flex flex-col gap-4" @submit.prevent="addUser">
          <InputText
            placeholder="Name"
            name="name"
            v-model="formData.name"
            :error-messages="formData?.errors?.name"
          >
          </InputText>
          <InputText
            placeholder="Email"
            name="email"
            v-model="formData.email"
            :error-messages="formData?.errors?.email"
          >
          </InputText>
          <InputText
            placeholder="Password"
            name="password"
            v-model="formData.password"
            :error-messages="formData?.errors?.password"
          >
          </InputText>
          <Dropdown
            chips
            name="roles"
            placeholder="Roles"
            multiple
            v-model="formData.roles"
            :options="roles"
            :error-messages="formData?.errors?.roles"
          >
          </Dropdown>
          <div class="text-center">
            <Button type="submit">Add User</Button>
          </div>
        </form>
      </Fieldset>
    </div>
  </Users>
</template>

<script setup>
import { router, useForm } from '@inertiajs/vue3';
import Users from '../Users.vue';

const props = defineProps({
  roles: {
    type: Array,
    default: [],
  },
});
const formData = useForm({
  name: null,
  email: null,
  password: null,
  roles: [],
});
function addUser() {
  formData.post(route("users.store"))
}
</script>

<style></style>