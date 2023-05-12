<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'

const props = defineProps({
  role: Object,
  errors: Object
})

const isDisabled = () => {
  return (props.role.name === form.name && props.role.description === form.description)
}

const form = useForm({
  name: props.role.name,
  description: props.role.description
})

const submit = () => {
  form.patch(`/roles/${props.role.id}`)
}

const back = () => {
  Inertia.get('/roles')
}

</script>
<template>
  <AppLayout
    :breadcrumb="breadcrumbs.rolesUpdate"
    title="Modificar rol"
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
            :change="isDisabled()"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Nombre de Rol</FormLabel>
          <CFormInput
            v-model="form.description"
            type="text"
            placeholder="Nombre de Rol"
            :feedback="form.errors.description"
            :invalid="form.errors.description"
            :change="isDisabled()"
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
            :disabled="isDisabled()"
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
