<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'

const props = defineProps({
  condicionesIvas: Array
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
        <CTableHeaderCell scope="col" class="col-sm-2">Codigo</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Descripcion</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="condicionIva in props.condicionesIvas"
        :key="condicionIva.id"
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
        <CTableDataCell>{{ condicionIva.codigo }}</CTableDataCell>
        <CTableDataCell>{{ condicionIva.descripcion }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>

  <CAlert v-if="props.condicionesIvas === 0" color="info">
    Sin resultados.
  </CAlert>
</template>
<style>
.cell-center{
  vertical-align: baseline;
}
</style>
