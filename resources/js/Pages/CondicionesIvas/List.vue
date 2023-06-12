<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  condicionesIvas: Object,
  filters: Object
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.condicionesIvasList"
    title="Condiciones Ivas"
  >
    <Actions
      :filters="props.filters"
    />

    <Grid :condicionesIvas="props.condicionesIvas.data" />

    <Pagination
      v-if="props.condicionesIvas.total !== 0"
      :links="props.condicionesIvas.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
