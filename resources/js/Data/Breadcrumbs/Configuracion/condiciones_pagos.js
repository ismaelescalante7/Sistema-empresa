import configuracion from "./configuracion"

// Personas Humanas
const condicionesPagosList = [
  ...configuracion,
  {
    title: 'Condiciones Pagos',
    link: '/condiciones-pagos'
  }
]

const condicionesPagosCreate = [
  ...condicionesPagosList,
  {
    title: 'Nuevo Condiciones de pago',
    link: '/condiciones-pagos/create'
  }
]

const condicionesPagosShow = [
  ...condicionesPagosList,
  {
    title: 'Ver Condiciones de pago',
    link: '/condiciones-pagos/show'
  }
]

const condicionesPagosUpdate = [
  ...condicionesPagosList,
  {
    title: 'Modificar Condiciones de pago',
    link: '/condiciones-pagos/edit'
  }
]

export default {
  condicionesPagosList,
  condicionesPagosCreate,
  condicionesPagosShow,
  condicionesPagosUpdate
}
