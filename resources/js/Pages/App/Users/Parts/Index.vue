<template>
  <Users>
    <Toolbar>
      <template #start>
          <Button v-if="can('users.create')" @click="router.get(route('users.create'))" size="small" class="mr-2"><i class="pi pi-plus mr-2"></i> Add New User</Button>
      </template>

      <template #center>
          <span class="p-input-icon-left">
              <i class="pi pi-search" />
              <InputText placeholder="Start typing to search..." v-model="searchVal" />
          </span>
      </template>

      <template #end></template>
    </Toolbar>
    <div class="">
      <div class="flex py-6 justify-end">
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
import { computed, ref, watch } from 'vue';
import Users from '../Users.vue';
import { router } from '@inertiajs/vue3';
import { useDebounceFn, useUrlSearchParams } from '@vueuse/core';

const props = defineProps({
  users: {
    type: Object,
    default: [],
  }
})
const usersList = computed(() => props.users?.data?.map(user => ({
    id: user.id,
    name: user.name,
    email: user.email,
    roles: user.roles?.map(role => role.name).join('|')
  }))
)
function openUser(userEvent) {
  router.get(route("users.edit", { user: userEvent?.data.id }), {}, {
    preserveState: true,
  })
  return;
}
const params = useUrlSearchParams('history')
const searchVal = ref(params?.q ?? null)
const search = useDebounceFn((val) => {
  router.get(route('users.index', { q: val }), {}, {
    preserveState: true,
  })
}, 500)

watch(searchVal, (newVal, oldVal) => {
  search(newVal)
})
</script>

<style></style>