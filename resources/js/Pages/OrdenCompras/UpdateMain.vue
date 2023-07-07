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
import Show from './Show.vue'

const { getErrorMessage, getBooleanError } = Errors()

const props = defineProps({
  proveedores: Array,
  condicionesPagos: Array,
  productos: Array,
  ordenCompra: Object
})

const ordenCompra = useOrdenCompraStore();
ordenCompra.fill(props.ordenCompra)

const tabPaneActiveKey = ref(1)

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


const changeTabNext = (flag) => {
  if (flag){
    tabPaneActiveKey.value = tabPaneActiveKey.value + 1
  }
}

</script>

<template>
  <AppLayout :breadcrumb="breadcrumbs.ordenComprasUpdate">
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
    <CNavItem>
      <CNavLink
        href="javascript:void(0);"
        :active="tabPaneActiveKey === 3"
        @click="() => {tabPaneActiveKey = 3}"
      >
        Resumen
      </CNavLink>
    </CNavItem>

  </CNav>
  <CTabContent>
    <CTabPane role="tabpanel" aria-labelledby="home-tab" :visible="tabPaneActiveKey === 1">
      <Head :proveedores="props.proveedores" :condicionesPagos="props.condicionesPagos" @next="changeTabNext"/>
    </CTabPane>
    <CTabPane role="tabpanel" aria-labelledby="profile-tab" :visible="tabPaneActiveKey === 2">
      <Detalle :productos="props.productos" @next="changeTabNext"/>
    </CTabPane>
    <CTabPane role="tabpanel" aria-labelledby="profile-tab" :visible="tabPaneActiveKey === 3">
      <Show />
    </CTabPane>
  </CTabContent>
  </AppLayout>
</template>