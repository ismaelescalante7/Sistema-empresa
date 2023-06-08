import depositos from './depositos'
import marcas from './marcas'
import rubros from './rubros'
import ordenCompras from './ordenCompras'

export default {
  ...marcas,
  ...depositos,
  ...rubros,
  ...ordenCompras,
}
