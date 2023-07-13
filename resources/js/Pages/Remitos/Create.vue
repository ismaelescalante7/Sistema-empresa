<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import breadcrumbs from "@/Data/Breadcrumbs";
import { FormWizard, TabContent } from "vue3-form-wizard";
import "vue3-form-wizard/dist/style.css";
import Head from "./Head.vue";
import OrdenCompras from "./OrdenCompras.vue";
import Detalle from "./Detalle.vue";
import Resumen from "./Resumen.vue";
import { useRemitoStore } from "@/store/useRemito";
import { storeToRefs } from "pinia";
import { computed, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const formWizards = ref(null);

const props = defineProps({
    localidades: Array,
    proveedores: Array,
    ordenCompras: Array,
    productos: Array,
    user: Object,
});

const errors = computed(() => {
    if (errorsAxios.value) {
        return errorsAxios.value;
    }
    return props.errors;
});

const remito = useRemitoStore();
const {  } =
    storeToRefs(remito);

const emit = defineEmits(["siguiente"]);
const errorsAxios = ref(null);

const siguienteTab = () => {
    formWizards.value.nextTab();
};
const crearRemito = () => {
    Inertia.post(route('remitos.store'), remito.getData, {
        onError: errors => {
            console.log(errors);
        },
    })
};
</script>

<template>
    <AppLayout :breadcrumb="breadcrumbs.remitosCreate" title="Nuevo Remito">
        <form-wizard color="#014E77" ref="formWizards" :hideButtons="true">
            <tab-content title="Cabezera" icon="fa fa-gear">
                <Head
                    :user="props.user"
                    :localidades="props.localidades"
                    :proveedores="props.proveedores"
                    @siguiente="siguienteTab"
                />
            </tab-content>
            <tab-content title="Orden de compra" icon="fa fa-user">
                <OrdenCompras
                    :ordenCompras="props.ordenCompras"
                    @siguiente="siguienteTab"
                />
            </tab-content>
            <tab-content title="Detalle" icon="fa fa-gear">
                <Detalle
                    :productos="props.productos"
                    @siguiente="siguienteTab"
                />
            </tab-content>
            <tab-content title="Resumen" icon="fa fa-gear">
                <Resumen :user="props.user" @finalizar="crearRemito" />
            </tab-content>
        </form-wizard>
    </AppLayout>
</template>
