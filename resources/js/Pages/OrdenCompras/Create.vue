<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'

const props = defineProps({
  proveedores: Array,
  condicionesPagos: Array,
})

const form = useForm({
  descripcion: null,
  proveedor_id: null,
  condiciones_pagos_id: null,
  neto: null,
  iva: null,
  total: null,
  estado: null,
})

const submit = () => {
  form.post(route('orden.compras.store'))
}

const back = () => {
  Inertia.get(route('orden.compras.index'))
}
</script>

<template>
  <AppLayout :breadcrumb="breadcrumbs.ordenComprasCreate" title="Nuevo orden de compra">
    <CForm @submit.prevent="submit">
      <CRow>
        <CCol xs="5">
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Descripción</FormLabel>
              <CFormInput v-model="form.descripcion" type="text" placeholder="Descripción"
                :feedback="form.errors.descripcion" :invalid="form.errors.descripcion" />
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Proveedor</FormLabel>
              <CFormSelect v-model="form.proveedor_id" :feedback="form.errors.proveedor_id"
                :invalid="form.errors.proveedor_id">
                <option :value="''">Seleccione una opción</option>
                <option v-for="proveedor in props.proveedores" :key="proveedor.id" :value="proveedor.id">
                  {{ proveedor.razon_social }}
                </option>
              </CFormSelect>
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Condicion de pago</FormLabel>
              <CFormSelect v-model="form.condiciones_pagos_id" :feedback="form.errors.condiciones_pagos_id"
                :invalid="form.errors.condiciones_pagos_id">
                <option :value="''">Seleccione una opción</option>
                <option v-for="condicionPago in props.condicionesPagos" :key="condicionPago.id" :value="condicionPago.id">
                  {{ condicionPago.condicion }}
                </option>
              </CFormSelect>
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Estado</FormLabel>
              <CFormSelect v-model="form.estado" :feedback="form.errors.estado" :invalid="form.errors.estado">
                <option :value="''">Seleccione una opción</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </CFormSelect>
            </CCol>
          </CRow>
        </CCol>
        <CCol xs="5">
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Neto</FormLabel>
              <CFormInput v-model="form.neto" type="text" placeholder="Neto" :feedback="form.errors.neto"
                :invalid="form.errors.neto" />
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Iva</FormLabel>
              <CFormInput v-model="form.iva" type="text" placeholder="Iva" :feedback="form.errors.iva"
                :invalid="form.errors.iva" />
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Total</FormLabel>
              <CFormInput v-model="form.total" type="text" placeholder="Total" :feedback="form.errors.total"
                :invalid="form.errors.total" />
            </CCol>
          </CRow>
        </CCol>
      </CRow>
      <CRow>
        <CCol xs="4">
          <CButton type="submit" color="primary" class="px-4 me-4" shape="rounded-pill" title="Guardar">
            Guardar
          </CButton>
          <CButton type="button" color="secondary" class="px-4" shape="rounded-pill" title="Cancelar" @click="back">
            Cancelar
          </CButton>
        </CCol>
      </CRow>
    </CForm>
  </AppLayout>
</template>
