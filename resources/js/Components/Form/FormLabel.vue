<script setup>
const props = defineProps({
  required: Boolean
})
</script>
<template>
  <CFormLabel>
    <slot></slot> <span v-if="props.required === true" style="color: red">*</span>
  </CFormLabel>
</template>
