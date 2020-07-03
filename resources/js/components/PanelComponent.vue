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
            <div class="col-12 col-lg-6">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <filtroperiodo-component 
                           @sendPeriodo="search('periodo',...arguments)">
                        </filtroperiodo-component>
                    </div>
                    <div class="col-12 col-lg-6">
                        <filtertipoliquidacion-component 
                            @sendTipo="search('tipo_liquidacion',...arguments)">
                        </filtertipoliquidacion-component>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <buscaragente-component @buscarAgente="like(...arguments)"></buscaragente-component>
                    </div>
                </div>
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
                    if (response.data.data.length != 0 ) {
                        this.filtro.data = response.data
                        this.filtro.condition = true
                    }
                })
            },
            like(input){
                axios.post(`api/liquidacion/agente/filtro` , input).then((response)=>{
                    this.filtro.data = [];
                    this.filtro.condition = false
                    if (response.data.data.length != 0 ) {
                        this.filtro.data = response.data
                        this.filtro.condition = true
                    }
                })
            }
        },

    }
</script>







