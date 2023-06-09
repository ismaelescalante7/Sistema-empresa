<script setup>
import { Inertia } from '@inertiajs/inertia'
import { reactive } from 'vue'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'
import Modal from '../../../Components/Modal.vue'

const props = defineProps({
  medidas: Array
})

const update = (medidaId) => {
  Inertia.get(`/medidas/${medidaId}/edit`)
}

const modal = reactive({
  show: false,
  item: null
})
const showModal = (show = false, medida = null) => {
  modal.show = show
  modal.item = medida
}

const destroy = () => {
  Inertia.delete(route('medidas.destroy', { medida: modal.item.id }))
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
        v-for="medida in props.medidas"
        :key="medida.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            class="ms-1"
            title="Modificar"
            @click="update(medida.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'medidas.destroy')"
            class="ms-1"
            title="Eliminar"
            @click="showModal(true, medida)"
          >
            <span class="fa-solid fa-trash-can"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ medida.descripcion }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>

  <Modal
    :visible="modal.show"
    @close="showModal()"
    >
      <template #header>
        Eliminar Medida
      </template>
      <CAlert color="warning">
        <span>
          <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro de deseas eliminar la medida?
        </span>
      </CAlert>
      <CRow class="d-flex flex-column text-center">
        <CCol>Descripcion: {{ modal.item.descripcion }}</CCol>
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

  <CAlert v-if="props.medidas === 0" color="info">
    Sin resultados.
  </CAlert>
</template>
<style>
.cell-center{
  vertical-align: baseline;
}
</style>
