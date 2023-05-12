<script setup>
import CircleButton from '../../../Components/CircleButton.vue'
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
  role: Object
})
const emit = defineEmits(['search', 'clean', 'save', 'cancel'])
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
  form.description = null
  form.status = null
  emit('clean', props.role)
}
const save = () => {
  emit('save', props.role)
}
const cancel = () => {
  emit('cancel', props.role)
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
          color="primary"
          class="px-3 me-2"
          shape="rounded-pill"
          title="Guardar"
          @click="save"
        >
          Guardar
        </CButton>
        <CButton
          color="secondary"
          class="px-3"
          shape="rounded-pill"
          title="Cancelar"
          @click="cancel"
        >
          Cancelar
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
