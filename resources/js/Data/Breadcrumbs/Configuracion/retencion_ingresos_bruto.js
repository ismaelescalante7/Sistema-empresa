import configuracion from "./configuracion"

// Personas Humanas
const retencionIngresosBrutoList = [
  ...configuracion,
  {
    title: 'Retencion Ingresos Bruto',
    link: '/retencion-ingresos-bruto'
  }
]

const retencionIngresosBrutoCreate = [
  ...retencionIngresosBrutoList,
  {
    title: 'Nuevo Retencion Ingresos Bruto',
    link: '/retencion-ingresos-bruto/create'
  }
]

const retencionIngresosBrutoShow = [
  ...retencionIngresosBrutoList,
  {
    title: 'Ver Retencion Ingreso Bruto',
    link: '/retencion-ingresos-bruto/show'
  }
]

const retencionIngresosBrutoUpdate = [
  ...retencionIngresosBrutoList,
  {
    title: 'Modificar Retencion Ingreso Bruto',
    link: '/retencion-ingresos-bruto/edit'
  }
]

export default {
  retencionIngresosBrutoList,
  retencionIngresosBrutoCreate,
  retencionIngresosBrutoShow,
  retencionIngresosBrutoUpdate
}
