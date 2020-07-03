@extends('admin.app')

@section('body')
 <!-- Page Heading -->
 <div id="app">
 	<filtroperiodo-component ></filtroperiodo-component>
	<div class="card text-center">
	  <div class="card-header">
	    <ul class="nav nav-tabs card-header-tabs">
	      <li class="nav-item">
	        <a class="nav-link active" id="origen-tab" data-toggle="tab" href="#origen" role="tab" aria-controls="origen" aria-selected="false">Origen</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" id="jurisdiccion-tab" data-toggle="tab" href="#jurisdiccion" role="tab" aria-controls="jurisdiccion" >Jurisdicciones</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" id="organismo-tab" data-toggle="tab" href="#organismo" role="tab" aria-controls="organismo"  tabindex="-1" aria-disabled="true">Organismos</a>
	      </li>
	    </ul>
	  </div>
	  <div class="card-body">
	  	<div class="tab-content" id="myTabContent">
        	<origen-component></origen-component>
	    	<div class="tab-pane fade mh-100" id="jurisdiccion" role="tabpanel" aria-labelledby="jurisdiccion-tab">
	    		<h5 class="card-title">Jurisdicción</h5>
		    	
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
					    <tr class="table-default">
					      <th scope="row" class="table-secondary text-white">JURISDICCIÓN 1</th>
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
					      <th scope="row" class="table-secondary text-white">JURISDICCIÓN 2</th>
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
					      <th scope="row" class="table-secondary text-white">JURISDICCIÓN 3</th>
					      <td><small>$ 95444242.2</small></td>
					      <td><small>$ 532442458</small></td>
					      <td><small>$ 7523752</small></td>
					      <td><small>$ 5275272</small></td>
					      <td><small>$ 693333333</small></td>
					      <td><small>$ 2544141</small></td>
					      <td><small>$ 4152258</small></td>
					      <td><small>$ 5575375375</small></td>
					    </tr>
					    <tr>
					      <th scope="row" class="table-secondary text-white">JURISDICCIÓN 4</th>
					      <td><small>$ 95444242.2</small></td>
					      <td><small>$ 532442458</small></td>
					      <td><small>$ 7523752</small></td>
					      <td><small>$ 5275272</small></td>
					      <td><small>$ 693333333</small></td>
					      <td><small>$ 2544141</small></td>
					      <td><small>$ 4152258</small></td>
					      <td><small>$ 5575375375</small></td>
					    </tr>
					    <tr>
					      <th scope="row" class="table-secondary text-white">JURISDICCIÓN 5</th>
					      <td><small>$ 95444242.2</small></td>
					      <td><small>$ 532442458</small></td>
					      <td><small>$ 7523752</small></td>
					      <td><small>$ 5275272</small></td>
					      <td><small>$ 693333333</small></td>
					      <td><small>$ 2544141</small></td>
					      <td><small>$ 4152258</small></td>
					      <td><small>$ 5575375375</small></td>
					    </tr>
					    <tr>
					      <th scope="row" class="table-secondary text-white">JURISDICCIÓN 6</th>
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
	    	<div class="tab-pane fade mh-100" id="organismo" role="tabpanel" aria-labelledby="organismo-tab">
	    		<h5 class="card-title">Organismo</h5>
		    	
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
      	</div>
	  </div>
	</div>
 </div>

@endsection
    