import compra from "./compra"

// Orden Comprass
const ordenComprasList = [
  ...compra,
  {
    title: 'Orden Compras',
    link: '/orden-compras'
  }
]

const ordenComprasCreate = [
  ...ordenComprasList,
  {
    title: 'Nueva Orden Compras',
    link: '/orden-compras/create'
  }
]

const ordenComprasShow = [
  ...ordenComprasList,
  {
    title: 'Ver Orden Compras',
    link: '/orden-compras/show'
  }
]

const ordenComprasUpdate = [
  ...ordenComprasList,
  {
    title: 'Modificar Orden Compras',
    link: '/orden-compras/edit'
  }
]

export default {
  ordenComprasList,
  ordenComprasCreate,
  ordenComprasShow,
  ordenComprasUpdate
}