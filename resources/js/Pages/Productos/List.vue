<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  productos: Object,
  filters: Object
})
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.productosList"
    title="Listado de Productos"
  >
    <Actions
      :filters="props.filters"
      :delegaciones="props.delegaciones"
    />

    <Grid :productos="props.productos.data" />

    <Pagination
      v-if="props.productos.total !== 0"
      :links="props.productos.links"
      :extra="filters"
    />
  </AppLayout>
</template>
