<template>
  <div class="card">
    <img class="card-img-top" :src="producto.imagen" />
    <div class="card-body">
      <h5 class="card-title">{{ producto.nombre.toUpperCase() }}</h5>
      <p class="card-text">
        {{ producto.descripcion.toUpperCase() }}
      </p>
    </div>
    <div class="card-footer">
      <ul class="list-inline d-flex justify-content-center">
        <li class="list-inline-item">
          <button class="btn btn-outline-primary btn-circle" @click="quitar">
            -
          </button>
        </li>
        <li class="list-inline-item">
          <h2>{{ cantidad }}</h2>
        </li>
        <li class="list-inline-item">
          <button class="btn btn-outline-primary btn-circle" @click="agregar">
            +
          </button>
        </li>
      </ul>
      <div class="d-grid gap-2">
        <button class="btn btn-primary" @click="emitirDatos">
          Agregar al carrito
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
  props: ["producto"],
  data() {
    return {
      cantidad: 0,
    };
  },
  methods: {
    agregar: function () {
      this.cantidad++;
    },
    quitar: function () {
      if (this.cantidad > 0) {
        this.cantidad--;
      }
    },
    emitirDatos: function () {
      if (this.cantidad == 0) {
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
          icon: "error",
          title: "No puede agregar al carrito la cantidad 0",
        });
        return;
      }

      const data = {
        producto: this.producto,
        cantidad: this.cantidad,
      };

      this.$emit("datos", data);
    },
  },
};
</script>

<style>
.btn-circle {
  border-radius: 60px;
  text-align: center;
}
</style>