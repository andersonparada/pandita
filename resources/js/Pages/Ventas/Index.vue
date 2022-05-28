<template>
  <AppLayout title="Productos">
    <div class="container">
      <div class="row" v-if="productos.length > 0">
        <CardProducto
          v-for="producto in productos"
          :key="producto.id"
          :producto="producto"
          class="col-3"
          @datos="obtenerData"
        />
      </div>
      <h3 v-else>Actualmente no tenemos ningun producto a la venta</h3>
      <ButtonFloat />
      <br />
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CardProducto from "@/Components/CardProducto.vue";
import ButtonFloat from "@/Components/ButtonFloat.vue";
export default {
  components: {
    AppLayout,
    CardProducto,
    ButtonFloat,
  },
  props: {
    productos: Array,
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
    obtenerData: function (nuevoArticulo) {
      // buscamos si el articulo ya estaba almacenado previamente
      const index = this.articulos.findIndex(
        (articulo) => articulo.producto.id == nuevoArticulo.producto.id
      );

      if (index >= 0) {
        // si existe sumamos la nueva cantidad
        this.articulos[index].cantidad += nuevoArticulo.cantidad;
      } else {
        // si no existe lo agregamos
        this.articulos.push(nuevoArticulo);
      }

      this.saveArticulos();
    },
    saveArticulos: function () {
      // parseamos a json los articulos
      const parsed = JSON.stringify(this.articulos);
      //se guarda el parsed en el localstorage
      localStorage.setItem("articulos", parsed);
    },
  },
};
</script>

<style>
</style>