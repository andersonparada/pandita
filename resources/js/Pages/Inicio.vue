<template>
  <app-layout title="Inicio">
    <template #header>
      <h2 class="h4 font-weight-bold">Inicio</h2>
    </template>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default defineComponent({
  components: {
    AppLayout,
  },
});
</script>
