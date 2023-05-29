<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'
import { onMounted, reactive } from 'vue'
import { getDepartamentosByProvinciaId, getLocalidadesByDepartamentoId } from '@/Utils/location.js'

const props = defineProps({
  provincias: Array,
  departamentos: Array,
  localidades: Array,
  personaJuridica: Object
})

const form = useForm({
  razon_social: props.personaJuridica.razon_social,
  cuit: props.personaJuridica.cuit,
  email: props.personaJuridica.email,
  telefono: props.personaJuridica.telefono,
  celular: props.personaJuridica.celular,
  provincia_id: props.personaJuridica.provincia_id.toString(),
  departamento_id: props.personaJuridica.departamento_id.toString(),
  localidad_id: props.personaJuridica.localidad_id.toString(),
  domicilio: props.personaJuridica.domicilio
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
  const provinciaId = form.provincia_id
  const departamentoId = form.departamento_id
  arrayDepartamentos.values = getDepartamentosByProvinciaId(provinciaId, props.departamentos)
  arrayLocalidades.values = getLocalidadesByDepartamentoId(departamentoId, props.localidades)
})

const submit = () => {
  form.patch(`/personas-juridicas/${props.personaJuridica.id}`)
}

const back = () => {
  Inertia.get('/personas-juridicas')
}

</script>
<template>
  <AppLayout
    :breadcrumb="breadcrumbs.personasJuridicasUpdate"
    title="Modificar Persona Jurídica"
  >
    <CForm @submit.prevent="submit">
      <CRow>
        <CCol xs="5" >
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Razón Social</FormLabel>
              <CFormInput
                v-model="form.razon_social"
                type="text"
                placeholder="Razón Social"
                :feedback="form.errors.razon_social"
                :invalid="form.errors.razon_social"
              />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Cuit</FormLabel>
              <CFormInput
                v-model="form.cuit"
                type="text"
                placeholder="Cuit"
                :feedback="form.errors.cuit"
                :invalid="form.errors.cuit"
              />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Domicilio</FormLabel>
              <CFormInput
                v-model="form.domicilio"
                type="text"
                placeholder="Domicilio"
                :feedback="form.errors.domicilio"
                :invalid="form.errors.domicilio"
              />
            </CCol>
          </CRow>
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Provincia</FormLabel>
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
              <FormLabel required>Departamento</FormLabel>
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
        </CCol>
        <CCol xs="5">
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Localidad</FormLabel>
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
          <CRow class="mb-3">
            <CCol>
              <FormLabel required>Teléfono Fijo</FormLabel>
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
