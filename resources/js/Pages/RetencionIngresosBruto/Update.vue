<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'

const props = defineProps({
    retencionIngresosBruto: Object
})
const form = useForm({
  descripcion: props.retencionIngresosBruto.descripcion,
  porcentaje: props.retencionIngresosBruto.porcentaje,
})

const submit = () => {
  form.patch(route('retencion.ingresos.bruto.update', props.retencionIngresosBruto.id))
}

const back = () => {
  Inertia.get(route('retencion.ingresos.bruto.index'))
}
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.retencionIngresosBrutosUpdate"
    title="Modificar Retencion de ingresos bruto"
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
      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Porcentaje</FormLabel>
          <CFormInput
            v-model="form.porcentaje"
            type="text"
            placeholder="Porcentaje"
            :feedback="form.errors.porcentaje"
            :invalid="form.errors.porcentaje"
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
