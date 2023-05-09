<script setup>
import { ref } from 'vue'

const props = defineProps({
  inputValue: String,
  errorsInput: String
})

const showPassword = ref(false)

const emit = defineEmits([
  'update:inputValue'
])

</script>
<template>
  <CInputGroup>
    <CFormInput
      :value="props.inputValue"
      :type="showPassword ? 'text' : 'password'"
      :invalid="errorsInput"
      @input="emit('update:inputValue', $event.target.value)"
    />
    <CButton
      type="button"
      color="primary"
      variant="outline"
      @click="showPassword = !showPassword"
    >
      <i class="fa-solid" :class="{ 'fa-eye-slash': !showPassword, 'fa-eye': showPassword }"></i>
    </CButton>
    <div
      v-if="errorsInput"
      class="invalid-feedback">
      {{ errorsInput}}
    </div>
  </CInputGroup>
</template>
