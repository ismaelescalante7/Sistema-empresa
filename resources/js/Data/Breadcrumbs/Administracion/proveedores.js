import administracion from './administracion'

// Personas Humanas
const proveedoresList = [
  ...administracion,
  {
    title: 'Proveedores',
    link: '/proveedores'
  }
]

const proveedoresCreate = [
  ...proveedoresList,
  {
    title: 'Nuevo Proveedor',
    link: '/proveedores/create'
  }
]

const proveedoresShow = [
  ...proveedoresList,
  {
    title: 'Ver Proveedor',
    link: '/proveedores/show'
  }
]

const proveedoresUpdate = [
  ...proveedoresList,
  {
    title: 'Modificar Proveedor',
    link: '/proveedores/edit'
  }
]

export default {
  proveedoresList,
  proveedoresCreate,
  proveedoresShow,
  proveedoresUpdate
}
