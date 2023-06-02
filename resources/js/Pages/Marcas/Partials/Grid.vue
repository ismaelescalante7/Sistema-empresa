<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'

const props = defineProps({
  marcas: Array
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
        <CTableHeaderCell scope="col" class="col-sm-3">Nombre</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="marca in props.marcas"
        :key="marca.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            title="Permission"
            >
            <span class="fa-solid fa-sitemap"></span>
          </CircleButton>
          <CircleButton
            class="ms-1"
            title="Modificar"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ marca.nombre }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>

  <CAlert v-if="props.marcas === 0" color="info">
    Sin resultados.
  </CAlert>
</template>
<style>
.cell-center{
  vertical-align: baseline;
}
</style>
