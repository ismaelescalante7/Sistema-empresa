<script setup>
import { useRemitoStore } from "@/store/useRemito";
import { storeToRefs } from "pinia";

const props = defineProps({
    user: Object,
});

const remito = useRemitoStore();
const { numero, proveedor, localidad, fecha_ingreso } =
    storeToRefs(remito);

const emit = defineEmits(["finalizar"]);

const onComplete = () => {
    emit('finalizar')
};
</script>

<template>
    <div class="d-flex justify-content-between">
        <h3>Cabecera</h3>
        <h4>editar</h4>
    </div>
    <hr />
    <CRow>
        <CCol>Numero remito</CCol>
        <CCol> {{ numero }} </CCol>
    </CRow>
    <CRow>
        <CCol>Usuario</CCol>
        <CCol>{{ props.user.name }}</CCol>
    </CRow>
    <CRow>
        <CCol>Fecha</CCol>
        <CCol> Fecha </CCol>
    </CRow>
    <CRow>
        <CCol>Proveedor</CCol>
        <CCol> {{ proveedor?.razon_social }} </CCol>
    </CRow>
    <CRow>
        <CCol>Sucursal</CCol>
        <CCol> {{ localidad?.nombre }} </CCol>
    </CRow>
    <CRow>
        <CCol>Fecha ingreso</CCol>
        <CCol> {{ fecha_ingreso }} </CCol>
    </CRow>

    <CButton
        type="button"
        @click="onComplete()"
        color="primary"
        class="px-4 me-4"
        shape="rounded-pill"
        title="Terminar"
    >
        Terminar
    </CButton>
</template>
