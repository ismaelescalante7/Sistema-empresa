<script setup>
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'

const props = defineProps({
  filters: Object,
})

const form = useForm({
  razon_social: props.filters.razon_social,
  isFilled () {
    return !!(this.razon_social )
  }
})

const search = () => {
  form.get('/proveedores', {
    preserveState: true
  })
}

const clean = () => {
  Inertia.get('/proveedores')
}

const create = () => {
  Inertia.get('/proveedores/create')
}
</script>

<template>
  <CForm @submit.prevent="search">
    <CRow>
      <CCol>
        <CFormInput
          v-model="form.razon_social"
          type="text"
          label="Descripcion"
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
