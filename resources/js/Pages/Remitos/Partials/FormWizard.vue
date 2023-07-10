<script setup>
import { FormWizard, TabContent } from "vue3-form-wizard";
import "vue3-form-wizard/dist/style.css";
import FormLabel from "@/Components/Form/FormLabel.vue";
import FormInputAutocomplete from "@/Components/Form/FormInputAutocomplete.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { computed, reactive, ref, onMounted } from "vue";
import Errors from "@/Utils/formatError";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import CircleButton from "@/Components/CircleButton.vue";
import Modal from "@/Components/Modal.vue";
import { Inertia } from "@inertiajs/inertia";
import axios from "axios";

const { getErrorMessage, getBooleanError } = Errors();

const props = defineProps({
    localidades: Array,
    proveedores: Array,
    ordenCompras: Array,
    productos: Array,
    form: Object,
    user: Object,
});

const form = useForm({
    numero: null,
    localidad_id: null,
    proveedor_id: null,
    fecha_ingreso: null,
    user_id: props.user.id,
    detalles: [],
});

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
const localidadSelected = ref(null);
const localidadFiltered = ref(null);
const proveedorSelected = ref(null);
const proveedorFiltered = ref(null);
const productoSelected = ref(null);
const productoFiltered = ref(null);

const ordenComprasFiltered = ref(null);
const ordenCompraSelected = ref(null);
const detalle = ref({});

detalle.value = {
    producto_id: null,
    orden_compra_id: null,
    cantidad_pendiente: 0,
    cantidad: 0,
    nombre: null,
};

ordenComprasFiltered.value = props.ordenCompras;

const listOrdenCompras = ref([]);
const errorsAxios = ref(null);

const formWizards = ref(null);

const ordenesDeCompra = computed(() => {
    return listOrdenCompras.value;
});

onMounted(() => {
    form.fecha_ingreso = new Date().toISOString().slice(0, 10);
});

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

const selectionProducto = (productoFiltered) => {
    detalle.value.producto_id = productoFiltered.id;
    detalle.value.nombre = productoFiltered.nombre;
    productoSelected.value = props.productos.find(
        (item) => item.id === productoFiltered.id
    );
};

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

const agregarProducto = () => {
    axios
        .post(route("remito.process.detalle"), detalle.value)
        .then((res) => {
            form.detalles.push(res.data);
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
        form.detalles[modal.index] = productCopy.value
        showModal()
    });
};
const eliminarDetalle = () => {};

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

const goThirdTab = () => {
    formWizards.value.nextTab();

    form.detalles = listOrdenCompras.value.flatMap((item) =>
        item.detalle_orden_compra.map((detalle) => ({
            producto_id: detalle.producto.id,
            nombre: detalle.producto.nombre,
            cantidad: detalle.cantidad,
            cantidad_pendiente: 0,
            orden_compra_id: detalle.orden_compra_id,
        }))
    );
};
const goFourthTab = () => {
    formWizards.value.nextTab();
};
const onComplete = () => {
    form.post(route("remitos.store"),{
        onError: (errors) => {
            console.log(errors);
        },
    })
    
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
                        v-model="form.numero"
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
                        :feedback="getErrorMessage(errors?.form.fecha_ingreso)"
                        :invalid="getBooleanError(errors?.form.fecha_ingreso)"
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
                        <v-select
                            label="id"
                            :options="ordenComprasFiltered"
                            v-model="ordenCompraSelected"
                        ></v-select>
                    </CCol>
                    <CCol
                        class="d-flex align-items-end justify-content-end btn-margin"
                    >
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
                                    v-for="ordenCompra in ordenesDeCompra"
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
                                <FormLabel required>Producto</FormLabel>
                            </CCol>
                            <CCol xs="5">
                                <FormInputAutocomplete
                                    label="nombre"
                                    value="id"
                                    :items="
                                        props.productos.map(
                                            ({ nombre, id }) => ({
                                                nombre,
                                                id,
                                            })
                                        )
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
                                        getErrorMessage(
                                            errors?.detalle.cantidad
                                        )
                                    "
                                    :invalid="
                                        getBooleanError(
                                            errors?.detalle.cantidad
                                        )
                                    "
                                />
                            </CCol>
                        </CRow>
                    </CCol>
                    <CCol
                        class="d-flex align-items-end justify-content-end btn-margin"
                    >
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
                                <CTableRow
                                    class="cell-center"
                                    v-for="(
                                        ordenCompraDetalle, index
                                    ) in form.detalles"
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
                                            <span
                                                class="fa-solid fa-trash-can"
                                            ></span>
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
        </tab-content>
        <tab-content title="Resumen" icon="fa fa-gear">
            Resumen
            <div class="d-flex justify-content-between">
                <h3>Cabecera</h3>
                <h4>editar</h4>
            </div>
            <hr />
            <CRow>
                <CCol>Numero remito</CCol>
                <CCol> numero </CCol>
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
                <CCol> {{ proveedorSelected?.razon_social }} </CCol>
            </CRow>
            <CRow>
                <CCol>Sucursal</CCol>
                <CCol> {{ localidadSelected?.nombre }} </CCol>
            </CRow>
            <CRow>
                <CCol>Fecha ingreso</CCol>
                <CCol> Fecha ingreso </CCol>
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
        </tab-content>
    </form-wizard>
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
