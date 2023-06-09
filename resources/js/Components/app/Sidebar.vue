<script setup>
import { computed } from 'vue'
import { useStore } from 'vuex'
import { Inertia } from '@inertiajs/inertia'
import { Link, usePage } from '@inertiajs/inertia-vue3'
import ente from '@/assets/images/ente.png'

const store = useStore()
const sidebarVisible = computed(() => store.state.sidebarVisible)
const onNavigate = (url) => {
  Inertia.get(url)
}

const onActive = (list) => {
  return list.some(
    item => usePage().component.value.startsWith(item)
  )
}

</script>
<template>
  <CSidebar
    class="sidebar sidebar-dark sidebar-fixed"
    :visible="sidebarVisible"
    @visible-change="
      (event) =>
        $store.commit({
          type: 'updateSidebarVisible',
          value: event,
        })
    "
  >
    <CSidebarBrand class="logo-sidebar">
      <CImage :src="ente" width="100"/>
    </CSidebarBrand>
    <CSidebarNav>
      <CNavGroup
        :visible = "onActive(['TiposComprobante', 'CondicionesIvas','RetencionesGanancias','PlanesCuentas','FormasPagos','Medidas','RetencionIngresosBruto', 'CondicionesPagos'])"
      >
        <template #togglerContent>
          CONFIGURACIÓN
        </template>
        <CNavItem>
          <Link
            href="#"
            @click="onNavigate('/retencion-ingresos-bruto')"
            class="nav-link"
            :class="{ 'active': onActive(['RetencionIngresosBruto']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Retenciones Ingresos Bruto
          </Link>
          <Link
            href="#"
            @click="onNavigate('/retenciones-ganancias')"
            class="nav-link"
            :class="{ 'active': onActive(['RetencionesGanancias']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Retenciones Ganancias
          </Link>
          <Link
            href="#"
            @click="onNavigate('/tipos-comprobantes')"
            class="nav-link"
            :class="{ 'active': onActive(['TiposComprobante']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Tipos Comprobantes
          </Link>
          <Link
            href="#"
            @click="onNavigate('/planes-cuentas')"
            class="nav-link"
            :class="{ 'active': onActive(['PlanesCuentas']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Planes Cuentas
          </Link>
          <Link
            href="#"
            @click="onNavigate('/formas-pagos')"
            class="nav-link"
            :class="{ 'active': onActive(['FormasPagos']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Formas Pagos
          </Link>
          <Link
            href="#"
            @click="onNavigate('/condiciones-pagos')"
            class="nav-link"
            :class="{ 'active': onActive(['CondicionesPagos']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Condiciones Pagos
          </Link>
          <Link
            href="#"
            @click="onNavigate('/condiciones-ivas')"
            class="nav-link"
            :class="{ 'active': onActive(['CondicionesIvas']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Condiciones Ivas
          </Link>
          <Link
            href="#"
            @click="onNavigate('/medidas')"
            class="nav-link"
            :class="{ 'active': onActive(['Medidas']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Medidas
          </Link>
        </CNavItem>
      </CNavGroup>
      <CNavGroup
        :visible = "onActive(['Users', 'Roles', 'Permissions', 'Clientes', 'Proveedores'])"
      >
        <template #togglerContent>
          ADMINISTRACIÓN
        </template>
        <CNavGroup
          :visible="onActive(['Users', 'Roles', 'Permissions','Clientes', 'Proveedores'])"
        >
          <template
            #togglerContent
          >
            <i class="fa-regular fa-user class nav-icon"></i>
            Usuarios
          </template>
          <Link
            href="#"
            @click="onNavigate('/users')"
            class="nav-link"
            :class="{ 'active': onActive(['Users']) }"
          >
            Listado
          </Link>
          <Link
            href="#"
            @click="onNavigate('/roles')"
            class="nav-link"
            :class="{ 'active': onActive(['Roles', 'Permissions']) }"
          >
            Roles
          </Link>
        </CNavGroup>
        <CNavItem>
          <Link
            href="#"
            @click="onNavigate('/clientes')"
            class="nav-link"
            :class="{ 'active': onActive(['Clientes']) }"
          >
            <i class="fa-solid fa-users nav-icon"></i>
            Clientes
          </Link>
        </CNavItem>
        <CNavItem>
          <Link
            href="#"
            @click="onNavigate('/proveedores')"
            class="nav-link"
            :class="{ 'active': onActive(['Proveedores']) }"
          >
            <i class="fa-solid fa-users nav-icon"></i>
            Proveedores
          </Link>
        </CNavItem>
      </CNavGroup>
      <CNavGroup
        :visible = "onActive(['Productos', 'Marcas','Depositos','Rubros'])"
      >
        <template #togglerContent>
          INVENTARIO
        </template>
        <CNavItem>
          <Link
            href="#"
            @click="onNavigate('/rubros')"
            class="nav-link"
            :class="{ 'active': onActive(['Rubros']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Rubro
          </Link>
          <Link
            href="#"
            @click="onNavigate('/depositos')"
            class="nav-link"
            :class="{ 'active': onActive(['Depositos']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Depositos
          </Link>
          <Link
            href="#"
            @click="onNavigate('/marcas')"
            class="nav-link"
            :class="{ 'active': onActive(['Marcas']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Marcas
          </Link>
        </CNavItem>
        <CNavItem>
          <Link
            href="#"
            @click="onNavigate('/productos')"
            class="nav-link"
            :class="{ 'active': onActive(['Productos']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Productos
          </Link>
        </CNavItem>
      </CNavGroup>
      <CNavGroup
        :visible = "onActive(['OrdenCompra','Remito'])"
      >
        <template #togglerContent>
          COMPRAS
        </template>
        <CNavItem>
          <Link
            href="#"
            @click="onNavigate('/orden-compras')"
            class="nav-link"
            :class="{ 'active': onActive(['OrdenCompra']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Orden de compras
          </Link>
        </CNavItem>
        <CNavItem>
          <Link
            href="#"
            @click="onNavigate('/remitos')"
            class="nav-link"
            :class="{ 'active': onActive(['Remito']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Remitos
          </Link>
        </CNavItem>
      </CNavGroup>
    </CSidebarNav>
  </CSidebar>
</template>
