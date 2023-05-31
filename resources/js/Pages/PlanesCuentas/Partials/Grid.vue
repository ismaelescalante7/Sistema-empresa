<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'
import Modal from '../../../Components/Modal.vue'
import { reactive } from 'vue'

const props = defineProps({
  planesCuentas: Array
})

const update = (planCuentaId) => {
  Inertia.get(`/planes-cuentas/${planCuentaId}/edit`)
}

const modal = reactive({
  show: false,
  item: null
})
const showModal = (show = false, planCuenta = null) => {
  modal.show = show
  modal.item = planCuenta
}

const destroy = () => {
  Inertia.delete(route('planes.cuentas.destroy', { planCuenta: modal.item.id }))
  showModal()
}

</script>

<template>
  <CTable class="mt-3">
    <CTableHead>
      <CTableRow color="secondary">
        <CTableHeaderCell scope="col" class="col-sm-1"></CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Descripcion</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Imputable</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="planCuenta in props.planesCuentas"
        :key="planCuenta.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            class="ms-1"
            title="Modificar"
            v-if="hasPermission($page, 'planes.cuentas.edit')"
            @click="update(planCuenta.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'planes.cuentas.destroy')"
            class="ms-1"
            title="Eliminar"
            @click="showModal(true, planCuenta)"
          >
            <span class="fa-solid fa-trash-can"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ planCuenta.descripcion }}</CTableDataCell>
        <CTableDataCell>{{ planCuenta.imputable }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>
  <CAlert v-if="props.planesCuentas === 0" color="info">
    Sin resultados.
  </CAlert>
  <Modal
    :visible="modal.show"
    @close="showModal()"
    >
      <template #header>
        Eliminar Plan Cuenta
      </template>
      <CAlert color="warning">
        <span>
          <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro de deseas eliminar el plan de cuenta?
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
