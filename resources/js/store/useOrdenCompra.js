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
    total: null,
    neto: null,
    iva: null,
    detalles: [],
  }),

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
    }
  },

  actions: {
    addDetalle(item) {
      this.detalles.push(item)
      this.setTotal()
      this.setNeto()
      this.setIva()
    },
    setNeto() {
      this.neto = this.detalles.reduce((total, item) => total + item.subtotal, 0)
      return this.neto
    },
    setTotal() {
      this.total = this.detalles.reduce((total, item) => total + item.subtotal_impuestos, 0)
      return this.total
    },
    setIva() {
      this.iva = this.total - this.neto
    }
  },
});