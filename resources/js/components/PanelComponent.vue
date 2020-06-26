<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <filtroperiodo-component 
                        @sendPeriodo="search('periodo',...arguments)">
                </filtroperiodo-component>

                <filtertipoliquidacion-component 
                        @sendTipo="search('tipo_liquidacion',...arguments)">
                </filtertipoliquidacion-component>

                <filter-component 
                        @sendOrigen="search('origen',...arguments)" 
                        @sendJur="search('jurisdiccion',...arguments)" 
                        @sendOrganismo="search('organismo',...arguments)">
                </filter-component>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card  border-0 shadow p-3">
                    <div class="card-header">Liquidaciones</div>

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
              periodo:{},
              filtro:{
                periodo:'',
                tipo_liquidacion:'',
                origen:'',
                jurisdiccion:'',
                organismo:'',

              },
          };
        },
        mounted() {
            console.log('Panel Component')
        },
        methods:{
            search(index,parm){
                    //console.log(parm);
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

