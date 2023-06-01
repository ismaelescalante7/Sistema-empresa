<script setup>

import AppLayout from '../../Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '../../Components/Form/FormLabel.vue'
import { Inertia } from '@inertiajs/inertia'

const form = useForm({
  currentPassword: null,
  password: null,
  passwordConfirmation: null
})
const submit = () => {
  form.post(route('change.password.store'))
}

const cancel = () => {
  Inertia.get(route('profile.show'))
}
</script>

<template>
  <AppLayout
    title="Cambiar Contraseña"
  >
    <h5 class="col-lg-3 col-md-4 col-sm-6 ">
      <CBadge
        color="warning"
        class="ms-auto p-4 text-dark"
      >
        La contraseña debe tener 8 o más caracteres, como mínimo una mayúscula, minúscula y al menos un número.
      </CBadge>
    </h5>

    <CForm @submit.prevent="submit">
      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Contraseña Actual</FormLabel>
          <CFormInput
            v-model="form.currentPassword"
            type="password"
            :feedback="form.errors.currentPassword"
            :invalid="form.errors.currentPassword"
          />
        </CCol>
      </CRow>

      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Nueva contraseña</FormLabel>
          <CFormInput
            v-model="form.password"
            type="password"
            :feedback="form.errors.password"
            :invalid="form.errors.password"
          />
        </CCol>
      </CRow>

      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Repetir nueva contraseña</FormLabel>
          <CFormInput
            v-model="form.passwordConfirmation"
            type="password"
            :feedback="form.errors.passwordConfirmation"
            :invalid="form.errors.passwordConfirmation"
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
            @click="cancel"
          >
            Cancelar
          </CButton>
        </CCol>
      </CRow>
    </CForm>
  </AppLayout>
</template>
