<script setup>
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  links: Array,
  extra: Object
})

const navigate = (url, extra) => {
  if (url === null) {
    return
  }
  Inertia.get(url, extra)
}

</script>

<template>
  <CPagination align="center">
    <CPaginationItem
      v-for="(item, index) in props.links"
      :key="index"
      :class="[item.active ? 'active' : '']"
      @click="navigate(item.url, extra)"
    >
      <span v-if="index === 0"> &laquo; </span>
      <span v-else-if="index === props.links.length - 1"> &raquo; </span>
      <span v-else>{{ item.label }}</span>
    </CPaginationItem>
  </CPagination>
</template>
