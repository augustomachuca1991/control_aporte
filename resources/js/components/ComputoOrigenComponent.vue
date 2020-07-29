<template>
		<div class="card">
			<div class="card-body">
				<div class="card-title" v-if="origenes.length !== 0">Liquidacion de {{origenes[0].periodo.periodo}}</div>
				<ejs-grid :dataSource="origenes" :allowPaging="true" :allowSorting='true' :allowFiltering='true' :allowGrouping='true' :pageSettings='pageSettings' >
		          <e-columns>
		          	<e-column field='organismo.jurisdiccion.origen.origen' headerText='Origen' textAlign='left' width=120></e-column>
		            <e-column field='total_aporte_personal' headerText='Aporte Personal' textAlign='Right' format='C2' width=90></e-column>
		            <e-column field='total_sueldo_basico' headerText='Basico' textAlign='Right' format='C2' width=90></e-column>
		            <e-column field='total_antiguedad' headerText='Antiguedad' textAlign='Right' format='C2' width=90></e-column>
		            <e-column field='total_adicional' headerText='Adicional' textAlign='Right' format='C2' width=90></e-column>
		          </e-columns>
		          <e-aggregates>
		            <e-aggregate>
		                <e-columns>
		                    <e-column type="Sum" field="haber_bruto" format="C2" :footerTemplate='footerSum'></e-column>
		                    <e-column type="Sum" field="total_aporte_personal" format="C2" :footerTemplate='footerSum'></e-column>
		                    <e-column type="Sum" field="total_sueldo_basico" format="C2" :footerTemplate='footerSum'></e-column>
		                    <e-column type="Sum" field="total_antiguedad" format="C2" :footerTemplate='footerSum'></e-column>
		                    <e-column type="Sum" field="total_adicional" format="C2" :footerTemplate='footerSum'></e-column>
		                </e-columns>
		            </e-aggregate>
		          </e-aggregates>
		        </ejs-grid>
			</div>
		</div>
</template>

<script>
	
	import {Page, Sort, Filter, Group, Aggregate } from "@syncfusion/ej2-vue-grids";
	export default {
	  props:['origenes'],
	  data() {
	    return {
	      pageSettings: { pageSize: 10 },
	      footerSum: function () {
	        return  { template : Vue.component('sumTemplate', {
	            template: `<span>Suma: {{data.Sum}}</span>`,
	            data () {return { data: {data: {}}};}
	            })
	          }
	      },
	    };
	  },
	  provide: {
	    grid: [Page, Sort, Filter, Group, Aggregate]
	  },
	//computed:{
	//	  groups(){
	//	    return groupBy(this.origenes, 'organismo.jurisdiccion.origen.origen')
	//	  }
	//	}
	}
</script>
			    
