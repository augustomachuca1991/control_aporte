<template>
    <div class="container">
        <!--filtro origen, jurisdiccion, organismo-->
        

        <div class="card my-5 border-0 shadow">
            <div class="card-header bg-info">
                <div class="card-title">
                    <h2 class="text-white">Panel de busqueda</h2>
                </div>
            </div>
            <div class="card-body">
                <filter-component 
                        @sendOrigen="search('origen',...arguments)" 
                        @sendJur="search('jurisdiccion',...arguments)" 
                        @sendOrganismo="search('organismo',...arguments)">
                </filter-component>
                <div class="form-row my-2 justify-content-between">
                <!--filtro periodo-->
                    <div class="col-12 col-md-12 col-lg-4 mb-md-3">
                        <!--buscar por nombre de agente-->
                        <buscaragente-component 
                            @buscarAgente="like(...arguments)">
                        </buscaragente-component>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <!--filtro tipo liquidacion-->
                        <filtertipoliquidacion-component 
                            @sendTipo="search('tipo_liquidacion',...arguments)">
                        </filtertipoliquidacion-component>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <filtroperiodo-component 
                           @sendPeriodo="search('periodo',...arguments)">
                        </filtroperiodo-component>
                    </div>
                </div>
            </div>
        </div>
            
        <h3>Liquidaciones</h3>
        <listaliquidaciones-component 
            :filtro="filtro">
        </listaliquidaciones-component>        
        
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
                switch (index) {
                  case 'periodo':
                    this.filtro.periodo = ''
                    this.filtro.periodo = parm
                    break;
                  case 'tipo_liquidacion':
                    this.filtro.tipo_liquidacion = ''
                    this.filtro.tipo_liquidacion = parm
                    break;
                  case 'origen':
                      this.filtro.origen = ''
                      this.filtro.jurisdiccion = ''
                      this.filtro.organismo = ''
                      this.filtro.origen = parm
                    break;
                  case 'jurisdiccion':
                      this.filtro.origen = ''
                      this.filtro.jurisdiccion = ''
                      this.filtro.organismo = ''
                      this.filtro.jurisdiccion = parm
                    break;
                  case 'organismo':
                      this.filtro.origen = ''
                      this.filtro.jurisdiccion = ''
                      this.filtro.organismo = ''
                      this.filtro.organismo = parm
                    break;
                }
                const params = {
                    periodo:this.filtro.periodo,
                    tipo_liquidacion:this.filtro.tipo_liquidacion,
                    organismo:this.filtro.organismo,
                    jurisdiccion:this.filtro.jurisdiccion,
                    origen:this.filtro.origen,
                }
                axios.post('api/liquidacion/filtro', params).then((response)=>{
                    this.filtro.data = [];
                    this.filtro.condition = false
                    if (response.data.length != 0 ) {
                        this.filtro.data = response.data
                        this.filtro.condition = true
                    }
                }).catch(function (error) {
                  console.log(error);
                });
            },
            like(input){
                axios.post(`api/liquidacion/agente/filtro` , input).then((response)=>{
                    this.filtro.data = [];
                    this.filtro.condition = false
                    if (response.data.length != 0 ) {
                        this.filtro.data = response.data
                        this.filtro.condition = true
                    }
                }).catch(function (error) {
                  console.log(error);
                });
            }
        },

    }
</script>










