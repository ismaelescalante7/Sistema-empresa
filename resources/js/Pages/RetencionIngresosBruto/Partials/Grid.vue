<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'
import Modal from '../../../Components/Modal.vue'
import { reactive } from 'vue'

const props = defineProps({
  retensionIngresosBruto: Array
})

const update = (retencionIngresosBrutoId) => {
  Inertia.get(`/retencion-ingresos-bruto/${retencionIngresosBrutoId}/edit`)
}

const modal = reactive({
  show: false,
  item: null
})
const showModal = (show = false, retencionIngresosBruto = null) => {
  modal.show = show
  modal.item = retencionIngresosBruto
}

const destroy = () => {
  Inertia.delete(route('retencion.ingresos.bruto.destroy', { retencionIngresosBruto: modal.item.id }))
  showModal()
}

</script>

<template>
  <CTable class="mt-3">
    <CTableHead>
      <CTableRow color="secondary">
        <CTableHeaderCell scope="col" class="col-sm-1"></CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Descripcion</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Porcentaje</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="retencionIngresosBruto in props.retensionIngresosBruto"
        :key="retencionIngresosBruto.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            class="ms-1"
            title="Modificar"
            v-if="hasPermission($page, 'retencion.ingresos.bruto.edit')"
            @click="update(retencionIngresosBruto.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'retencion.ingresos.bruto.destroy')"
            class="ms-1"
            title="Eliminar"
            @click="showModal(true, retencionIngresosBruto)"
          >
            <span class="fa-solid fa-trash-can"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ retencionIngresosBruto.descripcion }}</CTableDataCell>
        <CTableDataCell>{{ retencionIngresosBruto.porcentaje }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>
  <CAlert v-if="props.retensionIngresosBruto === 0" color="info">
    Sin resultados.
  </CAlert>
  <Modal
    :visible="modal.show"
    @close="showModal()"
    >
      <template #header>
        Eliminar Retencion Ingresos Bruto
      </template>
      <CAlert color="warning">
        <span>
          <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro de deseas eliminar la retencion de ingresos bruto?
        </span>
      </CAlert>
      <CRow class="d-flex flex-column text-center">
        <CCol>Descripción: {{ modal.item.descripcion }}</CCol>
      </CRow>
      <template #footer>
        <CButton
          color="danger"
          shape="rounded-pill"
          class="text-white"
          @click="destroy"
        >
          Eliminar
        </CButton>
        <CButton
          color="secondary"
          shape="rounded-pill"
          @click="showModal()"
        >
          Cancelar
        </CButton>
      </template>
  </Modal>
</template>
<style>
.cell-center{
  vertical-align: baseline;
}
</style>
