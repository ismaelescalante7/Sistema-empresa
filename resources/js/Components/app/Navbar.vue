<script setup>
import { Inertia } from '@inertiajs/inertia'

const perfil = () => {
  Inertia.get(route('profile.show'))
}
const logout = () => {
  Inertia.post(route('logout'))
}
</script>

<template>
  <CHeader position="sticky" colorScheme="light" class="bg-light">
    <CContainer fluid>
      <CHeaderToggler class="ps-1" @click="$store.commit('toggleSidebar')">
        <CIcon icon="cil-menu" size="lg" />
      </CHeaderToggler>
      <CHeaderNav>
        <CNavItem>
          <CNavLink href="#">
            <CIcon class="mx-2" icon="cil-bell" size="lg" />
          </CNavLink>
        </CNavItem>
        <CNavItem>
          <CNavLink href="#">
            <CIcon class="mx-2" icon="cil-envelope-open" size="lg" />
          </CNavLink>
        </CNavItem>
        <!-- Va el HeadreDrop -->
        <CDropdown variant="nav-item">
          <CDropdownToggle placement="bottom-end" class="py-0" :caret="false">
            <CAvatar :src="$page.props.auth.user.profile_photo" size="md"/>
          </CDropdownToggle>
          <CDropdownMenu class="pt-0">
            <CDropdownItem @click="perfil">
              <i class="fa-solid fa-user"></i> Perfil
            </CDropdownItem>
            <CDropdownDivider />
            <CDropdownItem>
              <i class="fa-solid fa-list"></i> Historial de accesos
            </CDropdownItem>
            <CDropdownItem @click="logout()">
              <i class="fa-solid fa-right-from-bracket"></i> Salir
            </CDropdownItem>
          </CDropdownMenu>
        </CDropdown>
        <!-- Fin -->
      </CHeaderNav>
    </CContainer>
  </CHeader>
</template>
