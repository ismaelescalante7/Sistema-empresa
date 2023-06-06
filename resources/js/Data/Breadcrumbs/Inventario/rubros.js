import inventario from "./inventario"

// Rubros
const rubrosList = [
  ...inventario,
  {
    title: 'Rubros',
    link: '/rubros'
  }
]

const rubrosCreate = [
  ...rubrosList,
  {
    title: 'Nueva Rubro',
    link: '/rubros/create'
  }
]

const rubrosShow = [
  ...rubrosList,
  {
    title: 'Ver Rubro',
    link: '/rubros/show'
  }
]

const rubrosUpdate = [
  ...rubrosList,
  {
    title: 'Modificar Rubro',
    link: '/rubros/edit'
  }
]

export default {
  rubrosList,
  rubrosCreate,
  rubrosShow,
  rubrosUpdate
}