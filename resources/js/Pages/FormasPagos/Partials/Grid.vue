<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'
import Modal from '../../../Components/Modal.vue'
import { reactive } from 'vue'

const props = defineProps({
  formasPagos: Array
})

const update = (formasPagoId) => {
  Inertia.get(`/formas-pagos/${formasPagoId}/edit`)
}

const modal = reactive({
  show: false,
  item: null
})
const showModal = (show = false, formasPago = null) => {
  modal.show = show
  modal.item = formasPago
}

const destroy = () => {
  Inertia.delete(route('formas.pagos.destroy', { formasPago: modal.item.id }))
  showModal()
}

</script>

<template>
  <CTable class="mt-3">
    <CTableHead>
      <CTableRow color="secondary">
        <CTableHeaderCell scope="col" class="col-sm-1"></CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Descripcion</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="formasPago in props.formasPagos"
        :key="formasPago.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            class="ms-1"
            title="Modificar"
            v-if="hasPermission($page, 'formas.pagos.edit')"
            @click="update(formasPago.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'formas.pagos.destroy')"
            class="ms-1"
            title="Eliminar"
            @click="showModal(true, formasPago)"
          >
            <span class="fa-solid fa-trash-can"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ formasPago.descripcion }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>
  <CAlert v-if="props.formasPagos === 0" color="info">
    Sin resultados.
  </CAlert>
  <Modal
    :visible="modal.show"
    @close="showModal()"
    >
      <template #header>
        Eliminar Forma Pago
      </template>
      <CAlert color="warning">
        <span>
          <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro de deseas eliminar la forma de pago?
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
