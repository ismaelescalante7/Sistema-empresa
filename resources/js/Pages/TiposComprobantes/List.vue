<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  tiposComprobantes: Object,
  filters: []
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.tiposComprobantesList"
    title="Tipos Comprobantes"
  >

    <Grid :tiposComprobantes="props.tiposComprobantes.data" />

    <Pagination
      v-if="props.tiposComprobantes.total !== 0"
      :links="props.tiposComprobantes.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
