<template>
  <div class="contact-us container">
    <div style="grid-column: 6/12">
      <div class="row text-center titulo-encuesta center-div-items">
        <h2 class="font-titulo">Gracias por contestar la encuesta!</h2>
      </div>
    </div>

    <div class="container ml-0 mr-0 loading-div">
      <div class="col-12" style="width: 50%; height: 50%; align-items: center">
        <sent></sent>
      </div>
    </div>
  </div>
</template>
<script>
import sent from "../animations/Sent";
export default {
  components: { sent },
  mounted() {
    setTimeout(() => this.$router.push({ path: "/resultados" }), 2000);
  },
};
</script>

