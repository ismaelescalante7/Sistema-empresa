<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  users: Object,
  filters: Object
})
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.usersList"
    title="Listado de usuarios"
  >
    <Actions
      :filters="props.filters"
    />

    <Grid :users="props.users.data" />

    <Pagination
      v-if="props.users.total !== 0"
      :links="props.users.links"
      :extra="filters"
    />

  </AppLayout>
</template>
