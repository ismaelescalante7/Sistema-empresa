<script setup>
import "vue-select/dist/vue-select.css";
import vSelect from "vue-select";
import { computed, reactive, ref, onMounted } from "vue";
import axios from "axios";
import Errors from "@/Utils/formatError";

const { getErrorMessage, getBooleanError } = Errors();

const props = defineProps({
    ordenCompras: Array,
});

const errors = computed(() => {
    if (errorsAxios.value) {
        return errorsAxios.value;
    }
    return props.errors;
});

const listOrdenCompras = ref([]);

const ordenComprasFiltered = ref(null);
const ordenCompraSelected = ref(null);
const errorsAxios = ref(null);

ordenComprasFiltered.value = props.ordenCompras;

const agregarOrdenCompra = () => {
    const OrdenCompra = ordenComprasFiltered.value.find(
        (item) => item.id == ordenCompraSelected.value.id
    );
    if (OrdenCompra) {
        listOrdenCompras.value.push(OrdenCompra);
        const index = ordenComprasFiltered.value.indexOf(OrdenCompra);
        if (index !== -1) {
            ordenComprasFiltered.value.splice(index, 1);
        }
        ordenCompraSelected.value = null;
    } else {
        console.log("No encontrado");
    }
};
</script>

<template>
    <CRow>
        <CRow class="my-3">
            <CCol xs="5">
                <CFormLabel>Orden de compra</CFormLabel>
                <v-select
                    label="id"
                    :options="ordenComprasFiltered"
                    v-model="ordenCompraSelected"
                    :error="getErrorMessage(errors?.orden_compra_id)"
                ></v-select>
            </CCol>
            <CCol class="d-flex align-items-end justify-content-end btn-margin">
                <CButton
                    type="button"
                    @click="agregarOrdenCompra()"
                    color="primary"
                    class="px-4 me-4"
                    shape="rounded-pill"
                    title="Agregar"
                >
                    Agregar
                </CButton>
            </CCol>
        </CRow>
        <CRow class="my-3">
            <CCol>
                <CTable class="mt-3 ms-1">
                    <CTableHead>
                        <CTableRow color="secondary">
                            <CTableHeaderCell
                                scope="col"
                                class="col-sm-1"
                            ></CTableHeaderCell>
                            <CTableHeaderCell scope="col" class="col-sm-2"
                                >Nro. OC
                            </CTableHeaderCell>
                            <CTableHeaderCell scope="col" class="col-sm-2"
                                >Fecha OC
                            </CTableHeaderCell>
                            <CTableHeaderCell scope="col" class="col-sm-2"
                                >Fecha entrega
                            </CTableHeaderCell>
                        </CTableRow>
                    </CTableHead>
                    <CTableBody>
                        <CTableRow
                            v-for="ordenCompra in ordenesDeCompra"
                            :key="ordenCompra.id"
                            class="cell-center"
                        >
                            <CTableDataCell>
                                <CircleButton
                                    class="ms-1"
                                    title="Eliminar"
                                    @click="showModal(true, ordenCompra)"
                                >
                                    <span class="fa-solid fa-trash-can"></span>
                                </CircleButton>
                            </CTableDataCell>
                            <CTableDataCell>{{
                                ordenCompra.id
                            }}</CTableDataCell>
                            <CTableDataCell>{{
                                ordenCompra.created_at
                            }}</CTableDataCell>
                            <CTableDataCell>
                                {{ form.fecha_ingreso }}
                            </CTableDataCell>
                        </CTableRow>
                    </CTableBody>
                </CTable>
                <div style="text-align: center">Agregar items.</div>
            </CCol>
        </CRow>
        <CButton
            type="button"
            @click="goThirdTab()"
            color="primary"
            class="px-4 me-4"
            shape="rounded-pill"
            title="Siguiente"
        >
            Siguiente
        </CButton>
    </CRow>
</template>
