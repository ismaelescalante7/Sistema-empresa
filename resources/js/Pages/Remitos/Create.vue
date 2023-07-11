<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import breadcrumbs from "@/Data/Breadcrumbs";
import { useForm } from "@inertiajs/inertia-vue3";
import { FormWizard, TabContent } from "vue3-form-wizard";
import "vue3-form-wizard/dist/style.css";
import { ref } from "vue";
import Head from "./Head.vue";
import OrdenCompras from "./OrdenCompras.vue";
import Detalle from "./Detalle.vue";

const formWizards = ref(null);

const props = defineProps({
    localidades: Array,
    proveedores: Array,
    ordenCompras: Array,
    productos: Array,
    user: Object,
});

const siguienteTab = () => {
    formWizards.value.nextTab();
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
            <tab-content title="Resumen" icon="fa fa-gear"> </tab-content>
        </form-wizard>
    </AppLayout>
</template>
