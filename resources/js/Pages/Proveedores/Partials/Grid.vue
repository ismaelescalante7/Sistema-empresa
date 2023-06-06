<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'
import Modal from '../../../Components/Modal.vue'
import { reactive } from 'vue'

const props = defineProps({
  proveedores: Array
})
const update = (proveedorId) => {
  Inertia.get(`/proveedores/${proveedorId}/edit`)
}

const modal = reactive({
  show: false,
  item: null
})
const showModal = (show = false, proveedor = null) => {
  modal.show = show
  modal.item = proveedor
}

const destroy = () => {
  Inertia.delete(route('proveedores.destroy', { proveedor: modal.item.id }))
  showModal()
}
</script>

<template>
  <CTable class="mt-3">
    <CTableHead>
      <CTableRow color="secondary">
        <CTableHeaderCell scope="col" class="col-sm-1"></CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Razon social</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Cuit</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Email</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="proveedor in props.proveedores"
        :key="proveedor.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            class="ms-1"
            title="Modificar"
            v-if="hasPermission($page, 'proveedores.edit')"
            @click="update(proveedor.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'proveedores.destroy')"
            class="ms-1"
            title="Eliminar"
            @click="showModal(true, proveedor)"
          >
            <span class="fa-solid fa-trash-can"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ proveedor.razon_social }}</CTableDataCell>
        <CTableDataCell>{{ proveedor.cuit }}</CTableDataCell>
        <CTableDataCell>{{ proveedor.email }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>
  <CAlert v-if="props.proveedores === 0" color="info">
    Sin resultados.
  </CAlert>
  <Modal
    :visible="modal.show"
    @close="showModal()"
    >
      <template #header>
        Eliminar Proveedor
      </template>
      <CAlert color="warning">
        <span>
          <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro de deseas eliminar el proveedor?
        </span>
      </CAlert>
      <CRow class="d-flex flex-column text-center">
        <CCol>Razon social: {{ modal.item.razon_social }}</CCol>
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
