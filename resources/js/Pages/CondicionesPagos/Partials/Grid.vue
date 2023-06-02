<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'
import Modal from '../../../Components/Modal.vue'
import { reactive } from 'vue'

const props = defineProps({
  condicionesPagos: Array
})

const update = (condicionesPagoId) => {
  Inertia.get(`/condiciones-pagos/${condicionesPagoId}/edit`)
}

const modal = reactive({
  show: false,
  item: null
})
const showModal = (show = false, condicionesPago = null) => {
  modal.show = show
  modal.item = condicionesPago
}

const destroy = () => {
  Inertia.delete(route('condiciones.pagos.destroy', { condicionesPago: modal.item.id }))
  showModal()
}

</script>

<template>
  <CTable class="mt-3">
    <CTableHead>
      <CTableRow color="secondary">
        <CTableHeaderCell scope="col" class="col-sm-1"></CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Condicion</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Dias</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="condicionesPago in props.condicionesPagos"
        :key="condicionesPago.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            class="ms-1"
            title="Modificar"
            v-if="hasPermission($page, 'condiciones.pagos.edit')"
            @click="update(condicionesPago.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'condiciones.pagos.destroy')"
            class="ms-1"
            title="Eliminar"
            @click="showModal(true, condicionesPago)"
          >
            <span class="fa-solid fa-trash-can"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ condicionesPago.condicion }}</CTableDataCell>
        <CTableDataCell>{{ condicionesPago.dias }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>
  <CAlert v-if="props.condicionesPagos === 0" color="info">
    Sin resultados.
  </CAlert>
  <Modal
    :visible="modal.show"
    @close="showModal()"
    >
      <template #header>
        Eliminar Condicion de pago
      </template>
      <CAlert color="warning">
        <span>
          <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro de deseas eliminar la condicion de pago?
        </span>
      </CAlert>
      <CRow class="d-flex flex-column text-center">
        <CCol>Condicion: {{ modal.item.condicion }}</CCol>
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
