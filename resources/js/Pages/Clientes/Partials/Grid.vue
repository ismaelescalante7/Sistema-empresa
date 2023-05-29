<script setup>
import CircleButton from '@/Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'
import Modal from '../../../Components/Modal.vue'
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  clientes: Array
})
const show = (id) => {
  Inertia.get(route('clientes.show', { cliente: id }))
}

const update = (cliente) => {
  Inertia.get(`/clientes/${cliente}/edit`)
}

const modal = reactive({
  show: false,
  item: null
})
const showModal = (show = false, cliente = null) => {
  modal.show = show
  modal.item = cliente
}

const destroy = () => {
  Inertia.delete(route('clientes.destroy', { cliente: modal.item.id }))
  showModal()
}

</script>

<template>
  <CTable class="mt-3">
    <CTableHead>
      <CTableRow color="secondary">
        <CTableHeaderCell scope="col" class="col-sm-2"></CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Apellido y Nombre</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Nro. Documento</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-4">Domicilio</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Email</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="cliente in props.clientes"
        :key="cliente.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            v-if="hasPermission($page, 'clientes.show')"
            class="ms-1"
            title="Ver"
            @click="show(cliente.id)"
          >
            <span class="fa-solid fa-eye"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'clientes.edit')"
            class="ms-1"
            title="Modificar"
            @click="update(cliente.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'clientes.destroy')"
            class="ms-1"
            title="Eliminar"
            @click="showModal(true, cliente)"
          >
            <span class="fa-solid fa-trash-can"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ cliente.apellido_nombre }}</CTableDataCell>
        <CTableDataCell>{{ cliente.numero_documento }}</CTableDataCell>
        <CTableDataCell>{{ cliente.domicilio }}</CTableDataCell>
        <CTableDataCell>{{ cliente.email }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>

  <CAlert v-if="props.clientes.length === 0" color="info">
    Sin resultados.
  </CAlert>

  <Modal
    :visible="modal.show"
    @close="showModal()"
    >
      <template #header>
        Eliminar Cliente
      </template>
      <CAlert color="warning">
        <span>
          <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro de deseas eliminar el cliente?
        </span>
      </CAlert>
      <CRow class="d-flex flex-column text-center">
        <CCol>Apellido y Nombre: {{ modal.item.apellido_nombre }}</CCol>
        <CCol>Nro. documento: {{ modal.item.numero_documento }}</CCol>
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
