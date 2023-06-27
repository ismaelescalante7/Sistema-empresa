import administacion from './Administracion'
import compra from './Compras'
import configuracion from './Configuracion'
import inventario from './Inventario'

export default {
  ...administacion,
  ...configuracion,
  ...inventario,
  ...compra
}
