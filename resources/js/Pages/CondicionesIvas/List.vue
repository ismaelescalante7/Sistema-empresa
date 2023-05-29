<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  condicionesIvas: Object,
  filters: []
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.tipos"
    title="Condiciones Ivas"
  >

    <Grid :condicionesIvas="props.condicionesIvas.data" />

    <Pagination
      v-if="props.condicionesIvas.total !== 0"
      :links="props.condicionesIvas.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
