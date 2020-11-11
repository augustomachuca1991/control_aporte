<template>
	<div id="notification">
		<li class="nav-item dropdown no-arrow mx-1">
		  <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    <i class="fas fa-bell fa-fw"></i>
		    <!-- Counter - Alerts -->
		    <span class="badge badge-danger badge-counter" v-if="unReadNotifications.length !== 0">{{unReadNotifications.length}}</span>
		  </a>
		  <!-- Dropdown - Alerts -->
		  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
		    <h6 class="dropdown-header">
		      Notificaciones no leidas
		    </h6>
		    <a class="dropdown-item d-flex align-items-center" href="#" v-if="unReadNotifications.length === 0">
		      

		      <div class="mr-3">
		        <div class="icon-circle bg-warning">
		          <i class="fas fa-exclamation-triangle text-white"></i>
		        </div>
		      </div>
		      <!-- <div>
		        <div class="small text-gray-500">December 7, 2019</div>
		        $290.29 has been deposited into your account!
		      </div> -->No hay nuevas notificaciones
		    </a>
		    <a v-else class="dropdown-item d-flex align-items-center" href="#" v-for="(notification, index) in unReadNotifications" :key="notification.id" :notification="notification" v-on:click="leido(index, notification)">
		      <div class="mr-3">
		        <div class="icon-circle bg-primary">
		          <i class="fas fa-file-alt text-white"></i>
		        </div>
		      </div>
		      <div>
		        <div class="small text-gray-500">{{notification.created_at | moment}}</div>
		        <span class="font-weight-bold">{{notification.data.message}}</span>
		      </div>
		    </a>
		    <a class="dropdown-item text-center small text-gray-500" href="#" v-on:click="todas()">Mostrar todas las notificaciones</a>
		  </div>
		</li>
	</div>
</template>

<script>
	export default {
		props:['user'],
		data: function() {
                return {
                    unReadNotifications:[],
                }
            },
        mounted() {
            console.log('Componente Notificacion mounted')
            axios.get(`api/notification/${this.user.id}`).then((response)=>{
                  this.unReadNotifications = response.data;
                  //console.log(this.origenes[0].jurisdicciones[0].organismos.length)
              });
        },
        methods:{
            leido(index, notification){
                this.unReadNotifications.splice(index, 1);
                axios.put(`api/notification/leida/`+notification.id).then((response)=>{
                   console.log('marcado como leido');

                })
            },
            todas(){
                //this.unReadNotifications.splice(index, 1);
                axios.get(`api/notification/leida/`+notification.id).then((response)=>{
                   console.log('marcado como leido');

                })
            },
        }
    }
</script>