<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import breadcrumbs from '@/Data/Breadcrumbs'
import { Inertia } from '@inertiajs/inertia'
import { ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
  user: Object,
})

const form = useForm({
  image: null
})

const file = ref(null)

function chooseFile () {
  file.value.$el.nextElementSibling.click()
}

function setFile (e) {
  const file = e.target.files[0]
  const reader = new FileReader()
  reader.readAsDataURL(file)
  reader.onload = () => {
    const img = new Image()
    img.src = reader.result
    img.onload = () => {
      if (img.width > 400 || img.height > 400) {
        form.errors.image = 'Las dimensiones de la imagen no deben superar los 400x400 pixeles.'
      } else if (file.size > 2 * 1024 * 1024) {
        form.errors.image = 'El tamaño no debe superar los 2 mb de capacidad.'
      } else {
        form.image = file
        submitFile()
      }
    }
  }
}

function removeFile () {
  form.image = null
  submitFile()
}

function submitFile () {
  form.post(`/users/${props.user.id}/image-upload`)
}

const passwordChange = () => {
  Inertia.get(route('change.password'))
}

</script>
<template>
  <AppLayout
    :breadcrumb="breadcrumbs.profileShow"
    title="Perfil de usuario"
  >
    <CRow>
      <CCol xs="10">
        <CRow>
          <CCol><strong>Nombre y apellido:</strong> {{ props.user.name }}</CCol>
        </CRow>
        <CRow>
          <CCol><strong>Nro. documento:</strong> {{ props.user.numero_documento }}</CCol>
        </CRow>
        <CRow>
          <CCol><strong>Email:</strong> {{ props.user.email }}</CCol>
        </CRow>
        <CRow>
          <CCol><strong>Rol:</strong> {{ 'Roles' }}</CCol>
        </CRow>
        <CRow class="my-3">
          <CCol>
            <CButton
              color="primary"
              class="px-4 me-1"
              shape="rounded-pill"
              title="Cambiar contraseña"
              @click="passwordChange"
            >
              Cambiar contraseña
            </CButton>
          </CCol>
        </CRow>
      </CCol>
      <CCol
        xs="2"
        class="text-center"
      >
        <CImage
          :src="props.user.profile_photo"
          class="mb-4"
          :class="{'image_rounded' : !props.user.has_profile_photo}"
          width="300"
          height="300"
          fluid
        />
        <CFormInput
          type="file"
          id="upload-file"
          @input='setFile'
          :feedback="form.errors.image"
          :invalid="form.errors.image"
          ref="file"
          hidden />
        <CButton
          v-if="!props.user.has_profile_photo"
          for="upload-file"
          color="primary"
          class="px-4 me-1"
          shape="rounded-pill"
          title="Cargar foto"
          @click="chooseFile()"
        >
          Cargar foto
        </CButton>
        <br>
        <CButton
          v-if="props.user.has_profile_photo"
          for="upload-file"
          color="primary"
          class="px-4 me-1"
          shape="rounded-pill"
          title="Cargar foto"
          @click="removeFile()"
        >
          Eliminar foto
        </CButton>
      </CCol>
    </CRow>
  </AppLayout>
</template>
<style scoped>
.image_rounded {
  border-radius: 50%;
  background-size: 100% auto;
  object-fit: cover;
}
</style>