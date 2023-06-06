import users from './users'
import productos from './productos'
import clientes from './clientes'
import proveedores from './proveedores'

export default {
  ...users,
  ...productos,
  ...clientes,
  ...proveedores,
}
