import configuracion from "./configuracion"

// Medidas
const medidasList = [
  ...configuracion,
  {
    title: 'Medidas',
    link: '/medidas'
  }
]

const medidasCreate = [
  ...medidasList,
  {
    title: 'Nueva Medida',
    link: '/medidas/create'
  }
]

const medidasShow = [
  ...medidasList,
  {
    title: 'Ver Medida',
    link: '/medidas/show'
  }
]

const medidasUpdate = [
  ...medidasList,
  {
    title: 'Modificar Medida',
    link: '/medidas/edit'
  }
]

export default {
  medidasList,
  medidasCreate,
  medidasShow,
  medidasUpdate
}
