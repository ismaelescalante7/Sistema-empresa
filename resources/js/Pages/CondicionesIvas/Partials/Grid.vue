<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'
import Modal from '../../../Components/Modal.vue'
import { reactive } from 'vue'

const props = defineProps({
  condicionesIvas: Array
})

const update = (condicionIvaId) => {
  Inertia.get(`/condiciones-ivas/${condicionIvaId}/edit`)
}

const modal = reactive({
  show: false,
  item: null
})
const showModal = (show = false, condicionIva = null) => {
  modal.show = show
  modal.item = condicionIva
}

const destroy = () => {
  Inertia.delete(route('condiciones.ivas.destroy', { condicionIva: modal.item.id }))
  showModal()
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
            v-if="hasPermission($page, 'condiciones.ivas.edit')"
            class="ms-1"
            title="Modificar"
            @click="update(condicionIva.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'condiciones.ivas.destroy')"
            class="ms-1"
            title="Eliminar"
            @click="showModal(true, condicionIva)"
          >
            <span class="fa-solid fa-trash-can"></span>
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

   <Modal
    :visible="modal.show"
    @close="showModal()"
    >
      <template #header>
        Eliminar Condición Iva
      </template>
      <CAlert color="warning">
        <span>
          <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro de deseas eliminar la condición Iva?
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
