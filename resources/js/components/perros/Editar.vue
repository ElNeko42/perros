<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Editar Perro</h4></div>
                <div class="card-body">
                    <form @submit.prevent="actualizar">
                         <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Título</label>
                                    <input type="text" class="form-control" v-model="Dog.titulo">
                                </div>
                            </div>
                            <div class="col-12 mb-2">

                                <div class="form-floating">
                                <textarea class="form-control" id="floatingTextarea2" v-model="Dog.contenido" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Contenido</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>                          
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"editar-perro",
    data(){
        return {
            Dog:{
                titulo:"",
                contenido:"",
            }
        }
    },
    mounted(){
        this.mostrarDog()
    },
    methods:{
        async mostrarDog(){
            await this.axios.get(`/api/Dog/${this.$route.params.id}`).then(response=>{
                const { titulo, contenido } = response.data
                this.Dog.titulo = titulo
                this.Dog.contenido = contenido
            }).catch(error=>{
                console.log(error)
            })
        },
        async actualizar(){
            await this.axios.put(`/api/Dog/${this.$route.params.id}`,this.Dog).then(response=>{
                this.$router.push({name:"mostrarPerros"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>