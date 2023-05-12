<script setup>
import { Inertia } from '@inertiajs/inertia'
import { reactive } from 'vue'
import CircleButton from '../../../Components/CircleButton.vue'
import Modal from '../../../Components/Modal.vue'
import { hasPermission } from '../../../Helpers/permissions'

const props = defineProps({
  roles: Array
})

const update = (roleId) => {
  Inertia.get(`/roles/${roleId}/edit`)
}

const modal = reactive({
  show: false,
  item: null
})

const setModal = (show = false, role = null) => {
  modal.show = show
  modal.item = role
}

const destroy = () => {
  Inertia.delete(`/roles/${modal.item.id}`)
  setModal()
}

const permissions = (roleId) => {
  Inertia.get(`/roles/${roleId}/permissions`)
  setModal()
}

</script>

<template>
  <CTable class="mt-3">
    <CTableHead>
      <CTableRow color="secondary">
        <CTableHeaderCell scope="col" class="col-sm-2"></CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-5">Abreviatura</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-5">Nombre de rol</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="role in props.roles"
        :key="role.id"
        class="cell-center"
      >
        <CTableDataCell>
          <CircleButton
            v-if="hasPermission($page, 'roles.edit')"
            title="Modificar"
            @click="update(role.id)"
          >
            <span class="fa-solid fa-pen-to-square"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'roles.permissions.index')"
            class="ms-1"
            title="Permisos"
            @click="permissions(role.id)"
          >
            <span class="fa-solid fa-key"></span>
          </CircleButton>
          <CircleButton
            v-if="hasPermission($page, 'roles.destroy')"
            class="ms-1"
            title="Eliminar"
            @click="setModal(true, role)"
          >
            <span class="fa-solid fa-trash-can"></span>
          </CircleButton>
        </CTableDataCell>
        <CTableDataCell>{{ role.name }}</CTableDataCell>
        <CTableDataCell>{{ role.description }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>

  <CAlert v-if="props.roles.length === 0" color="info">
    Sin resultados.
  </CAlert>

  <Modal
    :visible="modal.show"
    @close="setModal()"
  >
    <template #header>
      Eliminar rol
    </template>
    <CAlert color="warning">
      <span>
        <i class="fa-solid fa-trash-can"></i> ¿Estás seguro que deseas eliminar el rol?
      </span>
    </CAlert>
    <CRow>
      <CCol xs="5">
        Rol: {{ modal.item.description }}
      </CCol>
    </CRow>
    <template #footer>
      <CButton
        color="danger"
        shape="rounded-pill"
        @click="destroy"
        class="text-white"
      >
        Eliminar
      </CButton>
      <CButton
        color="secondary"
        shape="rounded-pill"
        @click="setModal()"
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
