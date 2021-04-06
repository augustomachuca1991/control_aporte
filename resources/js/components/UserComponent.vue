<template>
	<div id="lista_usuarios">
		<div class="card card-solid">
			<div class="card-header">
				<div class="card-tools">
					<div class="input-group input-group-sm" style="width: 150px;">
						<input type="search" name="table_search" class="form-control float-right" placeholder="Buscar"  @keyup="buscar" v-model="search">

						<!-- <div class="input-group-append">
						  <button type="button" class="btn btn-outline-success" disabled>
						    <i class="fas fa-search"></i>
						  </button>
						</div> -->

					</div>
				</div>
			</div>
		  <div class="card-body pb-0">
		    <div class="row">
		    <!--users-->
		      <div v-for="(user, index) in users" :key="user.id" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
		        <div class="card bg-light d-flex flex-fill">
		          <div class="card-header text-muted border-bottom-0">
	              	  <div v-if="user.deleted_at" class="ribbon-wrapper">
                        <div class="ribbon bg-maroon">
                          locked
                        </div>
                      </div>
		            <nav class="navbar navbar-light bg-light">
		              <p class="navbar-brand text-muted">
		                <img src="/image/ips.png" width="30" height="30" alt="">
		                Instituto de Prevision Social
		              </p>
		            </nav>
		          </div>
		          <div class="card-body pt-0">
		            <div class="row">
		              <div class="col-7">
		                <h2 class="lead"><b>{{user.name}}</b></h2>
		                <p class="text-muted text-sm"><b>Roles: </b> {{user.roles[0].rol}}/ Arg / Graphic Artist / Coffee Lover </p>
		                <ul class="ml-4 mb-0 fa-ul text-muted">
		                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Mail: {{user.email}}</li>
		                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefo #: + 800 - 12 12 23 52</li>
		                </ul>
		              </div>
		              <div class="col-5 text-center">
		                <img :src='"https://ui-avatars.com/api/?name="+user.name+"&color=7F9CF5&background=EBF4FF"' alt="user-avatar" class="img-circle img-fluid shadow">
		              </div>
		            </div>
		          </div>
		          <div v-if="user.deleted_at" class="card-footer">
		            <div class="text-right">
		              <a href="#" class="btn btn-sm bg-gradient-maroon" @click="desbloquear(index,user)">
		                <i class="fas fa-unlock"></i> desbloquear
		              </a>
		            </div>
		          </div>
		          <div v-else class="card-footer">
		            <div class="text-right">
		              <a href="#" class="btn btn-sm bg-gradient-teal" @click="bloquear(index,user)">
		                <i class="fas fa-lock"></i>
		              </a>
		              <a href="#" class="btn btn-sm bg-gradient-primary">
		                <i class="fas fa-user"></i> Ver Perfil
		              </a>
		            </div>
		          </div>
		        </div>
		      </div>
		      <!--users end -->
		    </div>
		  </div>
		  <!-- /.card-body -->
		  <div class="card-footer">
		    <nav aria-label="Contacts Page Navigation">
		      <ul class="pagination justify-content-center m-0">
				<li class="page-item" :class="{ 'active': (current_page === n) }" v-for="n in last_page">
                    <a href="#" class="page-link" @click.prevent="getPage(n)">
                        <span >
                            {{ n }}
                        </span>
                    </a>
                </li>
		      </ul>
		    </nav>
		  </div>
		  <!-- /.card-footer -->
		</div>
		<!-- /.card -->
	</div>
</template>


<script>
	
	 export default {
        data: function() {
                return {
                    users:[],
                    current_page:'',
                    last_page:'',
                    prev_page_url:'',
                    search:'',
                }
            },
        mounted() {
              this.getUsers();
        },
        methods:{
        	getUsers:function(){
        		axios.get('api/users').then((response)=> {
        			this.users = response.data.data;
        			this.current_page = response.data.current_page;
        			this.last_page = response.data.last_page;
        		})
        	},
        	getPage: function(page){
        		axios.get('/api/users?page='+page).then((response)=> {
        			this.users = response.data.data;
        			this.current_page = response.data.current_page;
        			this.last_page = response.data.last_page;
        		})
        	},
        	desbloquear:function(index,user){
        		//console.log(user.id);
        		axios.get(`api/users/desbloquear/`+user.id).then((response)=>{
        			this.users[index].deleted_at = '';
        			this.users[index] = response.data;
        			alert('usuario desbloqueado: '+response.data)
        		});
        	},
        	bloquear:function(index,user){
        		 axios.delete(`api/users/delete/`+user.id).then((response)=>{
        			let hoy = new Date();
        			this.users[index].deleted_at = hoy;
        			alert('usuario bloqueado: '+response.data)
        		 });
        	},
        	buscar:function(){
        		axios.get(`api/users/${this.search}`).then((response)=>{
        		    this.users = response.data.data;
        		    this.current_page = response.data.current_page;
        		    this.last_page = response.data.last_page;
        		})
        	},
        },

    }
</script>