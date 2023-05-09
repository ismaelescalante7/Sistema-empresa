import administracion from './administracion'

const requistiosTramitesList = [
  ...administracion,
  {
    title: 'Requisitos Trámites',
    link: route('requisitos.tramites.index')
  }
]

const requisitosTramitesCreate = [
  ...requistiosTramitesList,
  {
    title: 'Nuevo Requisito',
    link: route('requisitos.tramites.create')
  }
]

const requisitosTramitesUpdate = [
  ...requistiosTramitesList,
  {
    title: 'Modificar Requisito',
    link: null
  }
]

export default {
  requistiosTramitesList,
  requisitosTramitesCreate,
  requisitosTramitesUpdate
}
