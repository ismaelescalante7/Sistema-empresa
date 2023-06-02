<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  medidas: Object,
  filters: []
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.tiposComprobantesList"
    title="Medidas"
  >

    <Grid :medidas="props.medidas.data" />

    <Pagination
      v-if="props.medidas.total !== 0"
      :links="props.medidas.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
