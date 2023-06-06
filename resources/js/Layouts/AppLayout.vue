<script setup>
import Sidebar from '../Components/app/Sidebar.vue'
import Navbar from '../Components/app/Navbar.vue'
import Footer from '../Components/app/Footer.vue'
import Breadcrumb from '../Components/Breadcrumb.vue'

const props = defineProps({
  breadcrumb: null,
  title: null
})
</script>

<template>
  <Sidebar/>
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <Navbar />
    <Breadcrumb :path="props.breadcrumb"/>
    <div class="flex-grow-1">
      <CContainer fluid>
        <CAlert
          v-if="$page.props.alert.message"
          :color="$page.props.alert.type"
          variant="solid"
        >
          {{ $page.props.alert.message }}
        </CAlert>
        <CCard>
          <CCardBody>
            <h4 class="mb-3">{{ props.title }}</h4>
            <slot></slot>
          </CCardBody>
        </CCard>
      </CContainer>
    </div>
    <Footer/>
  </div>
</template>

