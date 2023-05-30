import configuracion from "./configuracion"

// Personas Humanas
const condicionesIvasList = [
  ...configuracion,
  {
    title: 'Condiciones Ivas',
    link: '/condiciones-ivas'
  }
]

const condicionesIvasCreate = [
  ...condicionesIvasList,
  {
    title: 'Nueva Condicion Iva',
    link: '/condiciones-ivas/create'
  }
]

const condicionesIvasShow = [
  ...condicionesIvasList,
  {
    title: 'Ver Condicion Iva',
    link: '/condiciones-ivas/show'
  }
]

const condicionesIvasUpdate = [
  ...condicionesIvasList,
  {
    title: 'Modificar Condicion Iva',
    link: '/condiciones-ivas/edit'
  }
]

export default {
  condicionesIvasList,
  condicionesIvasCreate,
  condicionesIvasShow,
  condicionesIvasUpdate
}
