<template>
    <AppLayout>
        <div class="container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Opcion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="factura in facturas" :key="factura.id">
                        <th scope="row">{{ factura.id }}</th>
                        <td>{{ factura.usuario.name }}</td>
                        <td>{{ factura.estado.descripcion }}</td>
                        <td>
                            <inertia-link v-if="$page.props.user.admin == 1" class="btn btn-outline-primary"
                                :href="route('pedidos.edit', factura.id)">
                                Editar</inertia-link>
                            <inertia-link v-else :href="route('pedidos.show', factura.id)">Ver</inertia-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>

<script>

import AppLayout from "@/Layouts/AppLayout.vue";
export default {
    props: {
        facturas: Array
    },
    components: {
        AppLayout
    }
}
</script>

<style>
</style>