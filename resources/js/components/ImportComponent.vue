<template>
	 <div id="import" class="card mb-3">
      <img class="card-img-top" src="/image/bannerExcel.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Subir Archivo</h5>
        <form @submit.prevent="submitFile()">
          <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Importar Archivo</label>
            <div class="col-sm-8 d-flex align-items-start">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="file" lang="es" ref="file" @change="handleFileUpload()"  required>
                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
              </div>
            </div>
            <div class="col-sm-2">
              <button type="submit" name="import" id="import" class="btn btn-success btn-block">
                <i class="fas fa-file-upload"></i>&nbsp;
                <span class="small">Importar</span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
</template>

<script>
    const Toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    timer: 6000,
                    showConfirmButton: false,
                    onOpen: (toast) => {
                      toast.addEventListener('mouseenter', swal.stopTimer)
                      toast.addEventListener('mouseleave', swal.resumeTimer)
                    }
                  });
    export default {
        data: function(){
            return{      
              file:'',
              meta:{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
              },
            }
        },
        mounted(){
          console.log('import-component mounted')
        },
        methods:{ 
          submitFile () {
            let formData = new FormData()
            formData.append('file', this.file)
            axios.post('api/import', formData, this.meta)
              .then((response)=>{
                if (response.data.status) {
                  Toast.fire({
                    icon: 'success',
                    title: response.data.message,
                    background: '#E7FFD7',
                  })
                }else{
                  Toast.fire({
                    icon: 'error',
                    title: response.data.message,
                    background:'#FCDBCD',
                  })
                }
              }).catch((error) => {
                  console.log('por el catch: '+error)
                  Toast.fire({
                    icon: 'error',
                    title: error,
                    background:'#FCDBCD',
                  })
              })
          },
          handleFileUpload(){
            this.file = '';
            this.file = this.$refs.file.files[0];
          }
        },
      } 
              
</script>