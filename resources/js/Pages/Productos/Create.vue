<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'

const form = useForm({
  codigo: null,
  nombre: null,
  categoria_id: null,
  precio_compra: null,
  precio_venta: null,
  stock_minimo: null,
  alicuota: null,
  estado: null,
  marca_id: null,
  rubro_id: null,
  compra: null,
  vende: null,
  stockeable: null,
  retencion_ganancia_id: null,
  retencion_ingreso_bruto_id: null
})

const props = defineProps({
  categorias: Array,
  marcas: Array,
  rubros: Array,
  retencionGanancias: Array,
  retencionIngresosBrutos: Array
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
        <CCol xs="5">
          <FormLabel required>Codigo</FormLabel>
          <CFormInput
            v-model="form.codigo"
            type="text"
            placeholder="Descripción"
            :feedback="form.errors.codigo"
            :invalid="form.errors.codigo"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Stock Minimo</FormLabel>
          <CFormInput
            v-model="form.stock_minimo"
            type="number"
            placeholder="Stock minimo"
            :feedback="form.errors.stock_minimo"
            :invalid="form.errors.stock_minimo"
          />
        </CCol>
        <CCol xs="5">
          <FormLabel required>Alicuota</FormLabel>
          <CFormInput
            v-model="form.alicuota"
            type="number"
            placeholder="Alicuota"
            :feedback="form.errors.alicuota"
            :invalid="form.errors.alicuota"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Precio Compra</FormLabel>
          <CFormInput
            v-model="form.precio_compra"
            type="number"
            placeholder="Precio "
            :feedback="form.errors.precio_compra"
            :invalid="form.errors.precio_compra"
          />
        </CCol>
        <CCol xs="5">
          <FormLabel required>Precio Venta</FormLabel>
          <CFormInput
            v-model="form.precio_venta"
            type="number"
            placeholder="Precio "
            :feedback="form.errors.precio_venta"
            :invalid="form.errors.precio_venta"
          />
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Retención Ganancia</FormLabel>
          <CFormSelect v-model="form.retencion_ganancia_id" :feedback="form.errors.retencion_ganancia_id"
            :invalid="form.errors.retencion_ganancia_id">
            <option :value="''">Seleccione una opción</option>
            <option v-for="retencionGanancia in props.retencionGanancias" :key="retencionGanancia.id" :value="retencionGanancia.id">
              {{ retencionGanancia.codigo }}
            </option>
          </CFormSelect>
        </CCol>
        <CCol xs="5">
          <FormLabel required>Retención Ingreso Bruto</FormLabel>
          <CFormSelect v-model="form.retencion_ingreso_bruto_id" :feedback="form.errors.retencion_ingreso_bruto_id"
            :invalid="form.errors.retencion_ingreso_bruto_id">
            <option :value="''">Seleccione una opción</option>
            <option v-for="retencionIngresoBruto in props.retencionIngresosBrutos" :key="retencionIngresoBruto.id" :value="retencionIngresoBruto.id">
              {{ retencionIngresoBruto.descripcion }}
            </option>
          </CFormSelect>
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Marca</FormLabel>
          <CFormSelect v-model="form.marca_id" :feedback="form.errors.marca_id"
            :invalid="form.errors.marca_id">
            <option :value="''">Seleccione una opción</option>
            <option v-for="marca in props.marcas" :key="marca.id" :value="marca.id">
              {{ marca.nombre }}
            </option>
          </CFormSelect>
        </CCol>
        <CCol xs="5">
          <FormLabel required>Rubros</FormLabel>
          <CFormSelect v-model="form.rubro_id" :feedback="form.errors.rubro_id"
            :invalid="form.errors.rubro_id">
            <option :value="''">Seleccione una opción</option>
            <option v-for="rubro in props.rubros" :key="rubro.id" :value="rubro.id">
              {{ rubro.nombre }}
            </option>
          </CFormSelect>
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Compra</FormLabel>
          <CFormSelect
            v-model="form.compra"
            :feedback="form.errors.compra"
            :invalid="form.errors.compra"
          >
            <option :value="0">Seleccione una opción</option>
            <option :value="1">Si</option>
            <option :value="0">No</option>
          </CFormSelect>
        </CCol>
        <CCol xs="5">
          <FormLabel required>Vende</FormLabel>
          <CFormSelect
            v-model="form.vende"
            :feedback="form.errors.vende"
            :invalid="form.errors.vende"
          >
            <option :value="0">Seleccione una opción</option>
            <option :value="1">Si</option>
            <option :value="0">No</option>
          </CFormSelect>
        </CCol>
      </CRow>
      <CRow class="mb-3">
        <CCol xs="5">
          <FormLabel required>Stockeable</FormLabel>
          <CFormSelect
            v-model="form.stockeable"
            :feedback="form.errors.stockeable"
            :invalid="form.errors.stockeable"
          >
            <option :value="0">Seleccione una opción</option>
            <option :value="1">Si</option>
            <option :value="0">No</option>
          </CFormSelect>
        </CCol>
        <CCol xs="5">
          <FormLabel required>Estado</FormLabel>
          <CFormSelect
            v-model="form.vende"
            :feedback="form.errors.vende"
            :invalid="form.errors.vende"
          >
            <option :value="0">Seleccione una opción</option>
            <option :value="1">Si</option>
            <option :value="0">No</option>
          </CFormSelect>
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
