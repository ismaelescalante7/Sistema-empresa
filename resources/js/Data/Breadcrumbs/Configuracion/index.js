import condiciones_ivas from './condiciones_ivas'
import retenciones_ganancias from './retenciones_ganancias'
import tipos_comprobantes from './tipos_comprobantes'

export default {
  ...tipos_comprobantes,
  ...retenciones_ganancias,
  ...condiciones_ivas
}
