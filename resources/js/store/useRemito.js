import { defineStore } from "pinia";

export const useOrdenCompraStore = defineStore("remito", {
    state: () => ({
        descripcion: null,
        proveedor_id: null,
        localidad_id: null,
        fecha_ingreso: null,
    }),

    getters: {},

    actions: {},
});
