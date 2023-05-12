<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import breadcrumbs from '@/Data/Breadcrumbs'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
  roles: Object,
  filters: Object
})
</script>
<template>
  <AppLayout
    title="Listado de roles"
    :breadcrumb="breadcrumbs.rolesList"
  >
    <Actions :filters="props.filters"/>
    <Grid :roles="props.roles.data" />
    <Pagination
      v-if="props.roles.total !== 0"
      :links="props.roles.links"
      :extra="filters"
    />
  </AppLayout>
</template>
