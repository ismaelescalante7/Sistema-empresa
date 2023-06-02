<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'

const props = defineProps({
    planCuenta: Object
})
const form = useForm({
  descripcion: props.planCuenta.descripcion,
  imputable: props.planCuenta.imputable,
})

const submit = () => {
  form.patch(route('planes.cuentas.update', props.planCuenta.id))
}

const back = () => {
  Inertia.get(route('planes.cuentas.index'))
}
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.planesCuentasUpdate"
    title="Modificar plan de cuenta"
  >
    <CForm @submit.prevent="submit">
      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Descripción</FormLabel>
          <CFormInput
            v-model="form.descripcion"
            type="text"
            placeholder="Descripción"
            :feedback="form.errors.descripcion"
            :invalid="form.errors.descripcion"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel >Imputable</FormLabel>
          <CFormInput
            v-model="form.imputable"
            type="text"
            placeholder="Imputable"
            :feedback="form.errors.imputable"
            :invalid="form.errors.imputable"
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
