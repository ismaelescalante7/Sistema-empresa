import configuracion from "./configuracion"

// Personas Humanas
const retencionesGananciasList = [
  ...configuracion,
  {
    title: 'Retenciones Ganancias',
    link: '/retenciones-ganancias'
  }
]

const retencionesGananciasCreate = [
  ...retencionesGananciasList,
  {
    title: 'Nueva Retencion Ganancia',
    link: '/retenciones-ganancias/create'
  }
]

const retencionesGananciasShow = [
  ...retencionesGananciasList,
  {
    title: 'Ver Retencion Ganancia',
    link: '/retenciones-ganancias/show'
  }
]

const retencionesGananciasUpdate = [
  ...retencionesGananciasList,
  {
    title: 'Modificar Retencion Ganancia',
    link: '/retenciones-ganancias/edit'
  }
]

export default {
  retencionesGananciasList,
  retencionesGananciasCreate,
  retencionesGananciasShow,
  retencionesGananciasUpdate
}
