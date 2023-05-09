<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'

const props = defineProps({
  productos: Array
})

const update = (userId) => {
  Inertia.get(`/users/${userId}/edit`)
}

const accesos = (userId) => {
  Inertia.get(`/users/${userId}/accesos`)
}
</script>

<template>
  <CTable class="mt-3">
    <CTableHead>
      <CTableRow color="secondary">
        <CTableHeaderCell scope="col" class="col-sm-1"></CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-4">Nombre</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Descripción</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Cantidad</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Precio</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="producto in props.productos"
        :key="producto.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            class="ms-1"
            title="Modificar"
            @click="update(producto.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ producto.nombre }}</CTableDataCell>
        <CTableDataCell>{{ producto.descripcion }}</CTableDataCell>
        <CTableDataCell>{{ producto.cantidad }}</CTableDataCell>
        <CTableDataCell>{{ producto.precio }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>

  <CAlert v-if="props.productos.length === 0" color="info">
    Sin resultados.
  </CAlert>
</template>
<style>
.cell-center{
  vertical-align: baseline;
}
</style>
