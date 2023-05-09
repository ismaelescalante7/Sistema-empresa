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
      <CNavItem href="#">
        <i class="fa-solid fa-list-check nav-icon"></i>
        Tareas por Módulo
      </CNavItem>
      <CNavGroup
        :visible="onActive(['Tareas'])"
      >
        <template #togglerContent>
          COMUNICACIÓN
        </template>
        <CNavItem>
          <Link
            :href="route('tareas.mis-tareas')"
            :class="['nav-link', {'active': onActive(['Tareas'])}]"
          >
            <i class="fa-solid fa-file-pen nav-icon"></i>
            Tareas
          </Link>
        </CNavItem>
        <CNavItem href="#">
          <i class="fa-solid fa-magnifying-glass nav-icon"></i>
          Buscador CO
        </CNavItem>
        <CNavGroup>
          <template #togglerContent>
            <i class="fa-solid fa-inbox nav-icon"></i>
            Bandeja
          </template>
          <CNavItem href="#">
            Entrada
          </CNavItem>
          <CNavItem href="#">
            Salida
          </CNavItem>
        </CNavGroup>
      </CNavGroup>
      <CNavGroup>
        <template #togglerContent>
          TRAMITACIÓN
        </template>
      </CNavGroup>
      <CNavGroup
        :visible = "onActive(['Users', 'Roles', 'Accesos', 'Permissions', 'Productos'])"
      >
        <template #togglerContent>
          ADMINISTRACIÓN
        </template>
        <CNavGroup
          :visible="onActive(['Users', 'Roles', 'Accesos', 'Permissions'])"
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
            @click="onNavigate('/productos')"
            class="nav-link"
            :class="{ 'active': onActive(['Productos']) }"
          >
            <i class="fa-solid fa-building-columns nav-icon"></i>
            Productos
          </Link>
        </CNavItem>
      </CNavGroup>
    </CSidebarNav>
  </CSidebar>
</template>
