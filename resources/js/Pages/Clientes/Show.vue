<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'

const props = defineProps({
  cliente: Array
})

const back = () => {
  Inertia.get(route('clientes.index'))
}
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.clientesShow"
    title="Cliente"
  >
    <CTableBody class="table-borderless">
      <CTableRow class="col">
        <CTableDataCell class="d-flex justify-content-end">Apellido y Nombre:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3"> {{ props.cliente.apellido_nombre }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end ms-2">Tipo de Documento:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.cliente.tipo_documento.nombre }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end ms-2">Nro. Documento:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.cliente.numero_documento }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Domicilio:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.cliente.domicilio }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Provincia:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.cliente.provincia.nombre }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Departamento:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.cliente.departamento.nombre }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Localidad:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.cliente.localidad.nombre }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Teléfono fijo:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.cliente.telefono }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Celular:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.cliente.celular }}</CTableDataCell>
      </CTableRow>

      <CTableRow>
        <CTableDataCell class="d-flex justify-content-end">Email:</CTableDataCell>
        <CTableDataCell class="fw-bold px-3">{{ props.cliente.email }}</CTableDataCell>
      </CTableRow>
    </CTableBody>

    <CRow class="m-4">
      <CCol xs="4">
        <CButton
          type="button"
          color="secondary"
          class="px-4"
          shape="rounded-pill"
          title="Volver"
          @click="back"
        >
          Volver
        </CButton>
      </CCol>
    </CRow>
  </AppLayout>
</template>
