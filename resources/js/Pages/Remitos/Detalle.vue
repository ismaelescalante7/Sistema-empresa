<script setup>

import FormLabel from "@/Components/Form/FormLabel.vue";
import FormInputAutocomplete from "@/Components/Form/FormInputAutocomplete.vue";
import { computed, reactive, ref } from "vue";
import Errors from "@/Utils/formatError";
import CircleButton from "@/Components/CircleButton.vue";
import Modal from "@/Components/Modal.vue";
import axios from "axios";
import { useRemitoStore } from "@/store/useRemito";
import { storeToRefs } from "pinia";

const { getErrorMessage, getBooleanError } = Errors();

const props = defineProps({
    productos: Array,
});
const remito = useRemitoStore();
const { detalles } =
    storeToRefs(remito);

const modal = reactive({
    show: false,
    item: null,
    type: null,
    index: null,
});
const showModal = (
    show = false,
    productOrdenCompra = null,
    index = null,
    type = null
) => {
    modal.show = show;
    productCopy.value = { ...productOrdenCompra };
    modal.item = productOrdenCompra;
    modal.index = index;
    modal.type = type;
};

const errors = computed(() => {
    if (errorsAxios.value) {
        return errorsAxios.value;
    }
    return props.errors;
});
const productCopy = ref({});

const productoSelected = ref(null);
const productoFiltered = ref(null);
const errorsAxios = ref(null);

const detalle = ref({});

detalle.value = {
    producto_id: null,
    orden_compra_id: null,
    cantidad_pendiente: 0,
    cantidad: 0,
    nombre: null,
};

const selectionProducto = (productoFiltered) => {
    detalle.value.producto_id = productoFiltered.id;
    detalle.value.nombre = productoFiltered.nombre;
    productoSelected.value = props.productos.find(
        (item) => item.id === productoFiltered.id
    );
};

const agregarProducto = () => {
    axios
        .post(route("remito.process.detalle"), detalle.value)
        .then((res) => {
            detalles.value.push(res.data);
            productoSelected.value = null;

            detalle.value.producto_id = null;
            detalle.value.orden_compra_id = null;
            detalle.value.cantidad_pendiente = 0;
            detalle.value.cantidad = 0;
            detalle.value.nombre = null;
        })
        .catch((err) => {
            const status = err.response.status;
            if (status === 422) {
                errorsAxios.value = err.response.data.errors;
            }
        });
};
const actualizarDetalle = () => {
    productCopy.value.cantidad_pendiente =
        modal.item.cantidad - productCopy.value.cantidad;
    axios.post(route("remito.process.detalle"), productCopy.value).then(() => {
        detalles.value[modal.index] = productCopy.value;
        showModal();
    });
};
const eliminarDetalle = () => {
    detalles.value.splice(modal.index, 1);
    showModal();
};

const goFourthTab = () => {
    formWizards.value.nextTab();
};

</script>

<template>
    <CRow>
        <CRow class="my-3">
            <CCol xs="5">
                <CFormLabel>Detalle de compras</CFormLabel>
                <CRow class="my-3">
                    <CCol xs="5" style="text-align: right">
                        <FormLabel required>Producto</FormLabel>
                    </CCol>
                    <CCol xs="5">
                        <FormInputAutocomplete
                            label="nombre"
                            value="id"
                            :items="
                                props.productos.map(({ nombre, id }) => ({
                                    nombre,
                                    id,
                                }))
                            "
                            :key="productoFiltered"
                            @onSelect="selectionProducto"
                        />
                    </CCol>
                </CRow>
                <CRow class="my-3">
                    <CCol xs="5" style="text-align: right">
                        <FormLabel required>Cantidad</FormLabel>
                    </CCol>
                    <CCol xs="5">
                        <CFormInput
                            v-model="detalle.cantidad"
                            type="text"
                            placeholder="Cantidad del producto"
                            :feedback="
                                getErrorMessage(errors?.detalle.cantidad)
                            "
                            :invalid="getBooleanError(errors?.detalle.cantidad)"
                        />
                    </CCol>
                </CRow>
            </CCol>
            <CCol class="d-flex align-items-end justify-content-end btn-margin">
                <CButton
                    type="button"
                    @click="agregarProducto()"
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
                                >Articulo
                            </CTableHeaderCell>
                            <CTableHeaderCell scope="col" class="col-sm-2"
                                >Detalle
                            </CTableHeaderCell>
                            <CTableHeaderCell scope="col" class="col-sm-2"
                                >Cantidad
                            </CTableHeaderCell>
                        </CTableRow>
                    </CTableHead>
                    <CTableBody>
                        <CTableRow
                            class="cell-center"
                            v-for="(ordenCompraDetalle, index) in detalles"
                        >
                            <CTableDataCell>
                                <CircleButton
                                    class="ms-1"
                                    title="Eliminar"
                                    @click="
                                        showModal(
                                            true,
                                            ordenCompraDetalle,
                                            index,
                                            'Eliminar'
                                        )
                                    "
                                >
                                    <span class="fa-solid fa-trash-can"></span>
                                </CircleButton>
                                <CircleButton
                                    class="ms-1"
                                    title="Modificar"
                                    @click="
                                        showModal(
                                            true,
                                            ordenCompraDetalle,
                                            index,
                                            'Editar'
                                        )
                                    "
                                >
                                    <span
                                        class="fa-solid fa-pen-to-square"
                                    ></span>
                                </CircleButton>
                            </CTableDataCell>
                            <CTableDataCell>
                                {{ ordenCompraDetalle.nombre }}
                            </CTableDataCell>
                            <CTableDataCell> </CTableDataCell>
                            <CTableDataCell>
                                {{ ordenCompraDetalle.cantidad }}
                            </CTableDataCell>
                        </CTableRow>
                    </CTableBody>
                </CTable>
                <div style="text-align: center">Agregar items.</div>

                <CButton
                    type="button"
                    @click="goFourthTab()"
                    color="primary"
                    class="px-4 me-4"
                    shape="rounded-pill"
                    title="Siguiente"
                >
                    Siguiente
                </CButton>
            </CCol>
        </CRow>
    </CRow>
    <Modal
        :visible="modal.show && modal.type === 'Editar'"
        @close="showModal()"
    >
        <template #header> Editar el producto de la orden de compra </template>
        <CAlert color="warning">
            <span>
                <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro que
                deseas actualizar los valores del producto de la orden de
                compra?
            </span>
        </CAlert>
        {{ modal.item }}
        <br />
        {{ productCopy }}
        <CRow class="d-flex flex-column text-center">
            <CRow>
                <CCol>Nombre: </CCol>
                <CCol>
                    <CFormInput
                        v-model="modal.item.nombre"
                        type="text"
                        disabled="true"
                    />
                </CCol>
            </CRow>
            <CRow>
                <CCol>Cantidad</CCol>
                <CCol>
                    <CFormInput v-model="productCopy.cantidad" type="text" />
                </CCol>
            </CRow>
        </CRow>
        <template #footer>
            <CButton
                color="primary"
                shape="rounded-pill"
                class="text-white"
                @click="actualizarDetalle"
            >
                Actualizar
            </CButton>
            <CButton
                color="secondary"
                shape="rounded-pill"
                @click="showModal()"
            >
                Cancelar
            </CButton>
        </template>
    </Modal>
    <Modal
        :visible="modal.show && modal.type === 'Eliminar'"
        @close="showModal()"
    >
        <template #header> Eliminar Producto de la orden de compra </template>
        <CAlert color="warning">
            <span>
                <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro que
                deseas eliminar el producto de la orden de compra?
            </span>
        </CAlert>
        <CRow class="d-flex flex-column text-center">
            <CCol>Nombre: {{ modal.item.nombre }}</CCol>
            <CCol>Cantidad: {{ modal.item.cantidad }}</CCol>
        </CRow>
        <template #footer>
            <CButton
                color="danger"
                shape="rounded-pill"
                class="text-white"
                @click="eliminarDetalle"
            >
                Eliminar
            </CButton>
            <CButton
                color="secondary"
                shape="rounded-pill"
                @click="showModal()"
            >
                Cancelar
            </CButton>
        </template>
    </Modal>
</template>
