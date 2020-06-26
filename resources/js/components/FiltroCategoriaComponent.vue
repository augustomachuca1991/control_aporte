<template>
    <div class="form-row col mb-3">
    <div class="col-md-4">
        <label class="mr-sm-2 sr-only" for="origen">Origen</label>
        <select class="custom-select mr-sm-2" id="origen" name="origen"  v-model="selectedOrigen">
          <option :value="null" disabled selected>Seleccione Origen</option>
          <option v-for="(origen, index) in origenes" :key="origen.cod_origen" :value="origen.cod_origen">{{origen.origen}}</option>
        </select>
      </div>
      <div class="col-md-4">
      <label class="mr-sm-2 sr-only" for="jurisdiccion">Jurisdiccion</label>
        <select  :disabled="selectedOrigen.length == 0" class="custom-select mr-sm-2" id="jurisdiccion" name="jurisdiccion" v-model="selectedJurisdiccion">
           <option :value="null" disabled selected>Seleccione Jurisdiccion</option>
           <option v-for="(jurisdiccion, index) in jurisdicciones" :key="jurisdiccion.cod_jurisdiccion" :value="jurisdiccion.cod_jurisdiccion">{{jurisdiccion.jurisdiccion}}</option>
        </select>
      </div>
      <div class="col-md-4">
      <label class="mr-sm-2 sr-only" for="categoria">Categoria</label>
        <select :disabled="selectedJurisdiccion.length == 0" class="custom-select mr-sm-2" id="categoria" name="categoria" v-model="selectedCategoria">
          <option :value="null" disabled selected>Seleccione Categoria</option>
          <option v-for="(categoria, index) in categorias" :key="categoria.cod_categoria" :value="categoria.cod_categoria">{{categoria.categoria}}</option>
        </select>
      </div>
       <v-select  v-model="selectedCategory" label="category_desc" :options="category"></v-select>
    </div>
</template>


<script>
    export default {
        data: function() {
                return {
                    origenes: [],
                    category:[],
                    selectedCategory: null,
                    jurisdicciones: [],
                    categorias: [],
                    selectedOrigen: "",
                    selectedJurisdiccion: "",
                    selectedCategoria: "",
                }
            },
            watch: {
                selectedOrigen: function() {
                    this.jurisdicciones = [];
                    this.categorias = [];
                    this.selectedJurisdiccion = "";
                    this.selectedCategoria = "";
                    if (this.selectedOrigen > 0) {
                      this.jurisdicciones = this.origenes[this.selectedOrigen-1].jurisdicciones
                      console.log(this.jurisdicciones);
                    }
                  
                },
                selectedJurisdiccion: function() {
                    this.categorias = [];
                    this.selectedCategoria = "";
                      if (this.selectedJurisdiccion > 0) {
                          this.categorias = this.origenes[this.selectedOrigen-1].jurisdicciones[this.selectedJurisdiccion-1].categorias
                      }
                }
      },
      mounted() {
            axios.get('api/origen').then((response)=>{
                this.origenes = response.data;
                console.log(response.data);
            });
      }

    }
</script>
             