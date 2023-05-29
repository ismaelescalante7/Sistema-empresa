<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  clientes: Object,
  filters: Object
})
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.clientesList"
  >
    <Actions
      :filters="props.filters"
      :clientes="props.clientes"
    />

    <Grid :clientes="props.clientes.data" />

    <Pagination
      v-if="props.clientes.total !== 0"
      :links="props.clientes.links"
      :extra="filters"
    />

  </AppLayout>
</template>
