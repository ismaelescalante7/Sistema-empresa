<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  marcas: Object,
  filters: Object
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.marcasList"
    title="Marcas"
  >

    <Actions
      :filters="props.filters"
    />

    <Grid :marcas="props.marcas.data" />

    <Pagination
      v-if="props.marcas.total !== 0"
      :links="props.marcas.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
