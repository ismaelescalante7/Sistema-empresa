<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import breadcrumbs from '@/Data/Breadcrumbs'
import { useForm } from '@inertiajs/inertia-vue3'
import FormLabel from '@/Components/Form/FormLabel.vue'
import { computed, ref } from 'vue'
import Errors from '../../Utils/formatError'
import {useOrdenCompraStore} from '../../store/useOrdenCompra'
import Head from './Head.vue'
import Detalle from './Detalle.vue'

const { getErrorMessage, getBooleanError } = Errors()

const props = defineProps({
  proveedores: Array,
  condicionesPagos: Array,
  productos: Array
})

const form = useForm({
  descripcion: null,
  proveedor_id: null,
  condiciones_pagos_id: null,
  estado: null,
})

const tabPaneActiveKey = ref(1)

const ordenCompra = useOrdenCompraStore();

const nowDate = ref(new Date().toLocaleDateString());

const errorsAxios = ref(null)

const errors = computed(() => {
  if (errorsAxios.value) {
    return errorsAxios.value
  }
  return props.errors
})

const back = () => {
  Inertia.get(route('orden.compras.index'))
}

const createHead = () => {
  axios.post(route('orden.compra.process.head'), form)
    .then((res) => {
      ordenCompra.$state.condiciones_pagos_id = form.condiciones_pagos_id
      ordenCompra.$state.descripcion = form.descripcion
      ordenCompra.$state.proveedor_id = form.proveedor_id
      form.reset()
    })
    .catch((err) => {
      const status = err.response.status
      //loading.value = false
      if (status === 422) {
        errorsAxios.value = err.response.data.errors
    }
  })
}

const changeTabNext = (flag) => {
  if (flag){
    tabPaneActiveKey.value = tabPaneActiveKey.value + 1
  }
}

</script>

<template>
  <AppLayout :breadcrumb="breadcrumbs.ordenComprasCreate">
    <CNav variant="tabs" role="tablist">
    <CNavItem>
      <CNavLink
        href="javascript:void(0);"
        :active="tabPaneActiveKey === 1"
        @click="() => {tabPaneActiveKey = 1}"
      >
        Encabezado
      </CNavLink>
    </CNavItem>
    <CNavItem>
      <CNavLink
        href="javascript:void(0);"
        :active="tabPaneActiveKey === 2"
        @click="() => {tabPaneActiveKey = 2}"
      >
        Detalles
      </CNavLink>
    </CNavItem>

  </CNav>
  <CTabContent>
    <CTabPane role="tabpanel" aria-labelledby="home-tab" :visible="tabPaneActiveKey === 1">
      <Head :proveedores="props.proveedores" :condicionesPagos="props.condicionesPagos" @next="changeTabNext"/>
    </CTabPane>
    <CTabPane role="tabpanel" aria-labelledby="profile-tab" :visible="tabPaneActiveKey === 2">
      <Detalle :productos="props.productos"/>
    </CTabPane>
  </CTabContent>
  </AppLayout>
</template>