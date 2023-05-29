<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'

const form = useForm({
  nombre: null,
  descripcion: null,
  precio: null,
  categoria_id: null,
  cantidad: null
})

const props = defineProps({
  categorias: Array
})

const submit = () => {
  form.post(route('productos.store'))
}

const back = () => {
  Inertia.get(route('productos.index'))
}
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.productosCreate"
    title="Nuevo producto"
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
      <CRow class="mb-3">
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
          <FormLabel required>Cantidad</FormLabel>
          <CFormInput
            v-model="form.cantidad"
            type="number"
            placeholder="Cantidad"
            :feedback="form.errors.cantidad"
            :invalid="form.errors.cantidad"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Precio</FormLabel>
          <CFormInput
            v-model="form.precio"
            type="number"
            placeholder="Precio"
            :feedback="form.errors.precio"
            :invalid="form.errors.precio"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Categoria</FormLabel>
          <CFormInput
            v-model="form.categoria_id"
            type="number"
            placeholder="Categoria"
            :feedback="form.errors.categoria_id"
            :invalid="form.errors.categoria_id"
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
