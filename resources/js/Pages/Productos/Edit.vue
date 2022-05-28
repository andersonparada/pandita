<template>
  <AppLayout title="Productos">
    <div class="container">
      <div class="form-floating mb-3">
        <input
          type="text"
          v-model="producto.nombre"
          :class="errorClass('nombre')"
        />
        <label class="form-label">Nombre</label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="text"
          v-model="producto.descripcion"
          :class="errorClass('descripcion')"
        />
        <label class="form-label">Descripcion</label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="number"
          v-model="producto.precio"
          :class="errorClass('precio')"
        />
        <label class="form-label">Precio</label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="number"
          v-model="producto.stock"
          :class="errorClass('stock')"
        />
        <label class="form-label">Stock</label>
      </div>
      <div class="form-floating mb-3">
        <picture>
          <img :src="form.imagen" />
        </picture>
      </div>
      <div class="form-check form-check-inline mt-3">
        <input
          class="form-check-input"
          type="checkbox"
          v-model="producto.activo"
        />
        <label class="form-check-label" for="inlineCheckChecked">{{
          textActive
        }}</label>
      </div>
      <div class="d-flex flex-wrap align-items-start mb-3">
        <div class="me-3 bd-highlight d-inline-block">
          <inertia-link
            :href="route('productos.index')"
            class="btn btn-secondary"
            type="button"
          >
            CANCELAR
          </inertia-link>
        </div>
        <div class="me-3 bd-highlight d-inline-block">
          <button @click="submit" class="btn btn-primary">GUARDAR</button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import { errorsMixin } from "@/mixins/errors.js";
import AppLayout from "@/Layouts/AppLayout.vue";
export default {
  mixins: [errorsMixin],
  components: { AppLayout },
  props: {
    errors: null,
    producto: Object,
  },
  data() {
    return {
      form: this.$props.producto,
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("productos.update", this.$props.producto.id),
        this.form
      );
    },
  },
  computed: {
    textActive: function () {
      return this.producto.activo ? "ACTIVO" : "INACTIVO";
    },
  },
};
</script>

<style>
</style>