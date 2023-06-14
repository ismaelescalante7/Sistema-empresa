<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import {useOrdenCompraStore} from '../../store/useOrdenCompra'
import {useOrdenCompraDetalleStore} from '../../store/useDetalleOrdenCompra'

const detalleOrdenCompra = useOrdenCompraDetalleStore();
const ordenCompra = useOrdenCompraStore();

</script>

<template>
<CCard>
  <CCardBody>
    <CCardTitle>Orden Compra</CCardTitle>
    <CCardSubtitle class="mb-2 text-muted">Resumen</CCardSubtitle>
    <CTableBody class="table-borderless">
        <CTableRow class="col">
            <CTableDataCell class="d-flex justify-content-end">Descripcion:</CTableDataCell>
            <CTableDataCell class="fw-bold px-3"> {{ ordenCompra.$state?.descripcion }}</CTableDataCell>
        </CTableRow>

        <CTableRow>
            <CTableDataCell class="d-flex justify-content-end ms-2">Proveedor:</CTableDataCell>
            <CTableDataCell class="fw-bold px-3">{{ ordenCompra.$state?.proveedor?.razon_social }}</CTableDataCell>
        </CTableRow>

        <CTableRow>
            <CTableDataCell class="d-flex justify-content-end ms-2">Fecha:</CTableDataCell>
            <CTableDataCell class="fw-bold px-3">{{ ordenCompra.$state?.fecha }}</CTableDataCell>
        </CTableRow>
        <CTableRow>
            <CTableDataCell class="d-flex justify-content-end ms-2">Condicion de Pago:</CTableDataCell>
            <CTableDataCell class="fw-bold px-3">{{ ordenCompra.$state?.condicion_pago?.condicion  }}</CTableDataCell>
        </CTableRow>
    </CTableBody>
    <CTable class="mt-3 ms-1">
            <CTableHead>
            <CTableRow color="secondary">
                <CTableHeaderCell scope="col" class="col-sm-2">Codigo</CTableHeaderCell>
                <CTableHeaderCell scope="col" class="col-sm-2">Nombre</CTableHeaderCell>
                <CTableHeaderCell scope="col" class="col-sm-2">Cantidad</CTableHeaderCell>
                <CTableHeaderCell scope="col" class="col-sm-1">Costo</CTableHeaderCell>
                <CTableHeaderCell scope="col" class="col-sm-2">Subtotal</CTableHeaderCell>
            </CTableRow>
            </CTableHead>
            <CTableBody>
            <CTableRow
                v-for="producto in ordenCompra.$state.detalles"
                :key="producto.id"
                class="cell-center"
            >
                <CTableDataCell>{{ producto.producto.codigo }}</CTableDataCell>
                <CTableDataCell>{{ producto.producto.nombre }}</CTableDataCell>
                <CTableDataCell>{{ producto.cantidad }}</CTableDataCell>
                <CTableDataCell>{{ producto.precio_compra }}</CTableDataCell>
                <CTableDataCell>{{ producto.precio_compra * producto.cantidad }}</CTableDataCell>
            </CTableRow>
            </CTableBody>
        </CTable>
  </CCardBody>
</CCard>
    

    <CRow class="m-4">
        <CCol xs="4">
        <CButton
            type="button"
            color="secondary"
            class="px-4"
            shape="rounded-pill"
            title="Volver"
        >
            Volver
        </CButton>
        </CCol>
    </CRow>
</template>