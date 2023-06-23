import depositos from './depositos'
import marcas from './marcas'
import rubros from './rubros'
import remitos from './remitos'

export default {
  ...marcas,
  ...depositos,
  ...rubros,
  ...remitos,
}
