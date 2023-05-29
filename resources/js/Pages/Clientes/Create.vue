<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'
import generos from '@/Data/Personas/Genero'
import { onMounted, reactive } from 'vue'
import { getDepartamentosByProvinciaId, getLocalidadesByDepartamentoId } from '@/Utils/location.js'

const props = defineProps({
  tiposDocumentos: Array,
  provincias: Array,
  departamentos: Array,
  localidades: Array,
  provinciaDefault: String
})

const form = useForm({
  apellido_nombre: null,
  tipo_documento_id: null,
  numero_documento: null,
  email: null,
  genero: null,
  telefono: null,
  celular: null,
  nacimiento: null,
  provincia_id: props.provinciaDefault,
  departamento_id: null,
  localidad_id: null,
  direccion: null
})

const arrayDepartamentos = reactive([])
const arrayLocalidades = reactive([])

function departamentosByProvinciaId (provinciaId) {
  resetSelectFirstLevel()
  arrayDepartamentos.values = getDepartamentosByProvinciaId(provinciaId, props.departamentos)
}

function resetSelectFirstLevel () {
  form.departamento_id = ''
  form.localidad_id = ''
  arrayLocalidades.values = []
}

function resetSelectSecondtLevel () {
  form.localidad_id = ''
}

function localidadesByDepartamentoId (departamentoId) {
  resetSelectSecondtLevel()
  arrayLocalidades.values = getLocalidadesByDepartamentoId(departamentoId, props.localidades)
}

onMounted(() => {
  arrayDepartamentos.values = getDepartamentosByProvinciaId(props.provinciaDefault, props.departamentos)
})

const submit = () => {
  form.post('/clientes')
}

const back = () => {
  Inertia.get('/clientes')
}
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.clientesCreate"
    title="Nuevo Cliente"
  >
    <CForm @submit.prevent="submit">
      <CRow>
        <CCol xs="5" >
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Apellido y nombre</FormLabel>
              <CFormInput
                v-model="form.apellido_nombre"
                type="text"
                placeholder="Apellido y nombre"
                :feedback="form.errors.apellido_nombre"
                :invalid="form.errors.apellido_nombre"
              />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Tipo de Documento</FormLabel>
              <CFormSelect
                v-model="form.tipo_documento_id"
                :feedback="form.errors.tipo_documento_id"
                :invalid="form.errors.tipo_documento_id"
              >
                <option :value="''">Seleccione una opción</option>
                <option
                  v-for="tipoDocumento in props.tiposDocumentos"
                  :key="tipoDocumento.id"
                  :value="tipoDocumento.id"
                >
                  {{ tipoDocumento.nombre }}
                </option>
              </CFormSelect>
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Nro. Documento</FormLabel>
              <CFormInput
                v-model="form.numero_documento"
                type="text"
                placeholder="Nro. Documento"
                :feedback="form.errors.numero_documento"
                :invalid="form.errors.numero_documento"
              />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Cuil</FormLabel>
              <CFormInput
                v-model="form.cuil"
                type="text"
                placeholder="Cuil"
                :feedback="form.errors.cuil"
                :invalid="form.errors.cuil"
              />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Género</FormLabel>
              <CFormSelect
                v-model="form.genero"
                :feedback="form.errors.genero"
                :invalid="form.errors.genero"
              >
                <option :value="0">Seleccione una opción</option>
                <option
                  v-for="genero in generos"
                  :key="genero.value"
                  :value="genero.value"
                >
                  {{ genero.name }}
                </option>
              </CFormSelect>
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Fecha de Nacimiento</FormLabel>
              <CFormInput
                v-model="form.nacimiento"
                type="date"
                placeholder="Fecha de Nacimiento"
                :feedback="form.errors.nacimiento"
                :invalid="form.errors.nacimiento"
              />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Domicilio</FormLabel>
              <CFormInput
                v-model="form.direccion"
                type="text"
                placeholder="Domicilio"
                :feedback="form.errors.direccion"
                :invalid="form.errors.direccion"
              />
            </CCol>
          </CRow>
        </CCol>
        <CCol xs="5">
          <CRow class="mb-3">
            <CCol>
              <FormLabel>Teléfono Fijo</FormLabel>
              <CFormInput
                v-model="form.telefono"
                type="text"
                placeholder="Teléfono Fijo"
                :feedback="form.errors.telefono"
                :invalid="form.errors.telefono"
              />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel>Celular</FormLabel>
              <CFormInput
                v-model="form.celular"
                type="text"
                placeholder="Celular"
                :feedback="form.errors.celular"
                :invalid="form.errors.celular"
              />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel>Email</FormLabel>
              <CFormInput
                v-model="form.email"
                type="text"
                placeholder="Email"
                :feedback="form.errors.email"
                :invalid="form.errors.email"
              />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel>Provincia</FormLabel>
              <CFormSelect
                v-model="form.provincia_id"
                :feedback="form.errors.provincia_id"
                :invalid="form.errors.provincia_id"
                @update:modelValue = "departamentosByProvinciaId"
              >
                <option :value="''">Seleccione una opción</option>
                <option
                  v-for="provincia in props.provincias"
                  :key="provincia.id"
                  :value="provincia.id"
                >
                  {{ provincia.nombre }}
                </option>
              </CFormSelect>
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel>Departamento</FormLabel>
              <CFormSelect
                v-model="form.departamento_id"
                :feedback="form.errors.departamento_id"
                :invalid="form.errors.departamento_id"
                @update:modelValue= "localidadesByDepartamentoId"
              >
                <option :value="''">Seleccione una opción</option>
                <option
                  v-for="departamento in arrayDepartamentos.values"
                  :key="departamento.id"
                  :value="departamento.id"
                >
                  {{ departamento.nombre }}
                </option>
              </CFormSelect>
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel>Localidad</FormLabel>
              <CFormSelect
                v-model="form.localidad_id"
                :feedback="form.errors.localidad_id"
                :invalid="form.errors.localidad_id"
              >
                <option :value="''">Seleccione una opción</option>
                <option
                  v-for="localidad in arrayLocalidades.values"
                  :key="localidad.id"
                  :value="localidad.id"
                >
                  {{ localidad.nombre }}
                </option>
              </CFormSelect>
            </CCol>
          </CRow>
        </CCol>
      </CRow>
      <br>
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