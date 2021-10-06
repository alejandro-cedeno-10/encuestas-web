<template>
  <div class="contact-us container">
    <div style="grid-column: 6/12;">
      <div class="row text-center titulo-encuesta center-div-items">
        <h2 class="font-titulo">ENCUESTA</h2> <h6 class="font-titulo">Conocerte mejor nos ayuda a crecer</h6>
      </div>
    </div>

    <div class="row col-sm-12 ml-0 mr-0">
      <div class="col center-div-items" style="width: 100%; height: 100%; align-items: center">
        <checked_test></checked_test>
      </div>
      <div class="col center-div-items">
        <formulario></formulario>
      </div>
    </div>
  </div>
</template>
<script>
import checked_test from "../animations/Checked_test";
import formulario from "../components/Form";
export default {
  components: {checked_test, formulario}
}
</script>