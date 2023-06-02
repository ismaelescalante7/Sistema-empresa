<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  condicionesPagos: Object,
  filters: Object
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.condicionesPagosList"
    title="Condiciones de Pagos"
  >
    <Actions
      :filters="props.filters"
    />

    <Grid :condicionesPagos="props.condicionesPagos.data" />

    <Pagination
      v-if="props.condicionesPagos.total !== 0"
      :links="props.condicionesPagos.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
