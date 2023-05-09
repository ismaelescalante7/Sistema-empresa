import administracion from './administracion'

// Personas Humanas
const personasHumanasList = [
  ...administracion,
  {
    title: 'Personas Humanas',
    link: '/personas-humanas'
  }
]

const personasHumanasCreate = [
  ...personasHumanasList,
  {
    title: 'Nueva Persona Humana',
    link: '/personas-humanas/create'
  }
]

const personasHumanasShow = [
  ...personasHumanasList,
  {
    title: 'Ver Persona Humana',
    link: '/personas-humanas/show'
  }
]

const personasHumanasUpdate = [
  ...personasHumanasList,
  {
    title: 'Modificar Persona Humana',
    link: '/personas-humanas/edit'
  }
]

// Personas Juridicas

const personasJuridicasList = [
  ...administracion,
  {
    title: 'Personas Jurídicas',
    link: '/personas-juridicas'
  }
]

const personasJuridicasCreate = [
  ...personasJuridicasList,
  {
    title: 'Nueva Persona Jurídica',
    link: '/personas-juridicas/create'
  }
]

const personasJuridicasUpdate = [
  ...personasJuridicasList,
  {
    title: 'Modificar Persona Jurídica',
    link: '/personas-juridicas/update'
  }
]

const personasJuridicasShow = [
  ...personasJuridicasList,
  {
    title: 'Ver Persona Jurídica',
    link: '/personas-juridicas/show'
  }
]

export default {
  personasHumanasList,
  personasHumanasCreate,
  personasHumanasShow,
  personasHumanasUpdate,
  personasJuridicasList,
  personasJuridicasCreate,
  personasJuridicasUpdate,
  personasJuridicasShow
}
