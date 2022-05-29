<template>
    <AppLayout>
        <div class="container">
            <div class="form-floating mb-3">
                <input type="text" :readonly="true" v-model="form.usuario.name" :class="errorClass('name')" />
                <label class="form-label">Cliente</label>
            </div>
            <div class="form-floating mb-3">
                <input type="textarea" :readonly="true" v-model="form.direccion" :class="errorClass('nombre')" />
                <label class="form-label">Direccion</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" :readonly="true" v-model="form.nit" :class="errorClass('nombre')" />
                <label class="form-label">Nit</label>
            </div>
            <div class="mb-3">
                <select class="form-select" v-model="form.estado_id">
                    <option v-for="estado in estados" :value="estado.id" :key="estado.id">{{ estado.descripcion }}
                    </option>
                </select>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" @click="cambiarEstado">
                    Guardar cambios
                </button>
            </div>
            <table class="table table-hover" v-if="factura.detalles.length > 0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(detalle, i) in factura.detalles" :key="detalle.id">
                        <th scope="row">{{ i }}</th>
                        <td>{{ detalle.producto.nombre }} - {{ detalle.producto.descripcion }}</td>
                        <td>{{ factura.cantidad }}</td>
                    </tr>
                </tbody>
            </table>
            <h5 v-else>Ha ocurrido un error, este pedido no tiene ningun elemento...</h5>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { errorsMixin } from "@/mixins/errors.js";
export default {
    mixins: [errorsMixin],
    components: { AppLayout },
    props: {
        factura: Object,
        errors: null,
        estados: Array
    },
    data() {
        return {
            form: this.$props.factura,
        };
    },
    methods: {
        cambiarEstado: function () {
            this.$inertia.put(
                route("pedidos.update", this.$props.factura.id),
                { estado_id: this.form.estado_id }
            );
        }
    }
}
</script>

<style>
</style>