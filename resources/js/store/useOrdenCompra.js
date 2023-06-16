import { defineStore } from "pinia";

export const useOrdenCompraStore = defineStore("ordenCompra", {
  state: () => ({
    descripcion: null,
    proveedor_id: null,
    proveedor: null,
    condiciones_pagos_id: null,
    condicion_pago: null,
    fecha: null,
    estado: null,
    detalles: [],
  }),

  actions: {
    addDetalle(item) {
      this.detalles.push(item)
    },
  },
});