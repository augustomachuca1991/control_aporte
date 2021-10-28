<template>
    <div class="container">
        <div class="row">
            <div class="col">
                {{ declaracionjuradaLines }}
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span>total registros encontrados: {{ paginate.total }}</span>
                <paginator-component
                    :data="declaracionjuradaLines"
                    :paginate="paginate"
                    @response="asignar(...arguments)"
                ></paginator-component>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["id"],
    data: function() {
        return {
            declaracionjuradaLines: [],
            paginate: {
                current_page: "",
                last_page: "",
                total: "",
                path: "",
                next_page_url: "",
                from: "",
                to: "",
                next_page_url: "",
                prev_page_url: ""
            }
        };
    },
    mounted() {
        this.getDeclaracionJuradaDetalle();
    },
    methods: {
        getDeclaracionJuradaDetalle() {
            axios
                .get(`api/declaracion_jurada_lines/${this.id}`)
                .then(response => {
                    this.asignar(response);
                });
        },
        asignar(response) {
            this.declaracionjuradaLines = response.data.data;
            this.paginate.current_page = response.data.current_page;
            this.paginate.last_page = response.data.last_page;
            this.paginate.total = response.data.total;
            this.paginate.path = response.data.path;
            this.paginate.from = response.data.from;
            this.paginate.to = response.data.to;
            this.paginate.next_page_url = response.data.next_page_url;
            this.paginate.prev_page_url = response.data.prev_page_url;
        }
    }
};
</script>
