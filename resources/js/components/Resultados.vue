<template>
  <div class="container-father container">
    <div style="grid-column: 6/12">
      <div class="row text-center titulo-encuesta center-div-items">
        <h2 class="font-titulo">Reporte</h2>
      </div>
    </div>

    <div v-if="errorsServidor" class="div-display-form mb-10">
      <b class="font-titulo text-danger">{{ errorsServidor }}</b>
    </div>

    <div class="row col-sm-12 col-md-12 ml-0 mr-0">
      <div class="col-12 col-sm-4 col-md-6 col-lg-3 space-beetween-grafics">
        <h6 class="font-titulo text-center">Nombres</h6>
        <bar-chart :chart-data="dataCollectionQuestion1"></bar-chart>
      </div>
      <div class="col-12 col-sm-4 col-md-6 col-lg-3 space-beetween-grafics">
        <h6 class="font-titulo text-center">Genero</h6>
        <pie-chart :chart-data="dataCollectionQuestion2"></pie-chart>
      </div>
      <div class="col-12 col-sm-4 col-md-6 col-lg-3 space-beetween-grafics">
        <h6 class="font-titulo text-center">Hobbys</h6>
        <polar-chart :chart-data="dataCollectionQuestion3"></polar-chart>
      </div>
      <div class="col-12 col-sm-6 col-md-6 col-lg-3 space-beetween-grafics">
        <h6 class="font-titulo text-center">
          Tiempo de dedicación en horas/mes
        </h6>
        <bar-chart :chart-data="dataCollectionQuestion4"></bar-chart>
      </div>
    </div>

    <div class="row col-sm-12 col-md-12 ml-0 mr-0">
      <div class="col-12 col-md-12 col-lg-6 space-beetween-grafics">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Genero</th>
              <th scope="col">Hobby</th>
              <th scope="col">Tiempo dedicación</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(encuesta, index) in encuestas" :key="index">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ encuesta.nombre }}</td>
              <td>{{ encuesta.genero }}</td>
              <td>{{ encuesta.hobby }}</td>
              <td v-if="encuesta.dedicacion != null">
                {{ encuesta.dedicacion }} hora(s)/mes
              </td>
              <td v-else>Nada</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-12 col-md-12 col-lg-6 space-beetween-grafics"   style="margin-top: 50px">
        <div class="row">
          <button
            @click="downloadExcelResultados()"
            style="margin-bottom: 25px"
          >
            Descargar Excel
          </button>

          <button @click="redirecionarEncuesta()" style="margin-bottom: 25px">
            Contestar encuesta
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import BarChart from "./chartsJs/Bar";
import PieChart from "./chartsJs/Pie";
import PolarChart from "./chartsJs/Polar";

export default {
  components: {
    BarChart,
    PieChart,
    PolarChart,
  },
  data() {
    return {
      errorsServidor: "",
      labelsQ1: [],
      dataQ1: [],
      labelsQ2: [],
      dataQ2: [],
      labelsQ3: [],
      dataQ3: [],
      labelsQ4: [],
      dataQ4: [],
      dataCollectionQuestion1: {},
      dataCollectionQuestion2: {},
      dataCollectionQuestion3: {},
      dataCollectionQuestion4: {},
      encuestas: [],
      femeninoNumber: 0,
      masculinoNumber: 0,
    };
  },
  mounted() {
    this.fillDataBarQ1();
    this.fillDataPieQ2();
    this.fillDataPolarQ3();
    this.fillDataBarRandomColorQ4();
    this.fillTableUser();
  },
  methods: {
    fillDataBarQ1() {
      this.$axios
        .get("/api/encuesta-q1-name")
        .then((response) => {
          response.data.filter((encuesta) => {
            this.labelsQ1.push(encuesta.nombre);
            this.dataQ1.push(encuesta.numero);
          });

          this.dataCollectionQuestion1 = {
            labels: this.labelsQ1,
            datasets: [
              {
                label: "N° veces que respondieron",
                backgroundColor: "black",
                data: this.dataQ1,
              },
            ],
          };
        })
        .catch((error) => {
          if (error) {
            this.errorsServidor =
              "Ups!, nos encontramos con un error, por favor comunicate con el admin.";
          }
        });
    },

    fillDataPieQ2() {
      this.$axios
        .get("/api/encuesta-q2-genero")
        .then((response) => {
          response.data.filter((encuesta) => {
            this.labelsQ2.push(encuesta.genero);
            this.dataQ2.push(encuesta.numero);
          });

          this.dataCollectionQuestion2 = {
            labels: this.labelsQ2,
            datasets: [
              {
                label: "Estadistica de Genero",
                data: this.dataQ2,
                backgroundColor: ["rgb(255, 99, 132)", "rgb(255, 205, 86)"],
              },
            ],
          };
        })
        .catch((error) => {
          if (error) {
            this.errorsServidor =
              "Ups!, nos encontramos con un error, por favor comunicate con el admin.";
          }
        });
    },

    fillDataPolarQ3() {
      this.$axios
        .get("/api/encuesta-q3-hobby")
        .then((response) => {
          response.data.filter((encuesta) => {
            this.labelsQ3.push(encuesta.hobby);
            this.dataQ3.push(encuesta.numero);
          });

          this.dataCollectionQuestion3 = {
            labels: this.labelsQ3,
            datasets: [
              {
                data: this.dataQ3,
                backgroundColor: [
                  "rgb(255, 99, 132)",
                  "rgb(75, 192, 192)",
                  "rgb(255, 205, 86)",
                  "rgb(201, 203, 207)",
                  "rgb(54, 162, 235)",
                  "rgb(255, 99, 80)",
                  "rgb(75, 192, 200)",
                  "rgb(255, 205, 250)",
                  "rgb(201, 180, 207)",
                  "rgb(54, 162, 40)",
                ],
              },
            ],
          };
        })
        .catch((error) => {
          if (error) {
            this.errorsServidor =
              "Ups!, nos encontramos con un error, por favor comunicate con el admin.";
          }
        });
    },

    fillDataBarRandomColorQ4() {
      this.$axios
        .get("/api/encuesta-q4-dedicacion")
        .then((response) => {
          response.data.filter((encuesta) => {
            if (encuesta.dedicacion != null) {
              this.labelsQ4.push(encuesta.dedicacion);
              this.dataQ4.push(encuesta.numero);
            }
          });

          this.dataCollectionQuestion4 = {
            labels: this.labelsQ4,
            datasets: [
              {
                label: "N° veces que se repite",
                data: this.dataQ4,
                backgroundColor: [
                  "rgba(255, 99, 132, 0.2)",
                  "rgba(255, 159, 64, 0.2)",
                  "rgba(255, 205, 86, 0.2)",
                  "rgba(75, 192, 192, 0.2)",
                  "rgba(54, 162, 235, 0.2)",
                  "rgba(153, 102, 255, 0.2)",
                  "rgba(201, 203, 207, 0.2)",
                ],
                borderColor: [
                  "rgb(255, 99, 132)",
                  "rgb(255, 159, 64)",
                  "rgb(255, 205, 86)",
                  "rgb(75, 192, 192)",
                  "rgb(54, 162, 235)",
                  "rgb(153, 102, 255)",
                  "rgb(201, 203, 207)",
                ],
                borderWidth: 1,
              },
            ],
          };
        })
        .catch((error) => {
          if (error) {
            this.errorsServidor =
              "Ups!, nos encontramos con un error, por favor comunicate con el admin.";
          }
        });
    },

    fillTableUser() {
      this.$axios
        .get("/api/encuesta")
        .then((response) => {
          this.encuestas = response.data;
        })
        .catch((error) => {
          if (error) {
            this.errorsServidor =
              "Ups!, nos encontramos con un error, por favor comunicate con el admin.";
          }
        });
    },

    downloadExcelResultados() {
      var url = "/api/encuesta-download-excel";
      window.location = url;
    },
    redirecionarEncuesta() {
      this.$router.push({ path: "/" });
    },
  },
};
</script>
<style>
.container-father {
  margin-top: 50px;
  background: #f8f4e5;
  border-radius: 5%;
}

.space-beetween-grafics {
  height: 100%;
  width: 100%;
  margin-bottom: 30px;
}
</style>