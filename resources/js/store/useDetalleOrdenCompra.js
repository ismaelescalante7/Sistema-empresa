import { defineStore } from "pinia";

export const useOrdenCompraDetalleStore = defineStore("ordenCompraDetalle", {
  state: () => ({
    producto_id: null,
    precio_compra: null,
    cantidad: null,
    producto: null
  }),

  getters: {
    getDetalle(state) {
        return {
            'producto_id' : state.producto_id,
            'precio_compra' : state.precio_compra,
            'cantidad': state.cantidad,
            'producto': state.producto
        }
    },
    getCantidad(state) {
      return state.cantidad
    },
    getSubtotal(state) {
        return state.precio_compra * state.cantidad
    }
  },

  actions: {},
});