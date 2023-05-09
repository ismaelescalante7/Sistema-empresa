<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  path: Array
})

const last = (index, length) => {
  return index === length - 1
}

const isNull = (item) => {
  return item.link === null
}

</script>
<template>
  <CBreadcrumb>
    <CBreadcrumbItem
      v-for="(item, index) of props.path"
      :key="index"
      :href="last(index, props.path.length) ? '' : item.link"
      :active="last(index, props.path.length) || isNull(item)"
    >
      {{ item.title }}
    </CBreadcrumbItem>
  </CBreadcrumb>
</template>
