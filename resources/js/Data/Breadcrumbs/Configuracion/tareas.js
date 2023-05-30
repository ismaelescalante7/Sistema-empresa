import comunicacion from './tipos_comprobantes'

// Tareas
const tareas = [
  ...comunicacion,
  {
    title: 'Tareas',
    link: null
  }
]

const misTareasList = [
  ...tareas,
  {
    title: 'Mis tareas',
    link: route('tareas.mis-tareas')
  }
]

const inicioProduccionDocumento = [
  ...misTareasList,
  {
    title: 'Inicio Producción de Documento',
    link: route('tareas.iniciar')
  }
]

const produccionDocumento = [
  ...misTareasList,
  {
    title: 'Producción de Documento',
    link: route('tareas.producir')
  }
]

const distribucionesList = [
  ...misTareasList,
  {
    title: 'Lista de distribución',
    link: route('distribuciones.index')
  }
]

const distribucionesCreate = [
  ...distribucionesList,
  {
    title: 'Nueva',
    link: route('distribuciones.create')
  }
]

const distribucionesShow = [
  ...distribucionesList,
  {
    title: 'Listado de usuarios',
    link: '/distribuciones/show'
  }
]

const distribucionesUpdate = [
  ...distribucionesList,
  {
    title: 'Modificar Lista de Distribución',
    link: '/distribuciones/edit'
  }
]

export default {
  distribucionesList,
  distribucionesCreate,
  distribucionesShow,
  distribucionesUpdate,
  misTareasList,
  produccionDocumento,
  inicioProduccionDocumento
}
