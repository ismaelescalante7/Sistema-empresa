<script setup>
import FormLabel from "@/Components/Form/FormLabel.vue";
import FormInputAutocomplete from "@/Components/Form/FormInputAutocomplete.vue";
import { computed, ref, onMounted } from "vue";
import Errors from "@/Utils/formatError";
import { useRemitoStore } from "@/store/useRemito";
import { storeToRefs } from "pinia";

const { getErrorMessage, getBooleanError } = Errors();

const props = defineProps({
    localidades: Array,
    proveedores: Array,
    user: Object,
});
onMounted(() => {
    user_id.value = props.user.id;
});

const remito = useRemitoStore();
const {
    numero,
    proveedor_id,
    localidad_id,
    fecha_ingreso,
    user_id,
    localidad,
    proveedor,
} = storeToRefs(remito);

const proveedorFiltered = ref(null);
const localidadFiltered = ref(null);
const errorsAxios = ref(null);

const emit = defineEmits(["siguiente"]);

const selectionLocalidad = (localidadFiltered) => {
    localidad_id.value = localidadFiltered.id;
    localidad.value = localidadFiltered;
};

const selectionProveedor = (proveedorFiltered) => {
    proveedor_id.value = proveedorFiltered.id;
    proveedor.value = proveedorFiltered;
};

const errors = computed(() => {
    if (errorsAxios.value) {
        return errorsAxios.value;
    }
    return props.errors;
});

const goSecondTab = () => {
    axios
        .post(route("remito.process.head"), remito.getHead)
        .then(() => {
            emit("siguiente");
            errorsAxios.value = null;
        })
        .catch((err) => {
            const status = err.response.status;
            if (status === 422) {
                errorsAxios.value = err.response.data.errors;
            }
        });
};
</script>
<template>
    <CRow class="my-3">
        <CCol xs="5" style="text-align: right">
            <FormLabel required>Numero remito</FormLabel>
        </CCol>
        <CCol xs="3">
            <CFormInput
                v-model="numero"
                type="text"
                placeholder="Numero remito"
                :feedback="getErrorMessage(errors?.numero)"
                :invalid="getBooleanError(errors?.numero)"
            />
        </CCol>
    </CRow>
    <CRow class="my-3">
        <CCol xs="5" style="text-align: right">
            <FormLabel required>Usuario</FormLabel>
        </CCol>
        <CCol xs="3">
            <CFormInput
                v-model="props.user.name"
                type="text"
                disabled
                placeholder="Usuario"
                :feedback="getErrorMessage(errors?.user_id)"
                :invalid="getBooleanError(errors?.user_id)"
            />
        </CCol>
    </CRow>
    <CRow class="my-3">
        <CCol xs="5" style="text-align: right">
            <FormLabel required>Localidad</FormLabel>
        </CCol>
        <CCol xs="3">
            <FormInputAutocomplete
                label="nombre"
                value="id"
                :items="
                    props.localidades.map(({ nombre, id }) => ({
                        nombre,
                        id,
                    }))
                "
                :key="localidadFiltered"
                @onSelect="selectionLocalidad"
                :error="getErrorMessage(errors?.localidad_id)"
            />
        </CCol>
    </CRow>
    <CRow class="my-3">
        <CCol xs="5" style="text-align: right">
            <FormLabel required>Proveedor</FormLabel>
        </CCol>
        <CCol xs="3">
            <FormInputAutocomplete
                label="razon_social"
                value="id"
                :items="
                    props.proveedores.map(({ razon_social, id }) => ({
                        razon_social,
                        id,
                    }))
                "
                :key="proveedorFiltered"
                @onSelect="selectionProveedor"
                :error="getErrorMessage(errors?.proveedor_id)"
            />
        </CCol>
    </CRow>
    <CRow class="my-3">
        <CCol xs="5" style="text-align: right">
            <FormLabel required>Fecha</FormLabel>
        </CCol>
        <CCol xs="3">
            <CFormInput v-model="fecha_ingreso" type="text" />
        </CCol>
    </CRow>
    <CButton
        type="button"
        color="primary"
        class="px-4"
        shape="rounded-pill"
        title="Cancelar"
        @click="goSecondTab"
    >
        Siguiente
    </CButton>
</template>
