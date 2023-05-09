import administracion from './administracion'

const delegacionesList = [
  ...administracion,
  {
    title: 'Delegaciones',
    link: '/delegaciones'
  }
]

const delegacionesCreate = [
  ...delegacionesList,
  {
    title: 'Nueva Delegación',
    link: '/delegaciones/nuevo'
  }
]

const delegacionesUpdate = [
  ...delegacionesList,
  {
    title: 'Modificar Delegación',
    link: '/delegaciones/edit'
  }
]

export default {
  delegacionesList,
  delegacionesCreate,
  delegacionesUpdate
}
