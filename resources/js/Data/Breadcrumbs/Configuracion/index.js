import condiciones_ivas from './condiciones_ivas'
import planes_cuentas from './planes_cuentas'
import retenciones_ganancias from './retenciones_ganancias'
import tipos_comprobantes from './tipos_comprobantes'
import formas_pagos from './formas_pagos'

export default {
  ...tipos_comprobantes,
  ...retenciones_ganancias,
  ...condiciones_ivas,
  ...planes_cuentas,
  ...formas_pagos
}
