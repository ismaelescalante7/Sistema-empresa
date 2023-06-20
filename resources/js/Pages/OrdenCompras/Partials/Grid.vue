<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'
import Modal from '../../../Components/Modal.vue'
import { reactive } from 'vue'

const props = defineProps({
  ordenCompras: Array
})

const update = (ordenCompraId) => {
  Inertia.get(`/orden-compras/${ordenCompraId}/edit`)
}

const modal = reactive({
  show: false,
  item: null
})
const showModal = (show = false, ordenCompra = null) => {
  modal.show = show
  modal.item = ordenCompra
}

const destroy = () => {
  Inertia.delete(route('orden.compras.destroy', { ordenCompra: modal.item.id }))
  showModal()
}

</script>

<template>
  <CTable class="mt-3">
    <CTableHead>
      <CTableRow color="secondary">
        <CTableHeaderCell scope="col" class="col-sm-2"></CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Descripcion</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Total</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Neto</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Iva</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Estado</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="ordenCompra in props.ordenCompras"
        :key="ordenCompra.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            class="ms-1"
            title="Modificar"
            v-if="hasPermission($page, 'orden.compras.edit')"
            @click="update(ordenCompra.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'orden.compras.destroy')"
            class="ms-1"
            title="Eliminar"
            @click="showModal(true, ordenCompra)"
          >
            <span class="fa-solid fa-trash-can"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ ordenCompra.descripcion }}</CTableDataCell>
        <CTableDataCell>{{ ordenCompra.total }}</CTableDataCell>
        <CTableDataCell>{{ ordenCompra.neto }}</CTableDataCell>
        <CTableDataCell>{{ ordenCompra.iva }}</CTableDataCell>
        <CTableDataCell>{{ ordenCompra.estado }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>
  <CAlert v-if="props.ordenCompras === 0" color="info">
    Sin resultados.
  </CAlert>
  <Modal
    :visible="modal.show"
    @close="showModal()"
    >
      <template #header>
        Eliminar Orden de compra
      </template>
      <CAlert color="warning">
        <span>
          <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro de deseas eliminar la orden de pago?
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
