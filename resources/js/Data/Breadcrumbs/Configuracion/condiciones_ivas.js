import configuracion from "./configuracion"

// Condiciones Ivas
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
    title: 'Nueva Condición Iva',
    link: '/condiciones-ivas/create'
  }
]

const condicionesIvasShow = [
  ...condicionesIvasList,
  {
    title: 'Ver Condición Iva',
    link: '/condiciones-ivas/show'
  }
]

const condicionesIvasUpdate = [
  ...condicionesIvasList,
  {
    title: 'Modificar Condición Iva',
    link: '/condiciones-ivas/edit'
  }
]

export default {
  condicionesIvasList,
  condicionesIvasCreate,
  condicionesIvasShow,
  condicionesIvasUpdate
}
