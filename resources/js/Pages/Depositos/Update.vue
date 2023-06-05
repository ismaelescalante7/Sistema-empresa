<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'

const props = defineProps({
    deposito: Object
})
const form = useForm({
  nombre: props.deposito.nombre
})

const submit = () => {
  form.patch(route('depositos.update', props.deposito.id))
}

const back = () => {
  Inertia.get(route('depositos.index'))
}
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.depositosUpdate"
    title="Modificar deposito"
  >
    <CForm @submit.prevent="submit">
      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Nombre</FormLabel>
          <CFormInput
            v-model="form.nombre"
            type="text"
            placeholder="Nombre"
            :feedback="form.errors.nombre"
            :invalid="form.errors.nombre"
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
