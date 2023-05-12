<script setup>
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
import CircleButton from '../../../Components/CircleButton.vue'
import { hasPermission } from '../../../Helpers/permissions'

const props = defineProps({
  filters: Object
})

const form = useForm({
  name: props.filters.name,
  descrption: props.filters.descrption,
  isFilled () {
    return !!(this.name || this.descrption)
  }
})

const search = () => {
  form.get('/roles', {
    preserveState: true
  })
}

const clean = () => {
  Inertia.get('/roles')
}

const create = () => {
  Inertia.get('/roles/create')
}
</script>

<template>
  <CForm @submit.prevent="search">
    <CRow>
      <CCol>
        <CFormInput
          v-model="form.name"
          type="text"
          label="Abreviatura"
        />
      </CCol>
      <CCol>
        <CFormInput
          v-model="form.descrption"
          type="text"
          label="Nombre de rol"
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
          class="ms-1"
          color="secondary"
          v-if="form.isFilled() === true"
          type="button"
          @click="clean"
          title="Limpiar"
        >
          <span class="fa-solid fa-xmark" type="submit"></span>
        </CircleButton>
      </CCol>
      <CCol class="d-flex align-items-start justify-content-end btn-margin">
        <CButton
          v-if="hasPermission($page, 'roles.create')"
          color="primary"
          class="px-4"
          shape="rounded-pill"
          title="Añadir rol"
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
