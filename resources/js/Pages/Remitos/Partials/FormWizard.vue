<script setup>
import { FormWizard, TabContent } from "vue3-form-wizard";
import "vue3-form-wizard/dist/style.css";
import FormLabel from "@/Components/Form/FormLabel.vue";
import FormInputAutocomplete from "@/Components/Form/FormInputAutocomplete.vue";
import "vue-select/dist/vue-select.css";
import { useForm } from "@inertiajs/inertia-vue3";
import { computed, reactive, ref, onMounted } from "vue";
import Errors from "@/Utils/formatError";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import CircleButton from "@/Components/CircleButton.vue";
import Modal from "@/Components/Modal.vue";

const { getErrorMessage, getBooleanError } = Errors();

const props = defineProps({
    localidades: Array,
    proveedores: Array,
    ordenCompras: Array,
    productos: Array,
    form: Object,
});

const form = useForm({
    nombre: null,
    localidad_id: null,
    proveedor_id: null,
    fecha_ingreso: null,
    listOrdenCompras: [],
    selectedOrdenCompra: null,
    lengthOrders: 0,
    productsWithoutOrdenCompra: [],
    productOrdenSelected: {
        index: null,
        nombre: null,
        cantidad: null,
        conOrden: false,
    },
});

const modal = reactive({
    show: false,
    item: null,
});
const showModal = (show = false, productOrdenCompra = null, index = null) => {
    modal.show = show;
    modal.item = productOrdenCompra;
    if (productOrdenCompra) {
        form.productOrdenSelected.index = index;
        form.productOrdenSelected.nombre = productOrdenCompra.nombre;
        form.productOrdenSelected.cantidad = productOrdenCompra.cantidad;
        form.productOrdenSelected.conOrden = productOrdenCompra.conOrden;
    } else {
        form.productOrdenSelected = {
            index: null,
            nombre: null,
            cantidad: null,
            conOrden: false,
        };
    }
};

const errors = computed(() => {
    if (errorsAxios.value) {
        return errorsAxios.value;
    }
    return props.errors;
});

const localidadSelected = ref(null);
const localidadFiltered = ref(null);
const proveedorSelected = ref(null);
const proveedorFiltered = ref(null);
const ordenComprasFiltered = ref(null);
const mapProductsOrdenCompra = ref(null);

const errorsAxios = ref(null);

const formWizards = ref(null);

onMounted(() => {
    form.fecha_ingreso = new Date().toISOString().slice(0, 10);
});

ordenComprasFiltered.value = props.ordenCompras;

const selectionLocalidad = (localidadFiltered) => {
    form.localidad_id = localidadFiltered.id;
    localidadSelected.value = props.localidades.find(
        (item) => item.id === localidadFiltered.id
    );
};

const selectionProveedor = (proveedorFiltered) => {
    form.proveedor_id = proveedorFiltered.id;
    proveedorSelected.value = props.proveedores.find(
        (item) => item.id === proveedorFiltered.id
    );
};

const addOrdenCompra = () => {
    const OrdenCompra = ordenComprasFiltered.value.find(
        (item) => item.id == form.selectedOrdenCompra.id
    );
    if (OrdenCompra) {
        form.listOrdenCompras.push(OrdenCompra);
        const index = ordenComprasFiltered.value.indexOf(OrdenCompra);
        if (index !== -1) {
            ordenComprasFiltered.value.splice(index, 1);
        }
        form.selectedOrdenCompra = null;
    } else {
        console.log("No encontrado");
    }
};

const editarDetalle = (detalleCompra, index) => {
    form.productOrdenSelected.index = index;
    form.productOrdenSelected.nombre = detalleCompra.nombre;
    form.productOrdenSelected.cantidad = detalleCompra.cantidad;
    form.productOrdenSelected.conOrden = detalleCompra.conOrden;
};

const actualizarDetalle = () => {
    if (
        form.productOrdenSelected.conOrden ||
        form.productOrdenSelected.index !== null
    ) {
        if (!form.productOrdenSelected.conOrden) {
            form.productsWithoutOrdenCompra[
                form.productOrdenSelected.index - form.lengthOrders
            ].cantidad = form.productOrdenSelected.cantidad;
            mapProductsOrdenCompra.value[
                form.productOrdenSelected.index
            ].cantidad = form.productOrdenSelected.cantidad;
        } else {
            mapProductsOrdenCompra.value[
                form.productOrdenSelected.index
            ].cantidad = form.productOrdenSelected.cantidad;
        }
    } else {
        form.productsWithoutOrdenCompra.push({
            nombre: form.productOrdenSelected.nombre,
            cantidad: form.productOrdenSelected.cantidad,
            conOrden: false,
        });
        mapProductsOrdenCompra.value.push({
            nombre: form.productOrdenSelected.nombre,
            cantidad: form.productOrdenSelected.cantidad,
            conOrden: false,
        });
    }

    form.productOrdenSelected = {
        index: null,
        nombre: null,
        cantidad: null,
        conOrden: false,
    };
};
const goSecondTab = () => {
    axios
        .post(route("remito.process.head"), form)
        .then(() => {
            formWizards.value.nextTab();
        })
        .catch((err) => {
            const status = err.response.status;
            if (status === 422) {
                errorsAxios.value = err.response.data.errors;
            }
        });
};

const destroy = () => {
    if (!form.productOrdenSelected.conOrden) {
        form.productsWithoutOrdenCompra.splice(
            form.productOrdenSelected.index - form.lengthOrders,
            1
        );
        mapProductsOrdenCompra.value.splice(form.productOrdenSelected.index, 1);
    } else {
        mapProductsOrdenCompra.value.splice(form.productOrdenSelected.index, 1);
    }
    form.productOrdenSelected = {
        index: null,
        nombre: null,
        cantidad: null,
        conOrden: false,
    };
    showModal();
};

const goThirdTab = () => {
    formWizards.value.nextTab();

    mapProductsOrdenCompra.value = form.listOrdenCompras.flatMap((item) =>
        item.detalle_orden_compra.map((detalle) => ({
            nombre: detalle.producto.nombre,
            cantidad: detalle.cantidad,
            conOrden: true,
        }))
    );
    form.lengthOrders = mapProductsOrdenCompra.value.length;
};
const goFourthTab = () => {
    formWizards.value.nextTab();
};
const onComplete = () => {
    alert("finalizado");
};
</script>

<template>
    <form-wizard
        @on-complete="onComplete"
        color="#014E77"
        ref="formWizards"
        :hideButtons="true"
    >
        <tab-content title="Cabezera" icon="fa fa-gear">
            <CRow class="my-3">
                <CCol xs="5" style="text-align: right">
                    <FormLabel required>Numero remito</FormLabel>
                </CCol>
                <CCol xs="3">
                    <CFormInput
                        v-model="form.nombre"
                        type="text"
                        placeholder="Numero remito"
                        :feedback="form.errors.nombre"
                        :invalid="form.errors.nombre"
                    />
                </CCol>
            </CRow>
            <CRow class="my-3">
                <CCol xs="5" style="text-align: right">
                    <FormLabel required>Usuario</FormLabel>
                </CCol>
                <CCol xs="3">
                    <CFormInput
                        v-model="props.form.user"
                        type="text"
                        placeholder="Usuario"
                        :feedback="props.form.errors.user"
                        :invalid="props.form.errors.user"
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
                    />
                </CCol>
            </CRow>
            <CRow class="my-3">
                <CCol xs="5" style="text-align: right">
                    <FormLabel required>Fecha</FormLabel>
                </CCol>
                <CCol xs="3">
                    <CFormInput
                        v-model.lazy="form.fecha_ingreso"
                        type="date"
                        :feedback="getErrorMessage(errors?.fecha_ingreso)"
                        :invalid="getBooleanError(errors?.fecha_ingreso)"
                    ></CFormInput>
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
        </tab-content>
        <tab-content title="Orden de compra" icon="fa fa-user">
            <CRow>
                <CRow class="my-3">
                    <CCol xs="5">
                        <CFormLabel>Orden de compra</CFormLabel>
                        <vSelect
                            label="id"
                            :options="ordenComprasFiltered"
                            v-model="form.selectedOrdenCompra"
                            :value="form.selectedOrdenCompra"
                        ></vSelect>
                    </CCol>
                    <CCol
                        class="d-flex align-items-end justify-content-end btn-margin"
                    >
                        <CButton
                            type="button"
                            @click="addOrdenCompra()"
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
                                    <CTableHeaderCell
                                        scope="col"
                                        class="col-sm-2"
                                        >Nro. OC
                                    </CTableHeaderCell>
                                    <CTableHeaderCell
                                        scope="col"
                                        class="col-sm-2"
                                        >Fecha OC
                                    </CTableHeaderCell>
                                    <CTableHeaderCell
                                        scope="col"
                                        class="col-sm-2"
                                        >Fecha entrega
                                    </CTableHeaderCell>
                                </CTableRow>
                            </CTableHead>
                            <CTableBody>
                                <CTableRow
                                    v-for="ordenCompra in form.listOrdenCompras"
                                    :key="ordenCompra.id"
                                    class="cell-center"
                                >
                                    <CTableDataCell>
                                        <CircleButton
                                            class="ms-1"
                                            title="Eliminar"
                                            @click="
                                                showModal(true, ordenCompra)
                                            "
                                        >
                                            <span
                                                class="fa-solid fa-trash-can"
                                            ></span>
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
        </tab-content>
        <tab-content title="Detalle" icon="fa fa-gear">
            <CRow>
                <CRow class="my-3">
                    <CCol xs="5">
                        <CFormLabel>Detalle de compras</CFormLabel>
                        <CRow class="my-3">
                            <CCol xs="5" style="text-align: right">
                                <FormLabel required>Articulo</FormLabel>
                            </CCol>
                            <CCol xs="5">
                                <CFormInput
                                    v-model="form.productOrdenSelected.nombre"
                                    type="text"
                                    placeholder="Nombre del producto"
                                />
                            </CCol>
                        </CRow>
                        <CRow class="my-3">
                            <CCol xs="5" style="text-align: right">
                                <FormLabel required>Cantidad</FormLabel>
                            </CCol>
                            <CCol xs="5">
                                <CFormInput
                                    v-model="form.productOrdenSelected.cantidad"
                                    type="text"
                                    placeholder="Cantidad del producto"
                                />
                            </CCol>
                        </CRow>
                    </CCol>
                    <CCol
                        class="d-flex align-items-end justify-content-end btn-margin"
                    >
                        <CButton
                            type="button"
                            @click="actualizarDetalle()"
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
                                    <CTableHeaderCell
                                        scope="col"
                                        class="col-sm-2"
                                        >Articulo
                                    </CTableHeaderCell>
                                    <CTableHeaderCell
                                        scope="col"
                                        class="col-sm-2"
                                        >Detalle
                                    </CTableHeaderCell>
                                    <CTableHeaderCell
                                        scope="col"
                                        class="col-sm-2"
                                        >Cantidad
                                    </CTableHeaderCell>
                                </CTableRow>
                            </CTableHead>
                            <CTableBody>
                                {{ form.productsWithoutOrdenCompra }}
                                <CTableRow
                                    class="cell-center"
                                    v-for="(
                                        ordenCompraDetalle, index
                                    ) in mapProductsOrdenCompra"
                                >
                                    <CTableDataCell>
                                        <CircleButton
                                            class="ms-1"
                                            title="Eliminar"
                                            @click="
                                                showModal(
                                                    true,
                                                    ordenCompraDetalle,
                                                    index
                                                )
                                            "
                                        >
                                            <span
                                                class="fa-solid fa-trash-can"
                                            ></span>
                                        </CircleButton>
                                        <CircleButton
                                            class="ms-1"
                                            title="Modificar"
                                            @click="
                                                editarDetalle(
                                                    ordenCompraDetalle,
                                                    index
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
        </tab-content>
        <tab-content title="Resumen" icon="fa fa-gear">
            Resumen
            <div class="d-flex justify-content-between">
                <h3>Cabecera</h3>
                <h4>editar</h4>
            </div>
            <hr>

        </tab-content>
    </form-wizard>
    <Modal :visible="modal.show" @close="showModal()">
        <template #header> Eliminar Producto de la orden de compra </template>
        <CAlert color="warning">
            <span>
                <i class="fa-solid fa-trash-can m-2"></i>¿Estás seguro que deseas
                eliminar el producto de la orden de compra?
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
                @click="destroy"
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
