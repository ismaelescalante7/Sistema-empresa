<script setup>
import { onMounted, ref } from 'vue'
import { generate } from '@/Utils/uuid'
import Autocomplete from 'bootstrap5-autocomplete/autocomplete'
const props = defineProps({
  items: Array,
  label: String,
  value: String,
  error: String,
  cleanable: {
    type: Boolean,
    default: false
  }
})

const id = `autocomplete-${generate()}`
const input = ref('')

const emit = defineEmits(['onSelect'])

const onSelect = (item) => {
  emit('onSelect', item)
  input.value = item[props.label]
  if (props.cleanable === true) {
    input.value = ''
  }
}
onMounted(() => {
  Autocomplete.init(`#${id}`, {
    items: props.items,
    valueField: props.value,
    labelField: props.label,
    highlightTyped: true,
    onSelectItem: onSelect,
    fullWidth: true
  })
})
</script>
<template>
  <input
    v-model="input"
    class="form-control"
    :id="id"
  />
  <small
    v-if="!!error"
    class="text-danger"
  >
    {{ error }}
  </small>
</template>
