<template>
    <table class="table border-rounded table-striped" v-model="jurisdicciones">
        <thead class="thead-dark">
            <tr style="text-align: center;">
                <th scope="col">Id.</th>
                <th scope="col">cod.</th>
                <th scope="col">Descripción</th>
                <th scope="col">Origen</th>
                <th scope="col">Creación</th>
                <th scope="col">Modificación</th>
                <th scope="col" nowrap colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align: center;" v-for="jurisdiccion in jurisdicciones">
                <td>{{ jurisdiccion.id }}</td>
                <td>{{ jurisdiccion.cod_jurisdiccion }}</td>
                <td>{{ jurisdiccion.jurisdiccion }}</td>
                <td>{{ jurisdiccion.origen_id }}</td>
                <td>{{ jurisdiccion.created_at }}</td>
                <td>{{ jurisdiccion.updated_at }}</td>
                <td class="td-button">
                    <a href="" class="btn btn-primary">
                        <i class="fa fa-cog"> Editar </i>
                    </a>
                </td>
                <td class="td-button">
                    <form method="POST" action="">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Desea eliminar a {{ $jurisdiccion->jurisdiccion }}?')" >
                            <i class="fa fa-trash"> Eliminar</i>
                        </button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        data: function(){
            return{
                jurisdicciones:[],
            }

        },
        mounted() {
            axios.get('/jurisdicciones').then((response)=>{
                this.jurisdicciones = response.data;
            })

        }

    }
</script>
