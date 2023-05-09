import administracion from './administracion'

const tiposDocumentacionList = [
  ...administracion,
  {
    title: 'Tipos de Documentos',
    link: '/tipos-documentos'
  }
]

const tiposDocumentacionCreate = [
  ...tiposDocumentacionList,
  {
    title: 'Nuevo Tipo de Documento',
    link: '/tipos-documentos/create'
  }
]

const tiposDocumentacionPlantilla = [
  ...tiposDocumentacionList,
  {
    title: 'Generador de Plantilla',
    link: null
  }
]

export default {
  tiposDocumentacionList,
  tiposDocumentacionCreate,
  tiposDocumentacionPlantilla
}
