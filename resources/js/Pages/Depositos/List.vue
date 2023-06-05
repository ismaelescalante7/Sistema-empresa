<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  depositos: Object,
  filters: Object
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.depositosList"
    title="Depositos"
  >

    <Actions
      :filters="props.filters"
    />

    <Grid :depositos="props.depositos.data" />

    <Pagination
      v-if="props.depositos.total !== 0"
      :links="props.depositos.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
