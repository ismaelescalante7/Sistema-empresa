<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'

const form = useForm({
  name: null,
  numeroDocumento: null,
  email: null,
  delegacion: null
})

const props = defineProps({
  delegaciones: Array
})

const submit = () => {
  form.post('/users')
}

const back = () => {
  Inertia.get('/users')
}
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.usersCreate"
    title="Nuevo usuario"
  >
    <CForm @submit.prevent="submit">
      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Apellido y nombre</FormLabel>
          <CFormInput
            v-model="form.name"
            type="text"
            placeholder="Apellido y nombre"
            :feedback="form.errors.name"
            :invalid="form.errors.name"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Nro. Documento</FormLabel>
          <CFormInput
            v-model="form.numeroDocumento"
            type="text"
            placeholder="Nro. Documento"
            :feedback="form.errors.numeroDocumento"
            :invalid="form.errors.numeroDocumento"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Email</FormLabel>
          <CFormInput
            v-model="form.email"
            type="email"
            placeholder="Email"
            :feedback="form.errors.email"
            :invalid="form.errors.email"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Delegación</FormLabel>
          <CFormSelect
            v-model="form.delegacion"
            :feedback="form.errors.delegacion"
            :invalid="form.errors.delegacion"
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
            @click="back"
          >
            Cancelar
          </CButton>
        </CCol>
      </CRow>
    </CForm>
  </AppLayout>
</template>
