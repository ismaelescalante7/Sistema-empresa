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
import {useOrdenCompraStore} from '../../store/useOrdenCompra'
import {useOrdenCompraDetalleStore} from '../../store/useDetalleOrdenCompra'
import Errors from '../../Utils/formatError'
import Modal from  '../../Components/Modal.vue'
import showNotification from '../../Utils/notification'

const { getErrorMessage, getBooleanError } = Errors()

const props = defineProps({
  proveedores: Array,
  condicionesPagos: Array,
  productos: Array
})

const detalleOrdenCompra = useOrdenCompraDetalleStore();

const form = useForm({
  producto_id: null,
  cantidad: null,
  precio_compra: null
})

const ordenCompra = useOrdenCompraStore();

const errorsAxios = ref(null)

const emit = defineEmits(['next'])

const errors = computed(() => {
  if (errorsAxios.value) {
    return errorsAxios.value
  }
  return props.errors
})


const submit = () => {
  form.post(route('orden.compras.store'))
}

const back = () => {
  Inertia.get(route('orden.compras.index'))
}

const productoSelected = ref(null)
const productoFiltered = ref(null)
const listProductos = reactive([])
const producto = ref(null)

const selection = (productoFiltered) => {
  form.producto_id = productoFiltered.id
  productoSelected.value = props.productos.find(item => item.id === productoFiltered.id)
  form.precio_compra = productoSelected.value.precio_compra 
}

const addProducto = () => {
  createDetalle()
}

const addDetalleStore = () => {
  detalleOrdenCompra.$state.producto_id = form.producto_id
  detalleOrdenCompra.$state.precio_compra = parseFloat(form.precio_compra)
  detalleOrdenCompra.$state.cantidad = parseInt(form.cantidad)
  detalleOrdenCompra.$state.producto = productoSelected.value
  detalleOrdenCompra.cacularSubtotal()
  detalleOrdenCompra.cacularSubtotalConImpuestos()
}

const createDetalle = () => {
  axios.post(route('orden.compra.process.detalle'), form)
    .then((res) => {
      if (!ordenCompra.existeDetalle(form.producto_id))
      {
        productoSelected.value['cantidad'] = form.cantidad
        addDetalleStore()
        ordenCompra.addDetalle(detalleOrdenCompra.getDetalle)
        form.reset()
        showNotification(
        'Detalle Orden de Compra',
        'El producto fue agregado exitosamente.', 
        'success'
        )
      } else {
      showNotification(
        'Detalle Orden de Compra',
        'El producto ya se encuentra agregado.', 
        'warn'
        )
      }
    })
    .catch((err) => {
      const status = err.response.status
      if (status === 422) {
        errorsAxios.value = err.response.data.errors
    }
  })
}

const modal = reactive({
  show: false,
  item: null
})
const showModal = (show = false, producto = null) => {
  modal.show = show
  modal.item = producto
}

const destroy = () => {
  ordenCompra.deleteDetalle(modal.item.producto_id)
  showModal()
  showNotification(
    'Detalle Orden de Compra',
    'El producto fue eliminado exitosamente.', 
    'success'
  )
}


const changeTabNext = () => {
  emit('next', true)
}

</script>

<template>
  <CRow class="my-3">
    <CCol xs="5">
        <CFormLabel>Producto</CFormLabel>
        <FormInputAutocomplete
            label="nombre"
            value="id"
            :items="props.productos.map(({nombre, id}) => ({nombre, id}))"
            :key="productoFiltered"
            @onSelect="selection"
            :error="getErrorMessage(errors?.producto_id)"
        />
    </CCol>
    <CCol>
      <FormLabel required>Cantidad</FormLabel>
      <CFormInput v-model="form.cantidad" type="number" placeholder="Cantidad"
        :feedback="getErrorMessage(errors?.cantidad)" :invalid="getBooleanError(errors?.cantidad)" 
        />
    </CCol>
    <CCol>
      <FormLabel required>Monto</FormLabel>
      <CFormInput v-model="form.precio_compra" type="number" step="any" placeholder="Monto"
        :feedback="getErrorMessage(errors?.precio_compra)" :invalid="getBooleanError(errors?.precio_compra)" 
        />
    </CCol>
    <CCol  class="d-flex align-items-end justify-content-end btn-margin">
        <CButton type="button" @click="addProducto()" color="primary" class="px-4 me-4" shape="rounded-pill" title="Guardar">
            Agregar
        </CButton>
    </CCol>
  </CRow>
  <CRow class="my-3">
  <CTable class="mt-3 ms-1">
    <CTableHead>
      <CTableRow color="secondary">
          <CTableHeaderCell scope="col" class="col-sm-1"></CTableHeaderCell>
          <CTableHeaderCell scope="col" class="col-sm-2">Codigo</CTableHeaderCell>
          <CTableHeaderCell scope="col" class="col-sm-2">Nombre</CTableHeaderCell>
          <CTableHeaderCell scope="col" class="col-sm-2">Cantidad</CTableHeaderCell>
          <CTableHeaderCell scope="col" class="col-sm-1">Costo</CTableHeaderCell>
          <CTableHeaderCell scope="col" class="col-sm-1">Alicuota</CTableHeaderCell>
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
          <CTableDataCell>
          <CircleButton
            class="ms-1"
            title="Eliminar"
            @click="showModal(true, producto)"
          >
            <span class="fa-solid fa-trash-can"></span>
          </CircleButton>
          </CTableDataCell>
          <CTableDataCell>{{ producto.producto.codigo }}</CTableDataCell>
          <CTableDataCell>{{ producto.producto.nombre }}</CTableDataCell>
          <CTableDataCell>{{ producto.cantidad }}</CTableDataCell>
          <CTableDataCell>{{ producto.precio_compra }}</CTableDataCell>
          <CTableDataCell>{{ producto.producto.alicuota }}</CTableDataCell>
          <CTableDataCell>{{ producto.subtotal }}</CTableDataCell>
          <CTableDataCell>{{ producto.subtotal_impuestos }}</CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>
    <div style="text-align: center;" v-if="!ordenCompra.tieneDetalles">
        Agregar items.
    </div>
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
  </CRow>

  <CRow>
    <div class="d-flex justify-content-end">
      <CButton type="button" color="secondary" class="px-4 me-2" shape="rounded-pill" title="Cancelar" @click="back">
        Cancelar
      </CButton>
      <CButton type="button" @click="changeTabNext()" color="primary" class="px-4" shape="rounded-pill" title="Guardar">
        Siguiente
      </CButton>
     </div>
  </CRow>
  <Modal
    :visible="modal.show"
    @close="showModal()"
    >
      <template #header>
        Eliminar Producto
      </template>
      <CAlert color="warning">
        <span>
          <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro de deseas eliminar el producto?
        </span>
      </CAlert>
      <CRow class="d-flex flex-column text-center">
        <CCol>Nombre: {{ modal.item.producto.nombre }}</CCol>
      </CRow>
      <template #footer>
        <CButton
          color="danger"
          shape="rounded-pill"
          class="text-white"
          @click="destroy"
        >
          Eliminar
        </CButton>
        <CButton
          color="secondary"
          shape="rounded-pill"
          @click="showModal()"
        >
          Cancelar
        </CButton>
      </template>
  </Modal>
</template>
