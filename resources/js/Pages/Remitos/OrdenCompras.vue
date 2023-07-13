<script setup>
import "vue-select/dist/vue-select.css";
import vSelect from "vue-select";
import { computed, ref } from "vue";
import axios from "axios";
import Errors from "@/Utils/formatError";
import { useRemitoStore } from "@/store/useRemito";
import { storeToRefs } from "pinia";

const { getErrorMessage, getBooleanError } = Errors();

const remito = useRemitoStore();
const { fecha_ingreso, detalles, ordenCompras } = storeToRefs(remito);

const props = defineProps({
    ordenCompras: Array,
});
const emit = defineEmits(["siguiente"]);

const errors = computed(() => {
    if (errorsAxios.value) {
        return errorsAxios.value;
    }
    return props.errors;
});

const ordenComprasFiltered = ref(null);
const ordenCompraSelected = ref(null);
const errorsAxios = ref(null);

ordenComprasFiltered.value = props.ordenCompras;

const agregarOrdenCompra = () => {
    axios
        .post(route("remito.process.ordenCompra"), {
            orden_compra_id: ordenCompraSelected.value?.id,
        })
        .then(() => {
            ordenCompras.value.push(ordenCompraSelected.value);
            const index = ordenComprasFiltered.value.indexOf(
                ordenCompraSelected.value.id
            );
            if (index !== -1) {
                ordenComprasFiltered.value.splice(index, 1);
            }
            ordenCompraSelected.value = null;
        })
        .catch((err) => {
            const status = err.response.status;
            if (status === 422) {
                errorsAxios.value = err.response.data.errors;
                console.log("No encontrado");
            }
        });
};

const goThirdTab = () => {
    detalles.value = ordenCompras.value.flatMap((item) =>
        item.detalle_orden_compra.map((detalle) => ({
            producto_id: detalle.producto.id,
            nombre: detalle.producto.nombre,
            cantidad: detalle.cantidad,
            cantidad_pendiente: 0,
            orden_compra_id: detalle.orden_compra_id,
        }))
    );
    ordenCompras.value = ordenCompras.value.map((item) => ({
        orden_compra_id: item.id,
    }));
    emit("siguiente");
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
                            v-for="ordenCompra in ordenCompras"
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
                                {{ fecha_ingreso }}
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
