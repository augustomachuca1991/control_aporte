<template>
	<div class="tab-pane fade show active mh-100" id="origen" role="tabpanel" aria-labelledby="origen-tab" v-model="origenes" >
		<h5 class="card-title">Origen</h5>
		<!--<label>{{origenes}}</label>-->
		<div class="table-responsive">
			<table class="table table-sm table-hover table-bordeless">
			  <thead>
			    <tr class="table-dark">
			      <th scope="col">#</th>
			      <th scope="col">TOTAL HABER BRUTO</th>
			      <th scope="col">TOTAL APORTE PERSONAL</th>
			      <th scope="col">TOTAL BASICO</th>
			      <th scope="col">TOTAL ANTIGÜEDAD</th>
			      <th scope="col">TOTAL ADICIONAL</th>
			      <th scope="col">TOTAL FAMILIAR</th>
			      <th scope="col">TOTAL HIJO</th>
			      <th scope="col">TOTAL ESPOSA</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<tr v-if="origenes.length == 0"  class="table-default text-center">
			  		<th colspan="9">No Data</th>
			  	</tr>
				<tr v-for="(computo, llave) in origenes"  v-else>
			      <th scope="row">
			      	{{ llave }}
			      </th>
			      <td>
			      	<tr>
			      		<small>$ {{total.a}}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr>
			      		<small>$ {{total.b}}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr>
			      		<small>$ {{total.c}}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr>
			      		<small>$ {{total.d}}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr>
			      		<small>$ {{total.e}}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr>
			      		<small>$ {{total.f}}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr>
			      		<small>$ {{total.g}}</small>
			      	</tr>
			      </td>
			      <td>
			      	<tr>
			      		<small>$ {{total.h}}</small>
			      	</tr>
			      </td>
			    </tr>
			  </tbody> 
			</table>
		</div>

	</div>	
</template>

<script>
	export default {
		props:['origenes'],
        data: function() {
                return {
                	//origeness:[],
                	total:{
                		a:0,
                		b:0,
                		c:0,
                		d:0,
                		e:0,
                		f:0,
                		g:0,
                		h:0,
                	},
				    //editMode:true,

				    //total:{
				    //	sisper:{
				    //		total_haber_bruto: 0, 
					//	    total_aporte_personal: 0,
					//	    total_sueldo_basico:0,
					//	    total_antiguedad: 0,
					//	    total_familiar: 0,
					//	    total_hijo: 0,
					//	    total_esposa: 0,
				    //	},
				    //	municipio:{
				    //		total_haber_bruto: 0, 
					//	    total_aporte_personal: 0,
					//	    total_sueldo_basico:0,
					//	    total_antiguedad: 0,
					//	    total_familiar: 0,
					//	    total_hijo: 0,
					//	    total_esposa: 0,
				    //	},
				    //	autonomos:{
				    //		total_haber_bruto: 0, 
					//	    total_aporte_personal: 0,
					//	    total_sueldo_basico:0,
					//	    total_antiguedad: 0,
					//	    total_familiar: 0,
					//	    total_hijo: 0,
					//	    total_esposa: 0,
				    //	},
				    //}
				}
            },
        computed: {
		  suma: function(){
		      this.total.a = 0;
		      this.total.b = 0;
		      this.total.c = 0;
		      this.total.d = 0;
		      this.total.e = 0;
		      this.total.f = 0;
		      this.total.g = 0;
		      this.total.h = 0;
		      for(let i = 0; i < this.origenes.length; i++){
		        this.total.a += parseFloat(this.origenes[i].haber_bruto);
		        this.total.b += parseFloat(this.origenes[i].total_aporte_personal);
		        this.total.c += parseFloat(this.origenes[i].total_sueldo_basico);
		        this.total.d += parseFloat(this.origenes[i].total_antiguedad);
		        this.total.e += parseFloat(this.origenes[i].total_adicional);
		        this.total.f += parseFloat(this.origenes[i].total_familiar);
		        this.total.g += parseFloat(this.origenes[i].total_hijo);
		        this.total.h += parseFloat(this.origenes[i].total_esposa);
		      }

		     return this.total;
		   }
		},
	}
</script>
			    
