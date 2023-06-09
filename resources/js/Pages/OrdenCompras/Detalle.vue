<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'
import Tab from '../../Components/Tab.vue'
import tabs from '../../Data/OrdenCompra/Tabs.js'
import FormInputAutocomplete from  '../../Components/Form/FormInputAutocomplete.vue'
import { reactive, ref } from 'vue'
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

const selection = (producto) => {
  form.producto_id = producto.id
}

const producto = ref(false)
const listProductos = reactive([])
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
                    :key="producto"
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
                <CButton type="submit" color="primary" class="px-4 me-4" shape="rounded-pill" title="Guardar">
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
                    <CTableHeaderCell scope="col" class="col-sm-3">Codigo</CTableHeaderCell>
                    <CTableHeaderCell scope="col" class="col-sm-3">Nombre</CTableHeaderCell>
                    <CTableHeaderCell scope="col" class="col-sm-3">Precio</CTableHeaderCell>
                    <CTableHeaderCell scope="col" class="col-sm-3">Iva</CTableHeaderCell>
                    <CTableHeaderCell scope="col" class="col-sm-3">Estado</CTableHeaderCell>
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
                        v-if="hasPermission($page, 'orden.compras.edit')"
                        @click="update(producto.id)"
                    >
                        <span class="fa-solid fa-pen-to-square"></span>
                    </CircleButton>
                    <CircleButton
                        v-if="hasPermission($page, 'orden.compras.destroy')"
                        class="ms-1"
                        title="Eliminar"
                        @click="showModal(true, producto)"
                    >
                        <span class="fa-solid fa-trash-can"></span>
                    </CircleButton>
                    </CTableDataCell>
                    <CTableDataCell>{{ producto }}</CTableDataCell>
                    <CTableDataCell>{{ producto }}</CTableDataCell>
                    <CTableDataCell>{{ producto }}</CTableDataCell>
                    <CTableDataCell>{{ producto }}</CTableDataCell>
                    <CTableDataCell>{{ producto }}</CTableDataCell>
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
