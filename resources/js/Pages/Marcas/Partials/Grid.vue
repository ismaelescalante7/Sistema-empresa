<script setup>
import { Inertia } from '@inertiajs/inertia'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'
import Modal from '../../../Components/Modal.vue'
import { reactive } from 'vue'

const props = defineProps({
  marcas: Array
})

const update = (marcaId) => {
  Inertia.get(`/marcas/${marcaId}/edit`)
}

const modal = reactive({
  show: false,
  item: null
})
const showModal = (show = false, marca = null) => {
  modal.show = show
  modal.item = marca
}

const destroy = () => {
  Inertia.delete(route('marcas.destroy', { marca: modal.item.id }))
  showModal()
}

</script>

<template>
  <CTable class="mt-3">
    <CTableHead>
      <CTableRow color="secondary">
        <CTableHeaderCell scope="col" class="col-sm-1"></CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-3">Nombre</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="marca in props.marcas"
        :key="marca.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            class="ms-1"
            title="Modificar"
            v-if="hasPermission($page, 'marcas.edit')"
            @click="update(marca.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'marcas.destroy')"
            class="ms-1"
            title="Eliminar"
            @click="showModal(true, marca)"
          >
            <span class="fa-solid fa-trash-can"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ marca.nombre }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>

  <Modal
    :visible="modal.show"
    @close="showModal()"
    >
      <template #header>
        Eliminar Marca
      </template>
      <CAlert color="warning">
        <span>
          <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro de deseas eliminar la marca?
        </span>
      </CAlert>
      <CRow class="d-flex flex-column text-center">
        <CCol>Nombre: {{ modal.item.nombre }}</CCol>
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

  <CAlert v-if="props.marcas === 0" color="info">
    Sin resultados.
  </CAlert>
</template>
<style>
.cell-center{
  vertical-align: baseline;
}
</style>
