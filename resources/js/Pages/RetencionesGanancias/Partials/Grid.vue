<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'

const props = defineProps({
  retencionesGanancias: Array
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
        <CTableHeaderCell scope="col" class="col-sm-2">Tipo</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Minimo</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Alicuota</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Codigo Retencion</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Codigo Afip</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="retencionGanancia in props.retencionesGanancias"
        :key="retencionGanancia.id"
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
        <CTableDataCell>{{ retencionGanancia.codigo }}</CTableDataCell>
        <CTableDataCell>{{ retencionGanancia.tipo }}</CTableDataCell>
        <CTableDataCell>{{ retencionGanancia.minimo }}</CTableDataCell>
        <CTableDataCell>{{ retencionGanancia.alicuota }}</CTableDataCell>
        <CTableDataCell>{{ retencionGanancia.codigo_retencion }}</CTableDataCell>
        <CTableDataCell>{{ retencionGanancia.codigo_afip }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>

  <CAlert v-if="props.retencionesGanancias === 0" color="info">
    Sin resultados.
  </CAlert>
</template>
<style>
.cell-center{
  vertical-align: baseline;
}
</style>
