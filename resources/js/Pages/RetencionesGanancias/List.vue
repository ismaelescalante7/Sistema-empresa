<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  retencionesGanancias: Object,
  filters: []
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.retencionesGananciasList"
    title="Retenciones Ganancias"
  >

    <Grid :retencionesGanancias="props.retencionesGanancias.data" />

    <Pagination
      v-if="props.retencionesGanancias.total !== 0"
      :links="props.retencionesGanancias.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
