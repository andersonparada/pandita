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
          <div class="form-floating mb-3">
            <input type="number" v-model="nit" :class="errorClass('nit')" />
            <label class="form-label">NIT</label>
            <span class="text-danger" v-if="errors.nit">{{
              errors.nit[0]
            }}</span>
          </div>
          <div class="form-floating mb-3">
            <input
              type="text"
              v-model="direccion"
              :class="errorClass('direccion')"
            />
            <label class="form-label">Direccion</label>
            <span class="text-danger" v-if="errors.direccion">{{
              errors.direccion[0]
            }}</span>
          </div>
          <div class="d-grid gap-2">
            <button class="btn btn-primary" @click="generarVenta">
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
import Swal from "sweetalert2";
import { errorsMixin } from "@/mixins/errors.js";
export default {
  components: {
    AppLayout,
  },
  mixins: [errorsMixin],
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
      direccion: null,
      nit: null,
      errors: {},
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
    mensajeToast: function (title, icon = "error") {
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", Swal.stopTimer);
          toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
      });

      Toast.fire({
        icon,
        title,
      });
    },
    generarVenta: function () {
      axios
        .post("/facturas", {
          articulos: this.articulos,
          direccion: this.direccion,
          nit: this.nit,
        })
        .then((res) => {
          this.mensajeToast(
            "Su compra ha sido procesada, gracias por utilizar nuestro servicio en linea!!",
            "success"
          );
          localStorage.removeItem("articulos");
        })
        .catch((err) => {
          if (err.response.status == 422) {
            this.errors = err.response.data.errors;
          } else {
            this.mensajeToast(err.response.data);
          }
        });
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

