<script setup>
const props = defineProps({
  message: String,
  bgColor: String,
  textColor: String,
  closeButton: Boolean,
  showToast: {
    type: Boolean,
    default: false
  }
})
</script>

<style scoped>
.custom-toaster {
  position: fixed;
  top: 1rem;
  right: 1rem;
  z-index: 9999;
}

.slide-from-right {
  animation: slide-in 0.5s forwards;
}

@keyframes slide-in {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(0);
  }
}
</style>

<template>
  <CToaster
    v-if="props.showToast"
    position="top-right"
    class="custom-toaster"
  >
    <CToast
      :autohide="true"
      :color="props.bgColor"
      :class="[props.textColor, 'align-items-center', 'slide-from-right']"
    >
      <div class="d-flex">
        <CToastBody>{{ props.message }}</CToastBody>
        <CToastClose
          class="me-2 m-auto"
          black
        />
      </div>
    </CToast>
  </CToaster>
</template>
