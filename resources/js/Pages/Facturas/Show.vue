<template>
  <AppLayout>
    <div class="container">
      <div class="form-floating mb-3">
        <input
          type="text"
          :readonly="true"
          v-model="form.usuario.name"
          :class="errorClass('name')"
        />
        <label class="form-label">Cliente</label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="textarea"
          :readonly="true"
          v-model="form.direccion"
          :class="errorClass('nombre')"
        />
        <label class="form-label">Direccion</label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="text"
          :readonly="true"
          v-model="form.nit"
          :class="errorClass('nombre')"
        />
        <label class="form-label">Nit</label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="text"
          :readonly="true"
          v-model="form.estado.descripcion"
          :class="errorClass('estado')"
        />
        <label class="form-label">Estado</label>
      </div>
      <div class="d-grid gap-2">
        <button
          class="btn btn-primary"
          @click="descargarFactura"
          v-if="factura.estado_id == 3"
        >
          Imprimir factura
        </button>
      </div>
      <div v-if="factura.detalles.length > 0" id="factura" class="mt-3">
        <p><b>FACTURA</b></p>
        <p>PANDITA</p>
        <p>Mazatenango</p>
        <p>Plaza Americas</p>
        <p v-if="factura.nit">
          FACTURAR A: {{ factura.usuario.name.toUpperCase() }} -
          {{ factura.nit }}
        </p>
        <p v-else>FACTURAR A: C/F</p>
        <p>ENVIAR A: {{ factura.direccion.toUpperCase() }}</p>
        <p>Numero de factura: {{ this.factura.id }}</p>
        <p>Fecha: {{ new Date(factura.created_at).toLocaleDateString() }}</p>
        <p>Numero de factura: {{ this.factura.id }}</p>

        <table class="table table-hover">
          <thead>
            <tr>
              <th style="text-align: center">#</th>
              <th style="text-align: center">Producto</th>
              <th style="text-align: center">Cantidad</th>
              <th style="text-align: center">Precio</th>
              <th style="text-align: center">Sub total</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(detalle, i) in factura.detalles" :key="detalle.id">
              <td style="text-align: center" scope="row">{{ i + 1 }}</td>
              <td style="text-align: center">
                {{ detalle.producto.nombre }} -
                {{ detalle.producto.descripcion }}
              </td>
              <td style="text-align: center">{{ detalle.cantidad }}</td>
              <td style="text-align: center">{{ detalle.precio }}</td>
              <td style="text-align: center">
                {{ detalle.cantidad * detalle.precio }}
              </td>
            </tr>
            <tr>
              <td style="text-align: center">Total:</td>
              <td></td>
              <td></td>
              <td></td>
              <td style="text-align: center">{{ sumaGastado }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <h5 v-else>
        Ha ocurrido un error, este pedido no tiene ningun elemento...
      </h5>
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
  },
  data() {
    return {
      form: this.$props.factura,
    };
  },
  methods: {
    descargarFactura: function () {
      var ficha = document.getElementById("factura");
      var ventimp = window.open(" ", "popimpr");
      ventimp.document.write(
        `<link rel="stylesheet" href="{{ mix('css/app.css') }}">`
      );
      ventimp.document.write(ficha.innerHTML);
      ventimp.document.close();
      ventimp.print();
      ventimp.close();
    },
  },
  computed: {
    sumaGastado: function () {
      let gastado = 0;

      this.factura.detalles.forEach((detalle) => {
        gastado += detalle.cantidad * detalle.precio;
      });

      return gastado;
    },
  },
};
</script>

<style>
</style>