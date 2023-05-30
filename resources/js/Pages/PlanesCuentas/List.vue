<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  planesCuentas: Object,
  filters: Object
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.tiposComprobantesList"
    title="Planes Cuentas"
  >
    <Actions
      :filters="props.filters"
    />

    <Grid :planesCuentas="props.planesCuentas.data" />

    <Pagination
      v-if="props.planesCuentas.total !== 0"
      :links="props.planesCuentas.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
