import { defineStore } from "pinia";

const defaultState = {
  descripcion: null,
  proveedor_id: null,
  proveedor: null,
  condiciones_pagos_id: null,
  condicion_pago: null,
  fecha: null,
  estado: null,
  total: null,
  neto: null,
  iva: null,
  detalles: [],
};

export const useOrdenCompraStore = defineStore("ordenCompra", {
  state: () => ({ ...defaultState }),

  getters: {
    getNeto() {
      return this.neto
    },
    getTotal() {
      return this.total
    },
    getIva() {
      return this.iva
    },
    tieneDetalles() {
      return this.detalles.length > 0
    },
    getData() {
      return ({
        'descripcion': this.descripcion,
        'proveedor_id': this.proveedor_id,
        'condiciones_pagos_id': this.condiciones_pagos_id,
        'total': this.total,
        'neto': this.neto,
        'iva': this.iva,
        'detalles': this.detalles
      })
    }
  },

  actions: {
    reset(keys) {
      Object.assign(this, keys?.length
        ? pick(defaultState, keys)
        : defaultState // if no keys provided, reset all
      );
    },
    fill(ordenCompra) {
      this.proveedor_id = ordenCompra.proveedor_id
      this.proveedor = ordenCompra.proveedor
      this.descripcion = ordenCompra.descripcion
      this.condiciones_pagos_id = ordenCompra.condiciones_pagos_id
      this.condicion_pago = ordenCompra.condiciones_pago
      this.neto = ordenCompra.neto
      this.iva = ordenCompra.iva
      this.total = ordenCompra.total
      this.fecha = ordenCompra.created_at
      this.fecha = ordenCompra.created_at
      ordenCompra.detalle_orden_compra.map((detalle) => {
        this.detalles.push(detalle)
      })
      this.makeCalculos()
    },
    makeCalculos() {
      this.setNeto()
      this.setIva()
      this.setTotal()
    },
    addDetalle(item) {
      this.detalles.push(item)
      this.makeCalculos()
    },
    deleteDetalle(idProducto) {
      this.detalles = this.detalles.filter(detalle => detalle.producto_id !== idProducto)
      this.makeCalculos()
    },
    existeDetalle(idProducto) {
      return this.detalles.findIndex(detalle => detalle.producto_id === idProducto) !== -1
    },
    setNeto() {
      this.neto = this.detalles.reduce((total, item) => total + parseFloat(item.subtotal), 0)
      this.neto = parseFloat(this.neto.toFixed(2))
    },
    setTotal() {
      this.total = this.detalles.reduce((total, item) => total + parseFloat(item.subtotal_impuestos), 0)
      this.total = parseFloat(this.total.toFixed(2))
    },
    setIva() {
      this.iva = this.total - this.neto
      this.iva = parseFloat(this.iva.toFixed(2))
    },
  },
});