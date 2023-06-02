<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import breadcrumbs from "@/Data/Breadcrumbs";
import { useForm } from "@inertiajs/inertia-vue3";
import FormLabel from "@/Components/Form/FormLabel.vue";

const props = defineProps({
  condicionesPago: Object,
});
const form = useForm({
  condicion: props.condicionesPago.condicion,
  dias: props.condicionesPago.dias,
});

const submit = () => {
  form.patch(route("condiciones.pagos.update", props.condicionesPago.id));
};

const back = () => {
  Inertia.get(route("condiciones.pagos.index"));
};
</script>

<template>
  <AppLayout
    :breadcrumb="breadcrumbs.condicionesPagosUpdate"
    title="Modificar Condiciones pago"
  >
    <CForm @submit.prevent="submit">
      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Condición</FormLabel>
          <CFormInput
            v-model="form.condicion"
            type="text"
            placeholder="Condición"
            :feedback="form.errors.condicion"
            :invalid="form.errors.condicion"
          />
        </CCol>
      </CRow>
      <CRow class="my-3">
        <CCol xs="5">
          <FormLabel required>Dias</FormLabel>
          <CFormInput
            v-model="form.dias"
            type="text"
            placeholder="Dias"
            :feedback="form.errors.dias"
            :invalid="form.errors.dias"
          />
        </CCol>
      </CRow>
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
