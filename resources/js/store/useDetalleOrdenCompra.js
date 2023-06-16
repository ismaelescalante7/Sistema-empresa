import { defineStore } from "pinia";

export const useOrdenCompraDetalleStore = defineStore("ordenCompraDetalle", {
  state: () => ({
    producto_id: null,
    precio_compra: null,
    precio_impuesto:null,
    cantidad: null,
    producto: null,
    subtotal: null,
    subtotal_impuestos: null,
  }),

  getters: {
    getDetalle(state) {
        return {
            'producto_id' : state.producto_id,
            'precio_compra' : state.precio_compra,
            'cantidad': state.cantidad,
            'producto': state.producto,
            'subtotal': state.subtotal,
            'subtotal_impuestos': state.subtotal_impuestos,
        }
    },
    getCantidad(state) {
      return state.cantidad
    },
    getSubtotal(state) {
        return state.subtotal
    },
    getSubtotalConImpuestos(state) {
      return this.subtotal_impuestos
  },

  },

  actions: {
    cacularSubtotal() {
      this.subtotal = this.precio_compra * this.cantidad
    },
    cacularSubtotalConImpuestos() {
      this.precio_impuesto = this.precio_compra + (this.precio_compra * this.producto.alicuota/100)
      this.subtotal_impuestos = Math.round(this.precio_impuesto * this.cantidad)
    }
  },
});