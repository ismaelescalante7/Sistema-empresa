import inventario from "./inventario"

// Remitos
const remitosList = [
  ...inventario,
  {
    title: 'Remitos',
    link: '/remitos'
  }
]

const remitosCreate = [
  ...remitosList,
  {
    title: 'Nueva Remito',
    link: '/remitos/create'
  }
]

const remitosShow = [
  ...remitosList,
  {
    title: 'Ver Remito',
    link: '/remitos/show'
  }
]

const remitosUpdate = [
  ...remitosList,
  {
    title: 'Modificar Remito',
    link: '/remitos/edit'
  }
]

export default {
  remitosList,
  remitosCreate,
  remitosShow,
  remitosUpdate
}