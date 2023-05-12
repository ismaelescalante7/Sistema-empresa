<script setup>

const props = defineProps({
  role: Object,
  permissions: Array
})
const emit = defineEmits(['select'])

const onSelect = (permission) => {
  emit('select', permission)
}

</script>
<template>
  <CTable class="mt-3">
    <CTableHead>
      <CTableRow color="secondary">
        <CTableHeaderCell scope="col" class="col-sm-5">Permiso</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-5">Nombre del Permiso</CTableHeaderCell>
        <CTableHeaderCell scope="col" class="col-sm-2">Habilitado</CTableHeaderCell>
      </CTableRow>
    </CTableHead>
    <CTableBody>
      <CTableRow
        v-for="permission in props.permissions"
        :key="permission.id"
        class="cell-center"
      >
        <CTableDataCell>{{ permission.name }}</CTableDataCell>
        <CTableDataCell>{{ permission.description }}</CTableDataCell>
        <CTableDataCell>
          <CFormSwitch
            :checked="permission.status === 'SI'"
            @click="onSelect(permission)"
          />
        </CTableDataCell>
      </CTableRow>
    </CTableBody>
  </CTable>

  <CAlert v-if="props.permissions.length === 0" color="info">
    Sin resultados.
  </CAlert>

</template>
<style>
.cell-center{
  vertical-align: baseline;
}
</style>
