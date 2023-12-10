<template>
  <Users>
    <div class="">
      <div class="flex py-6 justify-end">
        <Button v-if="can('users.create')" @click="router.get(route('users.create'))">Add New User +</Button>
      </div>
      <DataTable selectionMode="single" @rowSelect="openUser" showGridlines stripedRows :value="usersList" tableStyle="width: 100%">
        <Column field="id" sortable header="ID"></Column>
        <Column field="name" sortable header="Name"></Column>
        <Column field="email" sortable header="Email"></Column>
        <Column field="roles" sortable header="Roles"></Column>
      </DataTable>
    </div>
  </Users>
</template>

<script setup>
import { ref } from 'vue';
import Users from '../Users.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  users: {
    type: Object,
    default: [],
  }
})
const usersList = ref(props.users?.data?.map(user => ({
  id: user.id,
  name: user.name,
  email: user.email,
  roles: user.roles?.map(role => role.name).join('|')
})))
function openUser(userEvent) {
  router.get(route("users.edit", { user: userEvent?.data.id }))
  return;
}
</script>

<style></style>