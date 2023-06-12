import condiciones_ivas from './condiciones_ivas'
import planes_cuentas from './planes_cuentas'
import retenciones_ganancias from './retenciones_ganancias'
import tipos_comprobantes from './tipos_comprobantes'
import formas_pagos from './formas_pagos'
import retencion_ingresos_bruto from './retencion_ingresos_bruto'
import condiciones_pagos from './condiciones_pagos'
import medidas from './medidas'

export default {
  ...tipos_comprobantes,
  ...retenciones_ganancias,
  ...condiciones_ivas,
  ...planes_cuentas,
  ...formas_pagos,
  ...retencion_ingresos_bruto,
  ...condiciones_pagos,
  ...medidas
}
