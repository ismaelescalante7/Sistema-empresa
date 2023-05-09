<script setup>
import FormInputAutocomplete from '@/Components/Form/FormInputAutocomplete.vue'

const props = defineProps({
  items: Array,
  label: String,
  value: String,
  selectedItems: Array,
  error: String
})

const emit = defineEmits(['onSelect', 'onRemove'])

const onSelect = (item) => {
  emit('onSelect', item)
}
const onRemove = (item) => {
  emit('onRemove', item)
}
</script>
<template>
  <FormInputAutocomplete
    :label="props.label"
    :value="props.id"
    :items="props.items"
    :error="error"
    :cleanable="true"
    @onSelect="onSelect"
  />
  <h4
    v-if="props.selectedItems.length !== 0"
    class="my-2"
  >
    <CBadge
      v-for="item in props.selectedItems"
      :key="item[props.value]"
      class="me-2 mb-1"
      color="primary"
    >
      {{ item[props.label] }}
      <span @click="onRemove(item)">
        <i class="fa-solid fa-xmark"></i>
      </span>
    </CBadge>
  </h4>
</template>
