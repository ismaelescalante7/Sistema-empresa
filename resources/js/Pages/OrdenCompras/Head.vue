<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'
import Tab from '../../Components/Tab.vue'
import tabs from '../../Data/OrdenCompra/Tabs.js'
import { computed, onMounted, ref } from 'vue'
import Errors from '../../Utils/formatError'
import {useOrdenCompraStore} from '../../store/useOrdenCompra'
const { getErrorMessage, getBooleanError } = Errors()
import { storeToRefs } from 'pinia'
import vSelect from "vue-select";

const props = defineProps({
  proveedores: Array,
  condicionesPagos: Array,
})

const ordenCompra = useOrdenCompraStore();
const { 
  proveedor_id,
  proveedor, 
  descripcion, 
  condicion_pago,
  condiciones_pagos_id,
  fecha
} = storeToRefs(ordenCompra)

const validateHead  = () => {
  axios.post(route('orden.compra.process.head'), ordenCompra.getHead)
  .then((res) => {
    emit('next', true)
  })
  .catch((err) => {
    const status = err.response.status
    if (status === 422) {
      errorsAxios.value = err.response.data.errors
    }
  })
}

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

function proveedorById(proveedorId) {
  proveedor.value = props.proveedores.find( proveedor => proveedor.id == proveedorId)
}

function condicionPagoById(condicionPagoId) {
  condicion_pago.value = props.condicionesPagos.find( condicionPago => condicionPago.id == condicionPagoId)
}

const whileSelection = () => {
  proveedor_id.value = proveedor.value.id
}

</script>

<template>
    <CRow >
      <CCol xs="5">
        <CRow class="my-3">
          <CCol>
            <FormLabel required>Descripción</FormLabel>
            <CFormInput v-model="descripcion" type="text" placeholder="Descripción"
              :feedback="getErrorMessage(errors?.descripcion)" :invalid="getBooleanError(errors?.descripcion)" 
              />
          </CCol>
        </CRow>
        <CRow class="my-3">
          <CCol>
            <CFormLabel required>Proveedor</CFormLabel>
            <vSelect
              v-model="proveedor"
              :options="props.proveedores"
              label="razon_social"
              :class="{ 'is-invalid': errors?.proveedor_id }"
              @option:selected="whileSelection"
            >
              <template #no-options="{ search, searching, loading }">
                Sin resultados
              </template>
            </vSelect>
          </CCol>
        </CRow>
        <CRow class="my-3">
          <CCol>
            <FormLabel required>Condicion de pago</FormLabel>
            <CFormSelect 
              v-model="condiciones_pagos_id" 
              :feedback="getErrorMessage(errors?.condiciones_pagos_id)"
              :invalid="getBooleanError(errors?.condiciones_pagos_id)"
              @update:modelValue = "condicionPagoById"
            >
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
            <CFormInput 
              v-model="fecha" 
              type="date"
              :feedback="getErrorMessage(errors?.fecha)" 
              :invalid="getBooleanError(errors?.fecha)" 
            />
          </CCol>
        </CRow>
      </CCol>
    </CRow>
    <CRow>
      <div class="d-flex justify-content-end">
        <CButton type="button" @click="validateHead()" color="primary" class="px-4 me-2" shape="rounded-pill" title="Guardar">
          Siguiente
        </CButton>
        <CButton type="button" color="secondary" class="px-4" shape="rounded-pill" title="Cancelar" @click="back">
          Cancelar
        </CButton>
      </div>
    </CRow>
</template>
