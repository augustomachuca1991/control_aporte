<template>
    <nav aria-label="Contacts Page Navigation">
        <ul class="pagination paginate-xs justify-content-end m-0">
            <!-- previous -->
            <li class="page-item" v-show="paginate.prev_page_url">
                <a href="#" class="page-link" @click.prevent="getPreviousPage">
                    <span>
                        <span aria-hidden="true">«</span>
                    </span>
                </a>
            </li>

            <!-- items links -->
            <li
                class="page-item"
                :class="{ active: paginate.current_page === n }"
                v-for="n in paginate.last_page"
                :key="n.id"
            >
                <a href="#" class="page-link" @click.prevent="getPage(n)">
                    <span>
                        {{ n }}
                    </span>
                </a>
            </li>

            <!-- next -->
            <li class="page-item" v-show="paginate.next_page_url">
                <a href="#" class="page-link" @click.prevent="getNextPage">
                    <span>
                        <span aria-hidden="true">»</span>
                    </span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props:['data','paginate'],
    mounted() {
        console.log("paginator");
    },
    methods: {
        getPage(page) {
            axios.get(this.paginate.path + "?page=" + page).then(response => {
                this.paginator(response);
            });
        },
        getPreviousPage() {
            axios.get(this.paginate.prev_page_url).then(response => {
                this.paginator(response);
            });
        },
        getNextPage() {
            axios.get(this.paginate.next_page_url).then(response => {
                this.paginator(response);
            });
        },
        paginator(response){
            this.$emit('response',response);
        }
    },
};
</script>

<style>
li.page-item {
    display: none;
}

.page-item:first-child,
.page-item:nth-child(2),
.page-item:nth-last-child(2),
.page-item:last-child,
.page-item.active,
.page-item.disabled {
    display: block;
}
</style>
