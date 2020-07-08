<template>
	<div class="tab-pane fade show active mh-100" id="origen" role="tabpanel" aria-labelledby="origen-tab">
		<h5 class="card-title">Origen</h5>
		
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
			    <tr class="table-default text-center">
			      <th scope="row" class="table-secondary text-white">SISPER</th>
			      <td><small>$ 2300000</small></td>
			      <td><small>$ 150000.05</small></td>
			      <td><small>$ 23000000.5</small></td>
			      <td><small>$ 478246144</small></td>
			      <td><small>$ 465131344.25</small></td>
			      <td><small>$ 75527522.36</small></td>
			      <td><small>$ 27775.25</small></td>
			      <td><small>$ 14141414.36</small></td>
			    </tr>
			    <tr>
			      <th scope="row" class="table-secondary text-white">MUNICIPIO</th>
			      <td><small>$ 2752754171</small></td>
			      <td><small>$ 172727272</small></td>
			      <td><small>$ 75275272</small></td>
			      <td><small>$ 1275202.22</small></td>
			      <td><small>$ 752752727.88</small></td>
			      <td><small>$ 75585852.356</small></td>
			      <td><small>$ 655254</small></td>
			      <td><small>$ 242142224.6</small></td>
			    </tr>
			    <tr>
			      <th scope="row" class="table-secondary text-white">ENTIDADES AUTONOMAS</th>
			      <td><small>$ 95444242.2</small></td>
			      <td><small>$ 532442458</small></td>
			      <td><small>$ 7523752</small></td>
			      <td><small>$ 5275272</small></td>
			      <td><small>$ 693333333</small></td>
			      <td><small>$ 2544141</small></td>
			      <td><small>$ 4152258</small></td>
			      <td><small>$ 5575375375</small></td>
			    </tr>
			  </tbody>
			</table>
		</div>	    	
	</div>	
</template>

<script>
	export default {
        data: function() {
                return {
                }
            },
        mounted() {
              
                  console.log('origen-component mounted')
        }

    }
</script>
