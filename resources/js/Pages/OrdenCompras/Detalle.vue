<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'
import Tab from '../../Components/Tab.vue'
import tabs from '../../Data/OrdenCompra/Tabs.js'
import FormInputAutocomplete from  '../../Components/Form/FormInputAutocomplete.vue'
import { computed, reactive, ref } from 'vue'
import CircleButton from '../../Components/CircleButton.vue'

const props = defineProps({
  proveedores: Array,
  condicionesPagos: Array,
  productos: Array
})

const form = useForm({
  descripcion: null,
  proveedor_id: null,
  condiciones_pagos_id: null,
  neto: null,
  iva: null,
  total: null,
  estado: null,
  producto_id: null,
  cantidad: null,
  monto: null
})

const submit = () => {
  form.post(route('orden.compras.store'))
}

const back = () => {
  Inertia.get(route('orden.compras.index'))
}

const productoSelected = ref(null)
const listProductos = reactive([])
const producto = ref(null)
const selection = (productoSelected) => {
  form.producto_id = productoSelected.id
  producto.value = props.productos.find(item => item.id === productoSelected.id)
}

const addProducto = () => {
  listProductos.push(producto.value)
}

console.log(listProductos)

</script>

<template>
  <AppLayout :breadcrumb="breadcrumbs.ordenComprasCreate" title="Detalles">
    <Tab :tabs="tabs" />
    <CForm @submit.prevent="submit">
      <CRow>
          <CRow class="my-3">
            <CCol xs="5">
                <CFormLabel>Producto</CFormLabel>
                <FormInputAutocomplete
                    label="nombre"
                    value="id"
                    :items="props.productos.map(({nombre, id}) => ({nombre, id}))"
                    :key="productoSelected"
                    @onSelect="selection"
                />
            </CCol>
            <CCol>
              <FormLabel required>Cantidad</FormLabel>
              <CFormInput v-model="form.cantidad" type="text" placeholder="Cantidad"
                :feedback="form.errors.cantidad" :invalid="form.errors.cantidad" 
                />
            </CCol>
            <CCol>
              <FormLabel required>Monto</FormLabel>
              <CFormInput v-model="form.monto" type="text" placeholder="Monto"
                :feedback="form.errors.monto" :invalid="form.errors.monto" 
                />
            </CCol>
            <CCol  class="d-flex align-items-end justify-content-end btn-margin">
                <CButton type="button" @click="addProducto()" color="primary" class="px-4 me-4" shape="rounded-pill" title="Guardar">
                    Agregar
                </CButton>
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
                <CTable class="mt-3 ms-1">
                <CTableHead>
                <CTableRow color="secondary">
                    <CTableHeaderCell scope="col" class="col-sm-1"></CTableHeaderCell>
                    <CTableHeaderCell scope="col" class="col-sm-2">Codigo</CTableHeaderCell>
                    <CTableHeaderCell scope="col" class="col-sm-2">Nombre</CTableHeaderCell>
                    <CTableHeaderCell scope="col" class="col-sm-2">Cantidad</CTableHeaderCell>
                    <CTableHeaderCell scope="col" class="col-sm-1">Costo</CTableHeaderCell>
                    <CTableHeaderCell scope="col" class="col-sm-2">Subtotal</CTableHeaderCell>
                </CTableRow>
                </CTableHead>
                <CTableBody>
                <CTableRow
                    v-for="producto in listProductos"
                    :key="producto.id"
                    class="cell-center"
                >
                    <CTableDataCell>
                    <CircleButton
                        class="ms-1"
                        title="Modificar"
                        @click="update(producto.id)"
                    >
                        <span class="fa-solid fa-pen-to-square"></span>
                    </CircleButton>
                    <CircleButton
                        class="ms-1"
                        title="Eliminar"
                        @click="showModal(true, producto)"
                    >
                        <span class="fa-solid fa-trash-can"></span>
                    </CircleButton>
                    </CTableDataCell>
                    <CTableDataCell>{{ producto.codigo }}</CTableDataCell>
                    <CTableDataCell>{{ producto.nombre }}</CTableDataCell>
                    <CTableDataCell>{{ producto.precio_compra }}</CTableDataCell>
                    <CTableDataCell>{{ 2 }}</CTableDataCell>
                    <CTableDataCell>{{ producto.precio_compra + 2 }}</CTableDataCell>
                </CTableRow>
                </CTableBody>
            </CTable>
            <div style="text-align: center;">
                Agregar items.
            </div>
            </CCol>
          </CRow>
      </CRow>
      <CRow>
        <CCol xs="4" >
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
