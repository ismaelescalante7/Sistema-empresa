<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import FormInputAutocomplete from  '../../Components/Form/FormInputAutocomplete.vue'
import {useOrdenCompraStore} from '../../store/useOrdenCompra'
import {useOrdenCompraDetalleStore} from '../../store/useDetalleOrdenCompra'


const props = defineProps({
  ordenCompra: Object
})
const ordenCompra = useOrdenCompraStore();
ordenCompra.fill(props.ordenCompra)

const saveOrdenCompra = () => {
    Inertia.post(route('orden.compras.store', ordenCompra.getData))
}

const back = () => {

}

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

        <CTableRow class="col">
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
                <CTableHeaderCell scope="col" class="col-sm-2">Subtotal(Impuestos)</CTableHeaderCell>
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
                <CTableDataCell>{{ producto.subtotal }}</CTableDataCell>
                <CTableDataCell>{{ producto.subtotal_impuestos }}</CTableDataCell>
            </CTableRow>
            </CTableBody>
        </CTable>
         <div class="d-flex justify-content-end" style="text-align: center;" v-if="ordenCompra.tieneDetalles">
          <CRow class="d-flex justify-content-end">
            <CTableBody class="table-borderless">
            <CTableRow>
              <CTableDataCell class="">Neto:</CTableDataCell>
              <CTableDataCell class="fw-bold px-3">{{ ordenCompra.getNeto }}</CTableDataCell>
            </CTableRow>

            <CTableRow>
              <CTableDataCell class="d-flex justify-content-end">Iva:</CTableDataCell>
              <CTableDataCell class="fw-bold px-3">{{ ordenCompra.getIva }}</CTableDataCell>
            </CTableRow>

            <CTableRow>
              <CTableDataCell class="d-flex justify-content-end">Total:</CTableDataCell>
              <CTableDataCell class="fw-bold px-3">{{ ordenCompra.getTotal }}</CTableDataCell>
            </CTableRow>
            </CTableBody>
          </CRow>
        </div>
  </CCardBody>
   <CRow>
    <div class="d-flex justify-content-end">
      <CButton type="button" color="secondary" class="px-4 me-2" shape="rounded-pill" title="Cancelar" @click="back">
        Cancelar
      </CButton>
      <CButton type="button" @click="saveOrdenCompra()" color="primary" class="px-4 me-2" shape="rounded-pill" title="Finalizar">
        Finalizar
      </CButton>
     </div>
  </CRow>
</CCard>
</template>