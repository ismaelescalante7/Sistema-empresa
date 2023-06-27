<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import breadcrumbs from '@/Data/Breadcrumbs'
import {useOrdenCompraStore} from '../../store/useOrdenCompra'

const ordenCompra = useOrdenCompraStore();
ordenCompra.reset()
ordenCompra.resetDetalles()

const props = defineProps({
  ordenCompras: Object,
  filters: Object
})

</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.ordenComprasList"
    title="Orden de Compras"
  >
    <Actions
      :filters="props.filters"
    />

    <Grid :ordenCompras="props.ordenCompras.data" />

    <Pagination
      v-if="props.ordenCompras.total !== 0"
      :links="props.ordenCompras.links"
      :extra="filters"
    /> 

  </AppLayout>
</template>
