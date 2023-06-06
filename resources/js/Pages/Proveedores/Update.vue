<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'

const props = defineProps({
  proveedor: Object,
  condicionesIva: Array,
  provincias: Array,
  localidades: Array,
  retencionesIngresosBruto: Array,
  retencionGanancias: Array,
  planCuentas: Array,
})
const form = useForm({
  razon_social: props.proveedor.razon_social,
  cuit: props.proveedor.cuit,
  numero_ingreso_bruto: props.proveedor.numero_ingreso_bruto,
  domicilio: props.proveedor.domicilio,
  telefono: props.proveedor.telefono,
  codigo_postal: props.proveedor.codigo_postal,
  email: props.proveedor.email,
  saldo: props.proveedor.saldo,
  retencion_ingresos_id: props.proveedor.retencion_ingresos_id,
  cuenta_id: props.proveedor.cuenta_id,
  localidad_id: props.proveedor.localidad_id,
  provincia_id: props.proveedor.provincia_id,
  condicion_iva_id: props.proveedor.condicion_iva_id,
  retencion_ganancias_id: props.proveedor.retencion_ganancias_id,
  estado: props.proveedor.estado,
})

const submit = () => {
  form.patch(route('proveedores.update', props.proveedor.id))
}

const back = () => {
  Inertia.get(route('proveedores.index'))
}
</script>

<template>
  <AppLayout :breadcrumb="breadcrumbs.proveedoresUpdate" title="Modificar Proveedor">
    <CForm @submit.prevent="submit">
      <CRow>
        <CCol xs="5">
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Razon social</FormLabel>
              <CFormInput v-model="form.razon_social" type="text" placeholder="Razon social"
                :feedback="form.errors.razon_social" :invalid="form.errors.razon_social" />
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Cuit</FormLabel>
              <CFormInput v-model="form.cuit" type="text" placeholder="Cuit" :feedback="form.errors.cuit"
                :invalid="form.errors.cuit" />
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Numero ingresos bruto</FormLabel>
              <CFormInput v-model="form.numero_ingreso_bruto" type="text" placeholder="Numero ingresos bruto"
                :feedback="form.errors.numero_ingreso_bruto" :invalid="form.errors.numero_ingreso_bruto" />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Condiciones Iva</FormLabel>
              <CFormSelect v-model="form.condicion_iva_id" :feedback="form.errors.condicion_iva_id"
                :invalid="form.errors.condicion_iva_id">
                <option :value="''">Seleccione una opción</option>
                <option v-for="condicionIva in props.condicionesIva" :key="condicionIva.id" :value="condicionIva.id">
                  {{ condicionIva.descripcion }}
                </option>
              </CFormSelect>
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Domicilio</FormLabel>
              <CFormInput v-model="form.domicilio" type="text" placeholder="Domicilio" :feedback="form.errors.domicilio"
                :invalid="form.errors.domicilio" />
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Telefono</FormLabel>
              <CFormInput v-model="form.telefono" type="text" placeholder="Telefono" :feedback="form.errors.telefono"
                :invalid="form.errors.telefono" />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Provincias</FormLabel>
              <CFormSelect v-model="form.provincia_id" :feedback="form.errors.provincia_id"
                :invalid="form.errors.provincia_id">
                <option :value="''">Seleccione una opción</option>
                <option v-for="localidad in props.localidades" :key="localidad.id" :value="localidad.id">
                  {{ localidad.nombre }}
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
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Localidades</FormLabel>
              <CFormSelect v-model="form.localidad_id" :feedback="form.errors.localidad_id"
                :invalid="form.errors.localidad_id">
                <option :value="''">Seleccione una opción</option>
                <option v-for="provincia in props.provincias" :key="provincia.id" :value="provincia.id">
                  {{ provincia.nombre }}
                </option>
              </CFormSelect>
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Codigo postal</FormLabel>
              <CFormInput v-model="form.codigo_postal" type="text" placeholder="Codigo postal"
                :feedback="form.errors.codigo_postal" :invalid="form.errors.codigo_postal" />
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
              <FormLabel required>E-mail</FormLabel>
              <CFormInput v-model="form.email" type="email" placeholder="E-mail" :feedback="form.errors.email"
                :invalid="form.errors.email" />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Retencion de ingresos</FormLabel>
              <CFormSelect v-model="form.retencion_ingresos_id" :feedback="form.errors.retencion_ingresos_id"
                :invalid="form.errors.retencion_ingresos_id">
                <option :value="''">Seleccione una opción</option>
                <option v-for="retencionIngreso in props.retencionesIngresosBruto" :key="retencionIngreso.id"
                  :value="retencionIngreso.id">
                  {{ retencionIngreso.descripcion }}
                </option>
              </CFormSelect>
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Plan de cuentas</FormLabel>
              <CFormSelect v-model="form.cuenta_id" :feedback="form.errors.cuenta_id" :invalid="form.errors.cuenta_id">
                <option :value="''">Seleccione una opción</option>
                <option v-for="planCuenta in props.planCuentas" :key="planCuenta.id" :value="planCuenta.id">
                  {{ planCuenta.descripcion }}
                </option>
              </CFormSelect>
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Retencion de ganancias</FormLabel>
              <CFormSelect v-model="form.retencion_ganancias_id" :feedback="form.errors.retencion_ganancias_id"
                :invalid="form.errors.retencion_ganancias_id">
                <option :value="''">Seleccione una opción</option>
                <option v-for="retencionGanancia in props.retencionGanancias" :key="retencionGanancia.id"
                  :value="retencionGanancia.id">
                  {{ retencionGanancia.codigo }}
                </option>
              </CFormSelect>
            </CCol>
          </CRow>
          <CRow class="my-3">
            <CCol>
              <FormLabel required>Saldo</FormLabel>
              <CFormInput v-model="form.saldo" type="text" placeholder="Saldo" :feedback="form.errors.saldo"
                :invalid="form.errors.saldo" />
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
