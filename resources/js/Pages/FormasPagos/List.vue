<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  formasPagos: Object,
  filters: Object
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.formasPagosList"
    title="Formas de Pagos"
  >
    <Actions
      :filters="props.filters"
    />

    <Grid :formasPagos="props.formasPagos.data" />

    <Pagination
      v-if="props.formasPagos.total !== 0"
      :links="props.formasPagos.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
