<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import breadcrumbs from '@/Data/Breadcrumbs'
import UpdateGrid from './Partials/UpdateGrid.vue'
import UpdateActions from './Partials/UpdateActions.vue'
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
  role: Object,
  permissions: Array
})
const filter = reactive({
  permissions: props.permissions
})
const form = useForm({
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
const onSelect = (permission) => {
  form.permissions = form.permissions.map((item) => {
    if (item.id === permission.id) {
      item.status = item.status === 'SI' ? 'NO' : 'SI'
    }
    return item
  })
}
const onClean = () => {
  filter.permissions = form.permissions
}
const onSave = () => {
  form.patch(`/roles/${props.role.id}/permissions`)
}
const onCancel = () => {
  Inertia.get(`/roles/${props.role.id}/permissions`)
}
</script>
<template>
  <AppLayout
    title="Listado de permisos"
    :breadcrumb="breadcrumbs.permisosUpdate(role.id)"
  >
    <p>Rol: <strong>{{ props.role.description }}</strong></p>
    <UpdateActions
      :role="props.role"
      @search="onSearch"
      @clean="onClean"
      @save="onSave"
      @cancel="onCancel"
    />
    <UpdateGrid
      :role="props.role"
      :permissions="filter.permissions"
      @select="onSelect"
    />
    <CButton
      color="secondary"
      class="px-3"
      shape="rounded-pill"
      title="Cancelar"
      @click="onCancel"
    >
      Cancelar
    </CButton>
  </AppLayout>
</template>
