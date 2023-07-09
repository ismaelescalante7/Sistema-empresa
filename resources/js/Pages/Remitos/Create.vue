<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import breadcrumbs from "@/Data/Breadcrumbs";
import { useForm } from "@inertiajs/inertia-vue3";
import FormLabel from "@/Components/Form/FormLabel.vue";
import FormWizard from "./Partials/FormWizard.vue";

const form = useForm({
    nombre: null,
});

const props = defineProps({
    localidades: Array,
    proveedores: Array,
    ordenCompras: Array,
    productos: Array,
    user: Object,
});
</script>

<template>
    <AppLayout :breadcrumb="breadcrumbs.remitosCreate" title="Nuevo Remito">
        <FormWizard
            :user="props.user"
            :localidades="props.localidades"
            :proveedores="props.proveedores"
            :ordenCompras="props.ordenCompras"
            :productos="props.productos"
            :form="form"
        />
        <!-- <CForm @submit.prevent="submit">
      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Nombre</FormLabel>
          <CFormInput v-model="form.nombre" type="text" placeholder="Nombre" :feedback="form.errors.nombre"
            :invalid="form.errors.nombre" />
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
    </CForm> -->
    </AppLayout>
</template>
