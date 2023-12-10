<template>
  <Users title="Update User">
    <div class="w-full sm:w-4/5 sm:max-w-3xl mx-auto">
      <Fieldset legend="Update User">
        <form class="flex flex-col gap-4" @submit.prevent="updateUser">
          <InputText placeholder="Name" name="name" v-model="formData.name" :error-messages="formData?.errors?.name">
          </InputText>
          <InputText placeholder="Email" name="email" v-model="formData.email" :error-messages="formData?.errors?.email">
          </InputText>
          <InputText placeholder="Password" name="password" v-model="formData.password"
            :error-messages="formData?.errors?.password">
          </InputText>
          <Dropdown chips name="roles" placeholder="Roles" multiple v-model="formData.roles" :options="roles"
            :error-messages="formData?.errors?.roles">
          </Dropdown>
          <div class="text-center">
            <Button type="submit">Update User</Button>
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
  user: {
    type: Object,
    default: {},
  },
  roles: {
    type: Array,
    default: [],
  },
  userRoles: {
    type: Array,
    default: [],
  },
});
const formData = useForm({
  name: props?.user?.name ?? null,
  email: props?.user?.email ?? null,
  roles: props?.userRoles ?? [],
});
function updateUser() {
  formData.put(route("users.update", { user: props?.user?.id }))
}
</script>

<style></style>