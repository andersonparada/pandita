<template>
  <AppLayout title="Productos">
    <div class="container">
      <div class="card">
        <div class="card-header">
          <inertia-link
            :href="route('productos.create')"
            class="btn btn-dark"
            type="button"
          >
            CREAR
          </inertia-link>
        </div>
        <div class="card-body">
          <table
            class="table table-hover table-responsive"
            v-if="productos.length > 0"
          >
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody v-for="producto in productos" :key="producto.id">
              <tr>
                <th scope="row">{{ producto.id }}</th>
                <td>{{ producto.nombre }}</td>
                <td>{{ producto.precio }}</td>
                <td>{{ producto.activo ? "ACTIVO" : "INACTIVO" }}</td>
                <td>
                  <inertia-link
                    :href="route('productos.edit', producto.id)"
                    class="btn btn-secondary"
                    type="button"
                  >
                    EDITAR
                  </inertia-link>
                </td>
              </tr>
            </tbody>
          </table>
          <h3 v-else>SIN PRODUCTOS</h3>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
  components: {
    AppLayout,
  },
  props: {
    productos: Array,
  },
};
</script>

<style>
</style>