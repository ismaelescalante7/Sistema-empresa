<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  rubros: Object,
  filters: Object
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.rubrosList"
    title="Rubros"
  >

    <Actions
      :filters="props.filters"
    />

    <Grid :rubros="props.rubros.data" />

    <Pagination
      v-if="props.rubros.total !== 0"
      :links="props.rubros.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
