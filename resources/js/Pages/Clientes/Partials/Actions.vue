<script setup>
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
import CircleButton from '@/Components/CircleButton.vue'
import { hasPermission } from '@/Helpers/permissions'

const props = defineProps({
  filters: Object
})

const form = useForm({
  numero_documento: props.filters.numero_documento,
  apellido_nombre: props.filters.apellido_nombre,
  isFilled () {
    return !!(this.numero_documento || this.apellido_nombre)
  }
})

const search = () => {
  form.get('/clientes', {
    preserveState: true
  })
}

const clean = () => {
  Inertia.get('/clientes')
}

const create = () => {
  Inertia.get('/clientes/create')
}
</script>

<template>
  <CForm @submit.prevent="search">
    <CRow>
      <CCol>
        <CFormInput
          v-model="form.apellido_nombre"
          type="text"
          label="Apellido y Nombre"
          :invalid="form.errors.apellido_nombre !== undefined"
          :feedback="form.errors.apellido_nombre"
        />
      </CCol>
      <CCol>
        <CFormInput
          v-model="form.numero_documento"
          type="text"
          label="Número de Documento"
          :invalid="form.errors.numero_documento !== undefined"
          :feedback="form.errors.numero_documento"
        />
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
      <CCol class="d-flex align-items-start justify-content-end btn-margin">
        <CButton
          v-if="hasPermission($page, 'clientes.create')"
          color="primary"
          class="px-4"
          shape="rounded-pill"
          title="Nuevo"
          @click="create"
        >
          Nuevo
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
