<template>
    <div id="paneljurisdicciones">
        <!--filtrocategoria-component @jurisdiccion="get_codigo(...arguments)"></filtrocategoria-component-->
        <div class="card shadow">
            <div class="card-header">
                <h5 class="card-title">Jurisdicciones</h5>
            </div>
            <div class="card-body">
                <jurisdiccion-component :jurisdicciones="jurisdicciones" @actualizar="created(...arguments)"></jurisdiccion-component>
            </div>
        </div>
    </div>
</template>

<script>

</script>
