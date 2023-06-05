import inventario from "./inventario"

// Depositos
const depositosList = [
  ...inventario,
  {
    title: 'Depositos',
    link: '/depositos'
  }
]

const depositosCreate = [
  ...depositosList,
  {
    title: 'Nueva Deposito',
    link: '/depositos/create'
  }
]

const depositosShow = [
  ...depositosList,
  {
    title: 'Ver Deposito',
    link: '/depositos/show'
  }
]

const depositosUpdate = [
  ...depositosList,
  {
    title: 'Modificar Deposito',
    link: '/depositos/edit'
  }
]

export default {
  depositosList,
  depositosCreate,
  depositosShow,
  depositosUpdate
}