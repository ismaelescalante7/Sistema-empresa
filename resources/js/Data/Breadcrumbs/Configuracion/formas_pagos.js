import configuracion from "./configuracion"

// Personas Humanas
const formasPagosList = [
  ...configuracion,
  {
    title: 'Formas Pagos',
    link: '/formas-pagos'
  }
]

const formasPagosCreate = [
  ...formasPagosList,
  {
    title: 'Nuevo Forma Pago',
    link: '/formas-pagos/create'
  }
]

const formasPagosShow = [
  ...formasPagosList,
  {
    title: 'Ver Forma Pago',
    link: '/formas-pagos/show'
  }
]

const formasPagosUpdate = [
  ...formasPagosList,
  {
    title: 'Modificar Forma Pago',
    link: '/formas-pagos/edit'
  }
]

export default {
  formasPagosList,
  formasPagosCreate,
  formasPagosShow,
  formasPagosUpdate
}
