import { defineStore } from "pinia";

export const useOrdenCompraDetalleStore = defineStore("ordenCompraDetalle", {
  state: () => ({
    producto_id: null,
    precio: null,
    cantidad: null
  }),

  getters: {},

  actions: {},
});