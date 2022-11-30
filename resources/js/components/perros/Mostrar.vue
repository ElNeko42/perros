<template>
    <div class="row">
        <div class="col-12 mb-2">
            <!-- llamamos al componente para Crear   -->
            <router-link :to='{ name: "crearPerro" }' class="btn btn-success"><i
                    class="fas fa-plus-circle"></i></router-link>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Raza</th>
                            <th>Tamaño</th>
                            <th>Color de pelo</th>
                            <th>pelo</th>
                            <th>origen</th>

                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="dog in dogs" :key="dog.id">
                            <td>{{ dog.id }}</td>
                            <td><img :src="dog.imagen" class="img-responsive" height="70" width="90"></td>
                            <td>{{ dog.raza }}</td>
                            <td>{{ dog.tamaño }}</td>
                            <td>{{ dog.color }}</td>
                            <td>{{ dog.pelo }}</td>
                            <td>{{ dog.origen }}</td>

                            <td>
                                <!-- llamamos al componente para Editar     -->
                                <router-link :to='{ name: "editarPerro", params: { id: dog.id } }' class="btn btn-info"><i
                                        class="fas fa-edit"></i></router-link>
                                <a type="button" @click="borrarDogs(dog.id)" class="btn btn-danger"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "dogs",
    data() {
        return {
            dogs: []
        }
    },
    mounted() {
        this.mostrarDogs()
    },
    methods: {
        async mostrarDogs() {
            await this.axios.get('/api/Dog').then(response => {
                this.dogs = response.data
            }).catch(error => {
                console.log(error)
                this.dogs = []
            })
        },
        borrarDogs(id) {
            if (confirm("¿Confirma eliminar el registro?")) {
                this.axios.delete(`/api/Dog/${id}`).then(response => {
                    this.mostrarDogs()
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
}
</script>