<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  remitos: Object,
  filters: Object
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.remitosList"
    title="Remitos"
  >

    <Actions
      :filters="props.filters"
    />

    <Grid :remitos="props.remitos.data" />

    <Pagination
      v-if="props.remitos.total !== 0"
      :links="props.remitos.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
