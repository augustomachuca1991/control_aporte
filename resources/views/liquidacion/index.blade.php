@extends('admin.app')

@section('body')
 <!-- Page Heading -->
 <div id="app">
    <!-- filtro tipo liquidacion -->
  	<!--<filtertipoliquidacion-component></tipoliquidacion-component>-->
	
	<!-- filtro Origen-Jurisdiccion-Organismo -->
	<filter-component></filter-component>

	<!-- filtro Origen-Jurisdiccion-Organismo -->
    
    <!-- tabla de liquidacion -->
    <liquidacion-component></liquidacion-component>
 </div>

<!-- Modal--> 
@include('modal.detalle')

@endsection
          
        
        