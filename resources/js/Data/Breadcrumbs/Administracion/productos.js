import administracion from './administracion'

const productosList = [
  ...administracion,
  {
    title: 'Productos',
    link: '/productos'
  }
]

const productosCreate = [
  ...productosList,
  {
    title: 'Nuevo producto',
    link: '/productos/create'
  }
]

const productosUpdate = [
  ...productosList,
  {
    title: 'Modificar',
    link: '/productos/edit'
  }
]

export default {
  productosList,
  productosCreate,
  productosUpdate
}
