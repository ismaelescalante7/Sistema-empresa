import { defineStore } from "pinia";
import { Inertia } from "@inertiajs/inertia";

const defaultState = {
  producto_id: null,
  precio_compra: null,
  precio_impuesto:null,
  cantidad: null,
  producto: null,
  subtotal: null,
  subtotal_impuestos: null,
};

export const useOrdenCompraDetalleStore = defineStore("ordenCompraDetalle", {
  state: () => ({ ...defaultState }),

  getters: {
    getDetalle(state) {
        return {
            'producto_id' : state.producto_id,
            'precio_compra' : state.precio_compra,
            'cantidad': state.cantidad,
            'cantidad_pendiente': state.cantidad,
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
    reset(keys) {
      Object.assign(this, keys?.length
        ? pick(defaultState, keys)
        : defaultState // if no keys provided, reset all
      );
    },
    cacularSubtotal() {
      this.subtotal = this.precio_compra * this.cantidad
      this.subtotal = parseFloat(this.subtotal.toFixed(2))
    },
    cacularSubtotalConImpuestos() {
      this.precio_impuesto = this.precio_compra + (this.precio_compra * this.producto.alicuota/100)
      this.precio_impuesto = parseFloat(this.precio_impuesto.toFixed(2))
      this.subtotal_impuestos = this.precio_impuesto * this.cantidad
      this.subtotal_impuestos = parseFloat(this.subtotal_impuestos.toFixed(2))
    }
  },
});