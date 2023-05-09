<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import FormLabel from '@/Components/Form/FormLabel.vue'
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  user: Object,
  delegaciones: Array,
  errors: Object
})
const form = useForm({
  name: props.user.name,
  numeroDocumento: props.user.numero_documento,
  delegacion: props.user.delegacion_id
})
const submit = () => {
  form.patch(`/users/${props.user.id}`)
}
const cancel = () => {
  Inertia.get('/users')
}
</script>
<template>
  <AppLayout
    :breadcrumb="breadcrumbs.usersUpdate"
    title="Modificar datos de usuario"
  >
    <CForm @submit.prevent="submit">
      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Apellido y nombre</FormLabel>
          <CFormInput
            v-model="form.name"
            type="text"
            :feedback="props.errors.name"
            :invalid="props.errors.name"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Nro. Documento</FormLabel>
          <CFormInput
            v-model="form.numeroDocumento"
            type="text"
            :feedback="props.errors.numeroDocumento"
            :invalid="props.errors.numeroDocumento"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Delegaciones</FormLabel>
          <CFormSelect
            v-model="form.delegacion"
            :feedback="props.errors.delegacion"
            :invalid="props.errors.delegacion"
          >
            <option :value="''">Seleccione una opción</option>
            <option
              v-for="delegacion in props.delegaciones"
              :key="delegacion.id"
              :value="delegacion.id"
            >
              {{ delegacion.nombre }}
            </option>
          </CFormSelect>
        </CCol>
      </CRow>
      <CRow>
        <CCol xs="4">
          <CButton
            type="submit"
            color="primary"
            class="px-4 me-4"
            shape="rounded-pill"
            title="Guardar"
          >
            Guardar
          </CButton>
          <CButton
            type="button"
            color="secondary"
            class="px-4"
            shape="rounded-pill"
            title="Cancelar"
            @click="cancel"
          >
            Cancelar
          </CButton>
        </CCol>
      </CRow>
    </CForm>
  </AppLayout>
</template>
