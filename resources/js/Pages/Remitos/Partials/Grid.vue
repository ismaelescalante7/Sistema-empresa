<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'
import Modal from '../../../Components/Modal.vue'
import {dateFormat} from '../../../Utils/format'
import { reactive } from 'vue'

const props = defineProps({
  remitos: Array
})

const update = (remitoId) => {
  Inertia.get(`/remitos/${remitoId}/edit`)
}

const modal = reactive({
  show: false,
  item: null
})
const showModal = (show = false, remito = null) => {
  modal.show = show
  modal.item = remito
}

const destroy = () => {
  Inertia.delete(route('remitos.destroy', { remito: modal.item.id }))
  showModal()
}

</script>

<template>
  <CTable class="mt-3">
    <CTableHead>
      <CTableRow color="secondary">
        <CTableHeaderCell scope="col" class="col-sm-1"></CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Fecha</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Localidad</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Proveedor</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Fecha ingreso</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Cerrado</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="remito in props.remitos"
        :key="remito.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            class="ms-1"
            title="Modificar"
            v-if="hasPermission($page, 'remitos.edit')"
            @click="update(remito.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'remitos.destroy')"
            class="ms-1"
            title="Eliminar"
            @click="showModal(true, remito)"
          >
            <span class="fa-solid fa-trash-can"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ dateFormat(remito.created_at) }}</CTableDataCell>
        <CTableDataCell>{{ remito.localidad.nombre }}</CTableDataCell>
        <CTableDataCell>{{ remito.proveedor.razon_social }}</CTableDataCell>
        <CTableDataCell>{{ dateFormat(remito.fecha_ingreso) }}</CTableDataCell>
        <CTableDataCell>{{ remito.cerrado }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>

  <Modal
    :visible="modal.show"
    @close="showModal()"
    >
      <template #header>
        Eliminar Remito
      </template>
      <CAlert color="warning">
        <span>
          <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro de deseas eliminar el remito?
        </span>
      </CAlert>
      <CRow class="d-flex flex-column text-center">
        <CCol>Codigo: {{ modal.item.id }}</CCol>
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

  <CAlert v-if="props.remitos === 0" color="info">
    Sin resultados.
  </CAlert>
</template>
<style>
.cell-center{
  vertical-align: baseline;
}
</style>
