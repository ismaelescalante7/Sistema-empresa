import inventario from "./inventario"

// Marcas
const marcasList = [
  ...inventario,
  {
    title: 'Marcas',
    link: '/marcas'
  }
]

const marcasCreate = [
  ...marcasList,
  {
    title: 'Nueva Marca',
    link: '/marcas/create'
  }
]

const marcasShow = [
  ...marcasList,
  {
    title: 'Ver Marca',
    link: '/marcas/show'
  }
]

const marcasUpdate = [
  ...marcasList,
  {
    title: 'Modificar Marca',
    link: '/marca/edit'
  }
]

export default {
  marcasList,
  marcasCreate,
  marcasShow,
  marcasUpdate
}