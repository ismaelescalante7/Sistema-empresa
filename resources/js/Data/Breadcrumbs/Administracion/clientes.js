import administracion from './administracion'

// Personas Humanas
const clientesList = [
  ...administracion,
  {
    title: 'Clientes',
    link: '/clientes'
  }
]

const clientesCreate = [
  ...clientesList,
  {
    title: 'Nuevo Cliente',
    link: '/cliente/create'
  }
]

const clientesShow = [
  ...clientesList,
  {
    title: 'Ver Cliente',
    link: '/cliente/show'
  }
]

const clientesUpdate = [
  ...clientesList,
  {
    title: 'Modificar Cliente',
    link: '/cliente/edit'
  }
]

export default {
  clientesList,
  clientesCreate,
  clientesShow,
  clientesUpdate
}
