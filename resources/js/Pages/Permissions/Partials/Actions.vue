<script setup>
import CircleButton from '../../../Components/CircleButton.vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import { hasPermission } from '../../../Helpers/permissions'

const props = defineProps({
  role: Object
})
const emit = defineEmits(['search'])
const form = useForm({
  description: null,
  status: null,
  isFilled () {
    return !!(this.description || this.status)
  }
})
const search = () => {
  emit('search', form)
}
const clean = () => {
  Inertia.get(`/roles/${props.role.id}/permissions`)
}
const update = () => {
  Inertia.get(`/roles/${props.role.id}/permissions/edit`)
}
const back = () => {
  Inertia.get('/roles')
}
</script>
<template>
  <CForm @submit.prevent="search">
    <CRow>
      <CCol>
        <CFormInput
          v-model="form.description"
          type="text"
          label="Nombre del permiso"
        />
      </CCol>
      <CCol>
        <CFormSelect
          v-model="form.status"
          label="Estado"
        >
          <option :value="''">Seleccionar una opción</option>
          <option
            value="SI"
          >
            Habilitado
          </option>
          <option
            value="NO"
          >
            Deshabilitado
          </option>
        </CFormSelect>
      </CCol>
      <CCol class="d-flex align-items-start btn-margin">
        <CircleButton
          title="Buscar"
          type="submit"
        >
          <span class="fas fa-search"></span>
        </CircleButton>
        <CircleButton
          v-if="form.isFilled() === true"
          class="ms-1"
          color="secondary"
          type="button"
          title="Limpiar"
          @click="clean"
        >
          <span class="fa-solid fa-xmark" type="submit"></span>
        </CircleButton>
      </CCol>
      <CCol class="d-flex align-items-end justify-content-end btn-margin">
        <CButton
          v-if="hasPermission($page, 'roles.permissions.edit')"
          color="primary"
          class="px-3 me-2"
          shape="rounded-pill"
          title="Editar permiso"
          @click="update"
        >
          Editar permiso
        </CButton>
        <CButton
          color="secondary"
          class="px-3"
          shape="rounded-pill"
          title="Volver"
          @click="back"
        >
          Volver
        </CButton>
      </CCol>
    </CRow>
  </CForm>
</template>
<style scoped>
.btn-margin{
  margin-top: 31px;
}
</style>
