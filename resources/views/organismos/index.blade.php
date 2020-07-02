@extends('admin.app')
@section('body')
    <div id="app">
        <div class="row">
            <div class="col">
                <h1>Organismos</h1>
            </div>
        </div>

        <div class="card-body">
            <organismos-component></organismos-component>
        </div>
    </div>

@endsection
<script>
    import OrganismosComponent from "../../js/components/OrganismosComponent";
    export default {
        components: {OrganismosComponent}
    }
</script>
