<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'

const form = useForm({
  name: null,
  description: null
})

const submit = () => {
  form.transform(data => ({
    ...data,
    name: form.name === null ? form.name : form.name.toUpperCase()
  })).post('/roles')
}

const back = () => {
  Inertia.get('/roles')
}

</script>
<template>
  <AppLayout
    :breadcrumb="breadcrumbs.rolesCreate"
    title="Nuevo rol"
  >
    <CForm @submit.prevent="submit">
      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Abreviatura</FormLabel>
          <CFormInput
            v-model="form.name"
            type="text"
            placeholder="Abreviatura"
            :feedback="form.errors.name"
            :invalid="form.errors.name"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Nombre de Rol</FormLabel>
          <CFormInput
            v-model="form.description"
            type="text"
            placeholder="Nombre de rol"
            :feedback="form.errors.description"
            :invalid="form.errors.description"
          />
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
