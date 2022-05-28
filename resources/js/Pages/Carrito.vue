<template>
  <AppLayout title="Carrito">
    <div class="container">
      <div class="card">
        <div v-if="this.articulos.length > 0">
          <table class="table table-hover table-responsive">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Total</th>
                <th scope="col">Opcion</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(articulo, i) in articulos" :key="i">
                <th scope="row">{{ i + 1 }}</th>
                <td>{{ articulo.producto.nombre }}</td>
                <td>{{ articulo.producto.descripcion }}</td>
                <td>{{ articulo.producto.precio }}</td>
                <td>
                  <input
                    type="number"
                    class="form-control form-control-sm"
                    v-model="articulo.cantidad"
                  />
                </td>
                <td>{{ articulo.producto.precio * articulo.cantidad }}</td>
                <td>
                  <button class="btn btn-outline-danger">Eliminar</button>
                </td>
              </tr>
              <tr class="table-info">
                <td>Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ total }}</td>
                <td></td>
              </tr>
            </tbody>
          </table>

          <div class="d-grid gap-2">
            <button class="btn btn-primary" @click="finalizar">
              FINALIZAR
            </button>
          </div>
        </div>
        <div v-else>
          <h5>Carrito vacio.</h5>
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
  mounted() {
    if (localStorage.getItem("articulos")) {
      try {
        this.articulos = JSON.parse(localStorage.getItem("articulos"));
      } catch (e) {
        localStorage.removeItem("articulos");
      }
    }
  },
  data() {
    return {
      articulos: [],
    };
  },
  methods: {
    saveArticulos: function () {
      // parseamos a json los articulos
      const parsed = JSON.stringify(this.articulos);
      //se guarda el parsed en el localstorage
      localStorage.setItem("articulos", parsed);
    },
    removeArticulo(key) {
      //eliminamos el articulo por la key
      this.articulos.splice(key, 1);
      //lo guardamos en el localstorage
      this.saveArticulos();
    },
  },
  computed: {
    total: function () {
      // iniciamos el total en 0
      let total = 0;

      //recorremos todos los articulos y sumamos el precio del
      //articulo * cantidad al total
      this.articulos.forEach((arr) => {
        total += arr.producto.precio * arr.cantidad;
      });

      return total;
    },
  },
};
</script>

