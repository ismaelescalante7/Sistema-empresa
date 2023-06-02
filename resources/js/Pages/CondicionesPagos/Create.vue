<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'

const form = useForm({
  condicion: null,
  dias: null,
})

const submit = () => {
  form.post(route('condiciones.pagos.store'))
}

const back = () => {
  Inertia.get(route('condiciones.pagos.index'))
}
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.condicionesPagosCreate"
    title="Nuevo condicion de pago"
  >
    <CForm @submit.prevent="submit">
      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Condición</FormLabel>
          <CFormInput
            v-model="form.condicion"
            type="text"
            placeholder="Condicion"
            :feedback="form.errors.condicion"
            :invalid="form.errors.condicion"
          />
        </CCol>
      </CRow>
      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Dias</FormLabel>
          <CFormInput
            v-model="form.dias"
            type="number"
            placeholder="Dias"
            :feedback="form.errors.dias"
            :invalid="form.errors.dias"
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
