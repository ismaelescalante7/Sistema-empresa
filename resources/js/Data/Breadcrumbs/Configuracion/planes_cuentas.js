import configuracion from "./configuracion"

// Personas Humanas
const planesCuentasList = [
  ...configuracion,
  {
    title: 'Planes Cuentas',
    link: '/planes-cuentas'
  }
]

const planesCuentasCreate = [
  ...planesCuentasList,
  {
    title: 'Nuevo Plan Cuenta',
    link: '/planes-cuentas/create'
  }
]

const planesCuentasShow = [
  ...planesCuentasList,
  {
    title: 'Ver Plan Cuenta',
    link: '/planes-cuentas/show'
  }
]

const planesCuentasUpdate = [
  ...planesCuentasList,
  {
    title: 'Modificar Plan Cuenta',
    link: '/planes-cuentas/edit'
  }
]

export default {
  planesCuentasList,
  planesCuentasCreate,
  planesCuentasShow,
  planesCuentasUpdate
}
