<template>
  <AppLayout title="Productos">
    <div class="container">
      <form @submit.prevent="submit">
        <div class="form-floating mb-3">
          <input
            type="text"
            v-model="form.nombre"
            :class="errorClass('nombre')"
          />
          <label class="form-label">Nombre</label>
        </div>
        <div class="form-floating mb-3">
          <input
            type="text"
            v-model="form.descripcion"
            :class="errorClass('descripcion')"
          />
          <label class="form-label">Descripcion</label>
        </div>
        <div class="form-floating mb-3">
          <input
            type="number"
            v-model="form.precio"
            :class="errorClass('precio')"
          />
          <label class="form-label">Precio</label>
        </div>
        <div class="form-floating mb-3">
          <input
            type="number"
            v-model="form.stock"
            :class="errorClass('stock')"
          />
          <label class="form-label">Stock</label>
        </div>
        <div class="form-floating mb-3">
          <input type="file" @input="form.file = $event.target.files[0]" />
        </div>
        <div class="form-check form-check-inline mt-3">
          <input
            class="form-check-input"
            type="checkbox"
            v-model="form.activo"
          />
          <label class="form-check-label" for="inlineCheckChecked">{{
            textActive
          }}</label>
        </div>
        <progress
          v-if="form.progress"
          :value="form.progress.percentage"
          max="100"
        >
          {{ form.progress.percentage }}%
        </progress>

        <div class="d-flex flex-wrap align-items-start mb-3 mt-2">
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
            <button type="submit" class="btn btn-primary">GUARDAR</button>
          </div>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { errorsMixin } from "@/mixins/errors.js";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  setup() {
    const form = useForm({
      nombre: null,
      descripcion: null,
      precio: null,
      activo: true,
      stock: 0,
      imagen: null,
      file: null,
    });

    function submit() {
      form.post("/productos");
    }

    return { form, submit };
  },
  mixins: [errorsMixin],
  components: { AppLayout },
  props: { errors: null },
  computed: {
    textActive: function () {
      return this.form.activo ? "ACTIVO" : "INACTIVO";
    },
  },
};
</script>

<style>
</style>