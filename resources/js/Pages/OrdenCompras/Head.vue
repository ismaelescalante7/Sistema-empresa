<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'
import Tab from '../../Components/Tab.vue'
import tabs from '../../Data/OrdenCompra/Tabs.js'
import { computed, ref } from 'vue'
import Errors from '../../Utils/formatError'
import {useOrdenCompraStore} from '../../store/useOrdenCompra'

const { getErrorMessage, getBooleanError } = Errors()

const props = defineProps({
  proveedores: Array,
  condicionesPagos: Array,
})

const form = useForm({
  descripcion: null,
  proveedor_id: null,
  condiciones_pagos_id: null,
  estado: null,
})

const ordenCompra = useOrdenCompraStore();

const nowDate = ref(new Date().toLocaleDateString());

const errorsAxios = ref(null)

const emit = defineEmits(['next'])

const errors = computed(() => {
  if (errorsAxios.value) {
    return errorsAxios.value
  }
  return props.errors
})

const back = () => {
  Inertia.get(route('orden.compras.index'))
}

const createHead = () => {
  axios.post(route('orden.compra.process.head'), form)
    .then((res) => {
      console.log('entre')
      ordenCompra.$state.condiciones_pagos_id = form.condiciones_pagos_id
      ordenCompra.$state.descripcion = form.descripcion
      ordenCompra.$state.proveedor_id = form.proveedor_id
      emit('next', true)
    })
    .catch((err) => {
      const status = err.response.status
      //loading.value = false
      if (status === 422) {
        errorsAxios.value = err.response.data.errors
    }
  })
}
</script>

<template>
    <CRow >
      <CCol xs="5">
        <CRow class="my-3">
          <CCol>
            <FormLabel required>Descripción</FormLabel>
            <CFormInput v-model="form.descripcion" type="text" placeholder="Descripción"
              :feedback="getErrorMessage(errors?.descripcion)" :invalid="getBooleanError(errors?.descripcion)" 
              />
          </CCol>
        </CRow>
        <CRow class="my-3">
          <CCol>
            <FormLabel required>Proveedor</FormLabel>
            <CFormSelect v-model="form.proveedor_id" :feedback="getErrorMessage(errors?.proveedor_id)"
              :invalid="getBooleanError(errors?.proveedor_id)">
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
            <CFormSelect v-model="form.condiciones_pagos_id" :feedback="getErrorMessage(errors?.condiciones_pagos_id)"
              :invalid="getBooleanError(errors?.condiciones_pagos_id)">
              <option :value="''">Seleccione una opción</option>
              <option v-for="condicionPago in props.condicionesPagos" :key="condicionPago.id" :value="condicionPago.id">
                {{ condicionPago.condicion }}
              </option>
            </CFormSelect>
          </CCol>
        </CRow>
        <CRow class="my-3">
          <CCol>
            <FormLabel >Fecha</FormLabel>
            <CFormInput v-model="nowDate" type="text"/>
          </CCol>
        </CRow>
      </CCol>
    </CRow>
    <CRow>
      <div class="d-flex justify-content-end">
        <CCol xs="4">
          <CButton type="button" @click="createHead()" color="primary" class="px-4 me-4" shape="rounded-pill" title="Guardar">
            Siguiente
          </CButton>
          <CButton type="button" color="secondary" class="px-4" shape="rounded-pill" title="Cancelar" @click="back">
            Cancelar
          </CButton>
        </CCol>
      </div>
      
    </CRow>
</template>
