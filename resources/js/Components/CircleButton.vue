<script setup>
const props = defineProps({
  type: {
    type: String,
    default: 'submit'
  },
  color: {
    color: String,
    default: 'primary'
  },
  title: {
    title: String,
    default: ''
  }
})

const clase = `btn-circle btn-circle-${props.color}`
</script>

<style scope>
.btn-circle{
  display: inline-flex;
  width: 35px;
  height: 35px;
  border-radius: 50%;
  align-items: center;
  text-align: center;
  justify-content: center;
  border: none;
}

.btn-circle-primary{
  background-color: #014E77;
  border-color: solid #014E77;
  color: #FFFFFF;
}

.btn-circle-primary:hover {
  background-color: #257DBC;
  border-color: #257DBC;
}

.btn-circle-secondary{
  background-color: #707478;
  border-color: #707478;
  color: #FFFFFF;
}

.btn-circle-secondary:hover {
  background-color: #BBC2C9;
  border-color: #BBC2C9;
}
</style>

<template>
  <button :type="props.type" :class="clase" :title="props.title">
    <slot/>
  </button>
</template>
