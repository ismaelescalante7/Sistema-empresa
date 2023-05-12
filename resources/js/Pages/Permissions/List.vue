<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import breadcrumbs from '@/Data/Breadcrumbs'
import Grid from './Partials/Grid.vue'
import Actions from './Partials/Actions.vue'
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  role: Object,
  permissions: Array
})
const filter = reactive({
  permissions: props.permissions
})
const onSearch = (form) => {
  filter.permissions = props.permissions
  if (form.description !== null) {
    filter.permissions = filter.permissions.filter(
      item => item.description.toLowerCase().includes(form.description.toLowerCase())
    )
  }
  if (form.status !== null) {
    filter.permissions = filter.permissions.filter(
      item => item.status === form.status
    )
  }
}
const back = () => {
  Inertia.get('/roles')
}
</script>
<template>
  <AppLayout
    title="Listado de permisos"
    :breadcrumb="breadcrumbs.permisosList(role.id)"
  >
    <p>Rol: <strong>{{ props.role.description }}</strong></p>
    <Actions
      :role="props.role"
      @search="onSearch"
    />
    <Grid
      :role="props.role"
      :permissions="filter.permissions"
    />
    <CButton
      color="secondary"
      class="px-3"
      shape="rounded-pill"
      title="Volver"
      @click="back"
    >
      Volver
    </CButton>
  </AppLayout>
</template>
