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

const show = (id) => {
  Inertia.get(route('productos.show', { producto: id }))
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
         <CTableHeaderCell scope="col" class="col-sm-2">Codigo</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Nombre</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Marca</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Rubro</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Estado</CTableHeaderCell>
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
            v-if="hasPermission($page, 'productos.show')"
            class="ms-1"
            title="Ver"
            @click="show(producto.id)"
          >
            <span class="fa-solid fa-eye"></span>
          </CircleButton>
          <CircleButton
            class="ms-1"
            title="Modificar"
            @click="update(producto.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ producto.codigo }}</CTableDataCell>
        <CTableDataCell>{{ producto.nombre }}</CTableDataCell>
        <CTableDataCell>{{ producto.marca.nombre }}</CTableDataCell>
        <CTableDataCell>{{ producto.rubro.nombre }}</CTableDataCell>
        <CTableDataCell>{{ producto.estado }}</CTableDataCell>
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
