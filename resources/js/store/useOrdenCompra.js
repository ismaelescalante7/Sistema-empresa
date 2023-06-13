import { defineStore } from "pinia";

export const useOrdenCompraStore = defineStore("ordenCompra", {
  state: () => ({
    descripcion: null,
    proveedor_id: null,
    condiciones_pagos_id: null,
    estado: null,
    detalles: [],
  }),

  getters: {},

  actions: {},
});