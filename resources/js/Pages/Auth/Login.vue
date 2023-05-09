<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3'
import ente from '@/assets/images/ente.png'

defineProps({
  message: String
})

const form = useForm({
  email: '',
  password: '',
  remember: false
})

const submit = () => {
  form.transform(data => ({
    ...data,
    remember: form.remember ? 'on' : ''
  })).post(route('login'), {
    onFinish: () => form.reset('password')
  })
}
</script>
<template>
  <div class="fondo-app">
    <div class="card-app">
      <form @submit.prevent="submit()" class="form-app">
        <CImage fluid :src="ente" class="logo-app"/>
        <div class="titulo-app my-4">Ingreso al sistema</div>
        <CAlert
          class="mt-2"
          color="success"
          variant="solid"
          dismissible
          v-if="message"
        >
          * Su contraseña fue reestablecida con éxito.
        </CAlert>
        <CAlert
          class="mt-2"
          color="danger"
          variant="solid"
          v-if="form.errors.email"
        >
          * Email y/o contraseña incorrectos, por favor intentá nuevamente.
        </CAlert>
        <CInputGroup class="mb-3 todo">
          <CInputGroupText>
            <CIcon icon="cil-user" />
          </CInputGroupText>
          <CFormInput
            placeholder="Correo electrónico"
            autocomplete="email"
            id="email"
            type="email"
            v-model="form.email"
            required
            autofocus
            class="todo"
          />
        </CInputGroup>
        <CInputGroup class="mb-4">
          <CInputGroupText>
              <CIcon icon="cil-lock-locked" />
          </CInputGroupText>
          <CFormInput
            type="password"
            placeholder="Contraseña"
            autocomplete="current-password"
            id="password"
            v-model="form.password"
            required
          />
        </CInputGroup>
        <div class="text-left-app">
          <CFormCheck
            label="Recordarme"
            v-model="form.remember"
            name="remember"
            id="remenber"
          />
        </div>
        <CRow class="mt-3">
          <CCol :xs="6" class="text-left-app">
            <button
              class="px-4 button-app button-color-app"
              type="submit"
            >
              Iniciar Sesión
            </button>
          </CCol>
          <CCol :xs="6" class="text-right-app center-link">
            <Link
              :href="route('password.request')"
              class="link-app link-color-app"
            >
              ¿Olvidaste tú contraseña?
            </Link>
          </CCol>
        </CRow>
      </form>
    </div>
  </div>
</template>
