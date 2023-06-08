import inventario from "./inventario"

// Orden Comprass
const ordenComprasList = [
  ...inventario,
  {
    title: 'Orden Comprass',
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