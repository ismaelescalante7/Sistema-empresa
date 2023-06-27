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

const { getErrorMessage, getBooleanError } = Errors();

const props = defineProps({
    localidades: Array,
    proveedores: Array,
    ordenCompras: Array,
    form: Object,
});

const form = useForm({
    nombre: null,
    localidad_id: null,
    proveedor_id: null,
    fecha_ingreso: null,
    listOrdenCompras: [],
    selectedOrdenCompra: null,
});

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

const goSecondTab = () => {
    axios
        .post(route("remito.process.head"), form)
        .then((res) => {
            console.log(res.data);
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
                                <FormLabel required>Cantidad</FormLabel>
                            </CCol>
                            <CCol xs="5">
                                <CFormInput
                                    v-model="form.nombre"
                                    type="text"
                                    placeholder="Numero remito"
                                    :feedback="form.errors.nombre"
                                    :invalid="form.errors.nombre"
                                />
                            </CCol>
                        </CRow>
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
                                        ordenCompra.descripcion
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
                {{ ordenComprasFiltered }}
            </CRow>
        </tab-content>
        <tab-content title="Resumen" icon="fa fa-gear"> dafdsafd </tab-content>
    </form-wizard>
</template>
