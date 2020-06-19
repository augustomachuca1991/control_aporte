<template>
   <table class="table table-borderless table-striped border" v-model="categorias">
            <caption>Categorías</caption>
            <thead>
              <tr>
                <th scope="col">Cod.</th>
                <th scope="col">Categoría</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="categoria in categorias">
                <th scope="row">{{categoria.cod_categoria}}</th>
                <td>{{categoria.categoria}}</td>
                <td>
                   <a :href="'edit_categoria/' + categoria.id" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#edit_categoria"><i class="far fa-edit"></i></a>
                   <a :href="'delete_categoria/' + categoria.id" class="btn btn-primary btn-sm text-white"><i class="far fa-trash-alt"></i></i></a>
                </td>
              </tr>
            </tbody>
    </table> 
</template>

<script>
    export default {
        data: function(){
            return{
                categorias:[],
            }
        
        },
        mounted() {
            axios.get('api/categoria').then((response)=>{
               this.categorias = response.data;
            })
            
        }

    }
</script>