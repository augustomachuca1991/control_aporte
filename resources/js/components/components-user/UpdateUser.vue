<template>
    <div class="container">
        <div
            class="modal fade row justify-content-center  "
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="col-md-4">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">
                            Alexander Pierce
                        </h3>
                        <h5 class="widget-user-desc">
                            Founder & CEO
                        </h5>
                    </div>
                    <div class="widget-user-image">
                        <img
                            class="img-circle elevation-2"
                            :src="
                                'https://ui-avatars.com/api/?name=' +
                                    'user.name' +
                                    '&color=7F9CF5&background=EBF4FF'
                            "
                            alt="User Avatar"
                        />
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        3,200
                                    </h5>
                                    <span class="description-text">SALES</span>
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        13,000
                                    </h5>
                                    <span class="description-text"
                                        >FOLLOWERS</span
                                    >
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        35
                                    </h5>
                                    <span class="description-text"
                                        >PRODUCTS</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    //props:['data'],
    data: function() {
        return {
            data: []
        };
    },
    mounted() {
        console.log("update user");
    },
    methods: {}
};
</script>
