<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'

const props = defineProps({
    condicionIva: Object
})
const form = useForm({
  codigo: props.condicionIva.codigo,
  descripcion: props.condicionIva.descripcion,
})

const submit = () => {
  form.patch(route('condiciones.ivas.update', props.condicionIva.id))
}

const back = () => {
  Inertia.get(route('condiciones.ivas.index'))
}
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.condicionesIvasUpdate"
    title="Modificar condición iva"
  >
    <CForm @submit.prevent="submit">
       <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Codigo</FormLabel>
          <CFormInput
            v-model="form.codigo"
            type="text"
            placeholder="Codigo"
            :feedback="form.errors.codigo"
            :invalid="form.errors.codigo"
          />
        </CCol>
      </CRow>
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
