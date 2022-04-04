<template>
  <div class="container">
    <p>{{ agente.nombre }} - {{ from }} - {{ to }}</p>
    <div class="row g-3 align-items-center px-2 py-3">
      <div class="col-auto">
        <label for="inputAgente" class="col-form-label">Agente</label>
      </div>
      <div class="col-auto">
        <span v-if="isLoad"
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
        <div class="card-footer" v-if="search_data.length">
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
      <!-- <div class="col-auto">
        <span id="agenteHelpInline" class="form-text">
          Must be 8-20 characters long.
        </span>
      </div> -->

      <div class="col-auto">
        <label for="inputDesde" class="col-form-label">Desde</label>
      </div>
      <div class="col-auto">
        <input
          type="date"
          id="inputDesde"
          class="form-control"
          aria-describedby="desdeInline"
          :max="max"
          v-model="from"
        />
      </div>
      <!-- <div class="col-auto">
        <span id="desdeInline" class="form-text">
          Must be 8-20 characters long.
        </span>
      </div> -->
      <div class="col-auto">
        <label for="inputHasta" class="col-form-label">Hasta</label>
      </div>
      <div class="col-auto">
        <input
          type="date"
          id="inputHasta"
          class="form-control"
          aria-describedby="hastaInline"
          :max="max"
          v-model="to"
        />
      </div>
      <!-- <div class="col-auto">
        <span id="hastaInline" class="form-text">
          Must be 8-20 characters long.
        </span>
      </div> -->
      <div class="col-auto">
        <button type="submit" class="btn bg-olive">Buscar</button>
      </div>
    </div>
    <table class="table table-hover">
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
        <tr>
          <th scope="row">1</th>
          <td>
            Octubre de 2018
            <p class="text-muted text-sm">Sueldo</p>
          </td>
          <td>#1436</td>
          <td>
            Mario Baracus
            <p class="text-muted text-sm">20-36269830-9</p>
          </td>
          <td>
            Min. de Seguridad
            <p class="text-muted text-sm">MINISTERIO DE SEGURIDAD</p>
          </td>
          <td>$5220</td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>
            Octubre de 2018
            <p class="text-muted text-sm">Sueldo</p>
          </td>
          <td>#1436</td>
          <td>
            Mario Baracus
            <p class="text-muted text-sm">20-36269830-9</p>
          </td>
          <td>
            Min. de Seguridad
            <p class="text-muted text-sm">MINISTERIO DE SEGURIDAD</p>
          </td>
          <td>$5220</td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>
            Octubre de 2018
            <p class="text-muted text-sm">Sueldo</p>
          </td>
          <td>#1436</td>
          <td>
            Mario Baracus
            <p class="text-muted text-sm">20-36269830-9</p>
          </td>
          <td>
            Min. de Seguridad
            <p class="text-muted text-sm">MINISTERIO DE SEGURIDAD</p>
          </td>
          <td>$5220</td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>
            Octubre de 2018
            <p class="text-muted text-sm">Sueldo</p>
          </td>
          <td>#1436</td>
          <td>
            Mario Baracus
            <p class="text-muted text-sm">20-36269830-9</p>
          </td>
          <td>
            Min. de Seguridad
            <p class="text-muted text-sm">MINISTERIO DE SEGURIDAD</p>
          </td>
          <td>$5220</td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>
            Octubre de 2018
            <p class="text-muted text-sm">Sueldo</p>
          </td>
          <td>#1436</td>
          <td>
            Mario Baracus
            <p class="text-muted text-sm">20-36269830-9</p>
          </td>
          <td>
            Min. de Seguridad
            <p class="text-muted text-sm">MINISTERIO DE SEGURIDAD</p>
          </td>
          <td>$ 5220.56</td>
        </tr>
        <tr class="table-secondary">
          <th scope="row" colspan="5">Total Haber con Aportes en pesos</th>
          <th scope="row">$5000000</th>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
    data: function() {
      return {
        search_data: [],
        agente: {},
        search: "",
        from: "",
        to: "",
        max: "",
        isLoad: false,
        timeOut: 300,
        shown: false,
      };
    },
    mounted() {
      this.getDateToday();
    },
    methods: {
      getDateToday: function() {
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
      getQuery: function() {
        this.search_data = [];
        if (this.search !== '') {
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
        this.agente = "";
        this.isLoad = false;
        this.search_data = [];
      },
    },
  };
</script>

<style></style>
