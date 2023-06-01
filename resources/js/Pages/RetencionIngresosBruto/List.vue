<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  retensionIngresosBruto: Object,
  filters: Object
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.retensionIngresosBrutoList"
    title="Formas de Pagos"
  >
    <Actions
      :filters="props.filters"
    />

    <Grid :retensionIngresosBruto="props.retensionIngresosBruto.data" />

    <Pagination
      v-if="props.retensionIngresosBruto.total !== 0"
      :links="props.retensionIngresosBruto.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
