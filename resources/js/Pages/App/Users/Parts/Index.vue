<template>
  <Users>
    <div class="">
      <DataTable showGridlines stripedRows :value="usersList" tableStyle="width: 100%">
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
</script>

<style></style>