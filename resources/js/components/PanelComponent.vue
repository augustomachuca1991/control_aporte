<template>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <filter-component 
                        @sendOrigen="search('origen',...arguments)" 
                        @sendJur="search('jurisdiccion',...arguments)" 
                        @sendOrganismo="search('organismo',...arguments)">
                </filter-component>
            </div>
            <div class="col-12 col-lg-3">
                <filtroperiodo-component 
                        @sendPeriodo="search('periodo',...arguments)">
                </filtroperiodo-component>
            </div>
            <div class="col-12 col-lg-3">
                <filtertipoliquidacion-component 
                        @sendTipo="search('tipo_liquidacion',...arguments)">
                </filtertipoliquidacion-component>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card border-0 shadow">
                    <div class="card-header border-0 shadow text-center">LIQUIDACIONES</div>

                    <div class="card-body">
                        <listaliquidaciones-component :filtro="filtro">
                        </listaliquidaciones-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return{
              filtro:{
                data:[],
                periodo:'',
                tipo_liquidacion:'',
                origen:'',
                jurisdiccion:'',
                organismo:'',
                condition:false

              },
          };
        },
        mounted() {
            console.log('Panel Component')
        },
        methods:{
            search(index,parm){
                //if (parm.length != 0 ) {
                //    this.filtro.condition = true
                //    this.filtro.data = parm
                //}
                switch (index) {
                  case 'periodo':
                    this.filtro.periodo = ""
                    this.filtro.periodo = parm
                    break;
                  case 'tipo_liquidacion':
                    this.filtro.tipo_liquidacion = ""
                    this.filtro.tipo_liquidacion = parm
                    break;
                  case 'origen':
                      this.filtro.origen = ""
                      this.filtro.origen = parm
                    break;
                  case 'jurisdiccion':
                      this.filtro.jurisdiccion = ""
                      this.filtro.jurisdiccion = parm
                    break;
                  case 'organismo':
                      this.filtro.organismo = ""
                      this.filtro.organismo = parm
                    break;
                }
            },
        }
    }
</script>






