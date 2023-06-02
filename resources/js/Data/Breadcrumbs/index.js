import administacion from './Administracion'
import configuracion from './Configuracion'
import inventario from './Inventario'

export default {
  ...administacion,
  ...configuracion,
  ...inventario
}
