<script setup>

const props = defineProps({
  visible: Boolean,
  tam: {
    type: String,
    default: 'lg'
  }
})

const emits = defineEmits(['close'])

const onClose = () => {
  emits('close')
}

</script>
<template>
  <CModal
    backdrop="static"
    :visible="props.visible"
    :size="props.tam"
    @close="onClose"
  >
    <CModalHeader>
      <CModalTitle>
        <slot name="header"></slot>
      </CModalTitle>
    </CModalHeader>
    <CModalBody>
      <slot></slot>
    </CModalBody>
    <CModalFooter>
      <slot name="footer"></slot>
    </CModalFooter>
  </CModal>
</template>
