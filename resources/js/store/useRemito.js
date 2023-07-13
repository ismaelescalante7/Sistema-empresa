import { defineStore } from "pinia";

export const useRemitoStore = defineStore("remito", {
    state: () => ({
        numero: null,
        proveedor_id: null,
        localidad_id: null,
        fecha_ingreso: new Date().toISOString().split("T")[0],
        user_id: null,
        proveedor: null,
        localidad: null,
        ordenCompras: [],
        detalles: [],
    }),

    getters: {
        getHead() {
            return {
                numero: this.numero,
                proveedor_id: this.proveedor_id,
                localidad_id: this.localidad_id,
                fecha_ingreso: this.fecha_ingreso,
                user_id: this.user_id,
            };
        },
        getData() {
            return {
                numero: this.numero,
                proveedor_id: this.proveedor_id,
                localidad_id: this.localidad_id,
                fecha_ingreso: this.fecha_ingreso,
                user_id: this.user_id,
                ordenCompras: this.ordenCompras,
                detalles: this.detalles,
            };
        },
    },

    actions: {},
});
