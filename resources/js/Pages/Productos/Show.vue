<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  producto: Object
})

const back = () => {
  Inertia.get(route('productos.index'))
}
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.productosShow"
    title="Productos"
  >
    <CTableBody class="table-borderless">
      <CTableRow class="col">
        <CTableDataCell class="d-flex justify-content-end">Nombre:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3"> {{ props.producto.nombre }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end ms-2">Codigo:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.producto.codigo }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end ms-2">Precio de venta:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.producto.precio_venta }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Precio de compra:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.producto.precio_compra }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Stockeable:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.producto.stockeable }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Compra:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.producto.compra }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Vende:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.producto.vende }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Marca</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.producto.marca.nombre }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Rubro:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.producto.rubro.nombre }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Estado:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.producto.estado }}</CTableDataCell>
      </CTableRow>
    </CTableBody>

    <CRow class="m-4">
      <CCol xs="4">
        <CButton
          type="button"
          color="secondary"
          class="px-4"
          shape="rounded-pill"
          title="Volver"
          @click="back"
        >
          Volver
        </CButton>
      </CCol>
    </CRow>
  </AppLayout>
</template>
