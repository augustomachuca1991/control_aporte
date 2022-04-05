<template>
  <div class="container">
    <!-- <p>{{ agente.nombre }} - {{ from }} - {{ to }}</p> -->
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium,
      repellendus recusandae dolore magnam corrupti, optio numquam eos aperiam
      libero accusamus tempore veritatis provident neque necessitatibus in,
      beatae non facilis aliquid.
    </p>
    <div class="row g-3  px-2 py-3">
      <div class="col-4 col-md-6 col-lg-auto">
        <label for="inputAgente" class="col-form-label">Agente</label>
      </div>
      <div class="col-8 col-md-6 col-lg-auto">
        <span v-if="isLoad" class="form-control"
          >{{ agente.nombre }} | {{ agente.cuil }}
          <a href="#" @click="clear" class="text-danger"
            ><i class="fas fa-times-circle"></i
          ></a>
        </span>

        <input
          v-else
          type="text"
          id="inputAgente"
          class="form-control"
          aria-describedby="agenteHelpInline"
          placeholder="Nombre, Cuil, Puesto, etc"
          autocomplete="off"
          v-model="search"
          @keyup="getQuery"
        />
        <span
          id="desdeInline"
          class="form-text text-danger text-xs"
          v-for="error in errors.agente"
          :key="error.id"
        >
          {{ error }}
        </span>
        <div class="card" v-if="search_data.length">
          <div class="card-body">
            <ul class="list-group">
              <a
                href="#"
                class="list-group-item"
                v-for="data in search_data"
                :key="data.id"
                @click="loadInput(data)"
              >
                {{ data.nombre }} | {{ data.cuil }} |
                {{ data.puestolaborales[0].cod_laboral }}
              </a>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-4 col-md-6 col-lg-auto">
        <label for="inputDesde" class="col-form-label">Desde</label>
      </div>
      <div class="col-8 col-md-6 col-lg-auto">
        <input
          type="date"
          id="inputDesde"
          class="form-control"
          aria-describedby="desdeInline"
          :max="max"
          v-model="from"
        />
        <span
          id="desdeInline"
          class="form-text text-danger text-xs"
          v-for="error in errors.desde"
          :key="error.id"
        >
          {{ error }}
        </span>
      </div>

      <div class="col-4 col-md-6 col-lg-auto">
        <label for="inputHasta" class="col-form-label">Hasta</label>
      </div>
      <div class="col-8 col-md-6 col-lg-auto">
        <input
          type="date"
          id="inputHasta"
          class="form-control"
          aria-describedby="hastaInline"
          :max="max"
          v-model="to"
        />
        <span
          id="desdeInline"
          class="form-text text-danger text-xs"
          v-for="error in errors.hasta"
          :key="error.id"
        >
          {{ error }}
        </span>
      </div>

      <div class="col-12 col-lg-auto py-1 py-lg-0">
        <button
          type="button"
          @click="getLiquidaciones"
          class="btn bg-olive btn-block"
        >
          Buscar
        </button>
      </div>
    </div>
    <!-- <div class="row">
      <div class="col">
        <span
          id="desdeInline"
          class="form-text text-danger text-xs"
          v-for="error in errors.agente"
          :key="error.id"
        >
          {{ error }}
        </span>
      </div>
      <div class="col">
        <span
          id="desdeInline"
          class="form-text text-danger text-xs"
          v-for="error in errors.desde"
          :key="error.id"
        >
          {{ error }}
        </span>
      </div>
      <div class="col">
        <span
          id="desdeInline"
          class="form-text text-danger text-xs"
          v-for="error in errors.hasta"
          :key="error.id"
        >
          {{ error }}
        </span>
      </div>
      <div class="col"></div>
    </div> -->
    <table class="table table-hover" v-if="liquidaciones.length">
      <!-- <caption class="text-right px-4 text-lg text-dark">
        Total en pesos: $ 700456.53
      </caption> -->
      <thead>
        <tr>
          <th scope="col"># Cod Liq</th>
          <th scope="col">Periodo | Tipo</th>
          <th scope="col">P. Laboral</th>
          <th scope="col">Agente | Cuil</th>
          <th scope="col">Jurisidiccion | Organismo</th>
          <th scope="col">Haber con aporte</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="liquidacion in liquidaciones" :key="liquidacion.id">
          <th scope="row">{{ liquidacion.id }}</th>
          <td
            v-for="liqOrg in liquidacion.liquidacion_organismo"
            :key="liqOrg.id"
          >
            {{ liqOrg.periodo.periodo }}
            <p class="text-muted text-sm">
              {{ liqOrg.tipoliquidacion.descripcion }}
            </p>
          </td>
          <td v-for="liqOrg in liquidacion.historia_laborales" :key="liqOrg.id">
            #{{ liqOrg.puesto.cod_laboral }}
          </td>
          <td v-for="liqOrg in liquidacion.historia_laborales" :key="liqOrg.id">
            {{ liqOrg.puesto.agente.nombre }}
            <p class="text-muted text-sm">
              {{ liqOrg.puesto.agente.cuil }}
            </p>
          </td>
          <td
            v-for="organismo in liquidacion.liquidacion_organismo"
            :key="organismo.id"
          >
            {{ organismo.organismo.organismo }}
            <p class="text-muted text-sm">
              cod {{ organismo.organismo.cod_organismo }}
            </p>
          </td>
          <td>$ {{ liquidacion.haberes_con_aporte }}</td>
        </tr>
        <tr class="table-secondary">
          <th scope="row" colspan="5">Total Haber con Aportes en pesos</th>
          <th scope="row">$ {{ totalHaberesConAportes }}</th>
        </tr>
      </tbody>
    </table>
    <div class="card" v-else>
      <div class="card-body">
        <p class="text-center">Sin Resultados Encontrados</p>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: function() {
      return {
        search_data: [],
        liquidaciones: [],
        errors: [],
        agente: {},
        search: "",
        from: "",
        to: "",
        max: "",
        isLoad: false,
        timeOut: 500,
        shown: false,
        totalHaberesConAportes: "",
      };
    },
    mounted() {
      this.getDateToday();
    },
    methods: {
      getDateToday() {
        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();
        var day = new Date(
          today.getFullYear(),
          today.getMonth() + 1,
          0
        ).getDate();
        const date = new Date(Date.UTC(year, month, day));
        this.max = date
          .toISOString()
          .split("T")[0]
          .toString();
      },
      getQuery() {
        this.search_data = [];
        this.errors = [];
        this.totalHaberesConAportes = "";
        if (this.search !== "") {
          axios
            .post("api/autocomplete", { search: this.search })
            .then((response) => {
              this.shown = true;
              setTimeout(() => {
                this.search_data = response.data;
                this.shown = false;
              }, this.timeOut);
            });
        }
      },
      loadInput(agente) {
        this.agente = agente;
        this.isLoad = true;
        this.search_data = [];
      },
      clear() {
        this.agente = {};
        this.isLoad = false;
        this.search_data = [];
        this.errors = [];
        this.liquidaciones = [];
      },
      getLiquidaciones() {
        this.errors = [];
        this.totalHaberesConAportes = "";
        const params = {
          agente: this.agente.id,
          desde: this.from,
          hasta: this.to,
        };
        //console.log(params);
        axios
          .post("api/liquidaciones", params)
          .then((response) => {
            //console.log(response.data);
            this.shown = true;
            setTimeout(() => {
              this.liquidaciones = response.data;
              this.liquidaciones.forEach((p) => {
                this.totalHaberesConAportes += parseFloat(
                  p.aporte_personal
                ).toFixed(2);
              });
              this.shown = false;
            }, this.timeOut);
          })
          .catch((err) => {
            //console.log(err.response.data);
            this.errors = err.response.data.errors;
            console.log(this.errors.desde);
          });
      },
    },
  };
</script>

<style></style>
