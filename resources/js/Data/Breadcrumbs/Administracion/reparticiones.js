import administracion from './administracion'

const reparticionesList = [
  ...administracion,
  {
    title: 'Reparticiones',
    link: '/reparticiones'
  }
]

const reparticionesCreate = [
  ...reparticionesList,
  {
    title: 'Nueva Repartición',
    link: '/reparticiones/create'
  }
]

const reparticionesUpdate = [
  ...reparticionesList,
  {
    title: 'Modificar',
    link: '/reparticiones/edit'
  }
]

export default {
  reparticionesList,
  reparticionesCreate,
  reparticionesUpdate
}
