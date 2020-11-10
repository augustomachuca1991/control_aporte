<template>
	<div id="notification">
		<li class="nav-item dropdown no-arrow mx-1">
		  <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    <i class="fas fa-bell fa-fw"></i>
		    <!-- Counter - Alerts -->
		    <span class="badge badge-danger badge-counter" v-if="notifications.length !== 0">{{notifications.length}}+</span>
		  </a>
		  <!-- Dropdown - Alerts -->
		  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
		    <h6 class="dropdown-header">
		      Notificaciones no leidas
		      <!-- {{notifications[0]['data']}} -->
		    </h6>
		    <a class="dropdown-item d-flex align-items-center" href="#" v-for="notification in notifications" :key="notification.id" :notification="notification">
		      <div class="mr-3">
		        <div class="icon-circle bg-primary">
		          <i class="fas fa-file-alt text-white"></i>
		        </div>
		      </div>
		      <div>
		        <div class="small text-gray-500">{{notification.created_at | moment}}</div>
		        <span class="font-weight-bold" :v-model="notification.data['message']">Tarea Completa</span>
		      </div>
		    </a>
		    <!-- <a class="dropdown-item d-flex align-items-center" href="#">
		      <div class="mr-3">
		        <div class="icon-circle bg-success">
		          <i class="fas fa-donate text-white"></i>
		        </div>
		      </div>
		      <div>
		        <div class="small text-gray-500">December 7, 2019</div>
		        $290.29 has been deposited into your account!
		      </div>
		    </a>
		    <a class="dropdown-item d-flex align-items-center" href="#">
		      <div class="mr-3">
		        <div class="icon-circle bg-warning">
		          <i class="fas fa-exclamation-triangle text-white"></i>
		        </div>
		      </div>
		      <div>
		        <div class="small text-gray-500">December 2, 2019</div>
		        Spending Alert: We have noticed unusually high spending for your account.
		      </div>
		    </a> -->
		    <a class="dropdown-item text-center small text-gray-500" href="#">Mostrar todas las notificaciones</a>
		  </div>
		</li>
	</div>
</template>

<script>
	export default {
		data: function() {
                return {
                    notifications:[],
                }
            },
        mounted() {
            console.log('Componente Notificacion mounted')
            axios.get('api/notification').then((response)=>{
                  this.notifications = response.data;
                  //console.log(this.origenes[0].jurisdicciones[0].organismos.length)
              });
        }
    }
</script>