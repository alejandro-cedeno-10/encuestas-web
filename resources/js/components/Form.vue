<template>
  <form  @submit.prevent="checkForm()"  method="post">
    <div v-if="errors.length">
      <b class="font-titulo text-danger">Por favor, corrija el(los) siguiente(s) error(es):</b>
    <ul>
      <li v-for="(error, index) in errors " :key="index" > <h6 class="font-titulo text-danger">{{ error }} </h6> </li>
    </ul>
    </div>

    <div v-if="errorsServidor" class="div-display-form mb-10">
      <b class="font-titulo text-danger">{{ errorsServidor }}</b>
    </div>

    <div class="div-display-form">
      <label for="name" class="label-font">Nombre <span class="text-danger">*</span></label>
      <input  id="name"
              v-model="nombre"
              name="nombre"
              placeholder="Escriba su nombre"
              type="text"
              class="input-class"
      />
    </div>

    <div class="div-display-form" >
      <label class="label-font">Genero <span class="text-danger">*</span></label>

      <div class="row group-father-radio">

        <div class="col div-radio-align">
          <label for="masculino" class="container-radio font-titulo label-children">Masculino
            <input type="radio" id="masculino" value="masculino" v-model="genero">
            <span class="checkmark"></span>
          </label>
        </div>

        <div class="col div-radio-align">
          <label for="femenimo" class="container-radio font-titulo label-children">Femenimo
            <input  type="radio" id="femenimo" value="femenino" v-model="genero">
            <span class="checkmark"></span>
          </label>
        </div>

      </div>

    </div>

    <div class="row group-father-radio">
      <div class="col-5 row-cols-sm-auto row-cols-md-auto div-display-form">
        <label for="hobby" class="label-font">¿Tienes algún hobby?<span class="text-danger">*</span></label>
        <select id="hobby" class="input-class-col"  v-model="hobby" style="margin-top: 20px;">
          <option v-for="(hobbysSelect, index) in hobbys" :value="hobbysSelect" :key="index">{{ hobbysSelect }}</option>
        </select>
      </div>

      <div v-if="checkHobby(hobby)" class="col row-cols-sm-auto row-cols-md-auto div-display-form">
        <label for="dia" class="label-font">¿Cuánto tiempo le dedicas al mes?<span class="text-danger">*</span></label>
        <input  id="dia"
                v-model="dedicacion"
                name="dedicacion"
                placeholder="Indique el numero de horas"
                type="number"
                class="input-class-col"
        />
      </div>
    </div>


    <button type="submit" style="margin-bottom: 25px">Siguiente</button>

  </form>
</template>
<script>
    export default {
      data() {
          return {
            showModal: false,
            errors: [],
            errorsServidor: null,
            hobbys: [
              "Ninguno",
              "Deporte",
              "Musical",
              "Cocina",
              "Literario",
              "Manualidades",
              "Juegos",
              "Modelismo",
              "Baile",
              "Cine",
              "Otro"
            ],
            nombre: null,
            hobby: null,
            genero: null,
            dedicacion: null,
          }
        },
        methods:{
          submit: function (){
            this.$axios.post(`/api/encuesta`, null, { params: {
                nombre: this.nombre,
                hobby: this.hobby,
                genero: this.genero,
                dedicacion: this.dedicacion
              }}).then(response => {
                this.$router.push({path: '/loading'})
                this.nombre= null;
                this.hobby= null;
                this.genero = null
                this.dedicacion = null;
            }).catch(error => {
              if (error.response.status === 405 || error.response.status === 500 ) {
                this.errorsServidor= 'Ups!, nos encontramos con un error, por favor comunicate con el admin.';
              }
            });
          },
          checkForm: function (e) {
            let bandera = 0;

            this.errorsServidor = null;

            this.errors = [];

            if (!this.nombre) {
              bandera = 1 ;
              this.errors.push('Escriba su nombre es obligatorio.');
            }

            if (!this.genero) {
              bandera = 1 ;
              this.errors.push('Eliga su genero es obligatorio.');
            }

            if (!this.hobby) {
              bandera = 1 ;
              this.errors.push('Eliga su hobby es obligatorio.');
            }

            if (this.hobby && !this.dedicacion && this.hobby !== 'Ninguno') {
              bandera = 1 ;
              this.errors.push('Usted eligio un hobby, debe indicar el tiempo que le dedica al mes.');
            }

            if (this.hobby  && this.hobby !== 'Ninguno' && this.hobby !== null
                && this.dedicacion !== null
                && this.dedicacion <= 0) {
              bandera = 1 ;
              this.errors.push('Indique un tiempo mayor a 0.');
            }

            if(!bandera) this.submit();

          },
          checkHobby: function (hobby){
            return !(hobby === "Ninguno" || hobby === null);
          }
        }
    }
</script>

<style>
  @import "../../styles/radio_custom.css";
</style>