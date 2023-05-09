import administracion from './administracion'

const users = [
  ...administracion,
  {
    title: 'Usuarios',
    link: null
  }
]

// Users
const usersList = [
  ...users,
  {
    title: 'Listado',
    link: '/users'
  }
]

const usersCreate = [
  ...usersList,
  {
    title: 'Nuevo Usuario',
    link: '/users/create'
  }
]

const usersUpdate = [
  ...usersList,
  {
    title: 'Modificar datos de usuario',
    link: '/users/edit'
  }
]

const pinGeneration = [
  ...users,
  {
    title: 'PIN',
    link: '/pin'
  }
]

const pinChange = [
  ...users,
  {
    title: 'PIN',
    link: '/pin/edit'
  }
]

// Roles
const rolesList = [
  ...users,
  {
    title: 'Roles',
    link: '/roles'
  }
]

const rolesCreate = [
  ...rolesList,
  {
    title: 'Nuevo Rol',
    link: '/roles/create'
  }
]

const rolesUpdate = [
  ...rolesList,
  {
    title: 'Modificar datos de rol',
    link: '/roles/update'
  }
]

const permisosList = (id) => {
  return [
    ...rolesList,
    {
      title: 'Listado de permisos',
      link: `/roles/${id}/permissions`
    }
  ]
}

const permisosUpdate = (id) => {
  return [
    ...permisosList(id),
    {
      title: 'Editar permisos',
      link: `/roles/${id}/permissions/edit`
    }
  ]
}

// Accesos
const accesosList = [
  ...usersList,
  {
    title: 'Accesos',
    link: '/users'
  }
]

const accesosCreate = [
  ...accesosList,
  {
    title: 'Nuevo',
    link: '/users/accesos/nuevo'
  }
]

// Profile
const profileShow = [
  {
    title: 'Perfil de usuario',
    link: route('profile.show')
  }
]

export default {
  usersList,
  usersCreate,
  usersUpdate,
  pinGeneration,
  pinChange,
  rolesList,
  rolesCreate,
  rolesUpdate,
  permisosList,
  permisosUpdate,
  accesosList,
  accesosCreate,
  profileShow
}
