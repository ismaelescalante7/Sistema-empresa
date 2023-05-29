import configuracion from "./configuracion"

// Personas Humanas
const tiposComprobantesList = [
  ...configuracion,
  {
    title: 'Tipos Comprobantes',
    link: '/tipos-comprobantes'
  }
]

const tiposComprobantesCreate = [
  ...tiposComprobantesList,
  {
    title: 'Nuevo Tipos Comprobantes',
    link: '/cliente/create'
  }
]

const tiposComprobantesShow = [
  ...tiposComprobantesList,
  {
    title: 'Ver Tipo Comprobante',
    link: '/cliente/show'
  }
]

const tiposComprobantesUpdate = [
  ...tiposComprobantesList,
  {
    title: 'Modificar Tipo Comprobante',
    link: '/cliente/edit'
  }
]

export default {
  tiposComprobantesList,
  tiposComprobantesCreate,
  tiposComprobantesShow,
  tiposComprobantesUpdate
}
