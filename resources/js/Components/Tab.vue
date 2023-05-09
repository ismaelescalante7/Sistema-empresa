<script setup>

const props = defineProps({
  tabs: Array
})

</script>
<template>
  <CNav variant="tabs" role="tablist">
    <CNavItem
      v-for="(tab, index) in props.tabs"
      :key="index"
    >
      <CNavLink
        :href="route(tab.link)"
        :active="$page.component.startsWith(tab.nameComponent)"
      >
        {{tab.nombre}}
      </CNavLink>
    </CNavItem>
  </CNav>
  <br>
</template>
