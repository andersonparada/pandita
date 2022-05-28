<template>
  <div class="float-end">
    <inertia-link
      class="btn btn-outline-primary btn-circle"
      :href="route('carrito')"
    >
      Carrito
    </inertia-link>
  </div>
</template>

<script>
export default {};
</script>
<style>
.btn-circle {
  border-radius: 60px;
  text-align: center;
}
</style>