<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Perro</h4>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" @submit.prevent="actualizar">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Raza</label>
                                    <input type="text" class="form-control" v-model="dog.raza">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>imagen</label>
                                    <input type="file" class="form-control" @change="obtenerImagen">
                                    <figure>
                                        <img width="200" height="200" :src="imagen" alt="foto perro" >
                                    </figure>
                                </div>

                            </div>
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label>Tamaño</label>
                                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                                        v-model="dog.tamaño">
                                        <option selected>seleccione tamaño</option>
                                        <option value="Pequeño">Pequeño</option>
                                        <option value="Pequño/Mediano">Pequño/Mediano</option>
                                        <option value="Mediano">Mediano</option>
                                        <option value="Mediano/Grande">Mediano/Grande</option>
                                        <option value="Grande">Grande</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label>Pelo</label>
                                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                                        v-model="dog.pelo">
                                        <option value="Corto">Corto</option>
                                        <option value="Largo">Largo</option>
                                        <option value="Rizado">Rizado</option>
                                        <option value="Duro">Duro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Color</label>
                                    <input type="text" class="form-control" v-model="dog.color">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Origen</label>
                                    <input type="text" class="form-control" v-model="dog.origen">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-floating">
                                    <textarea class="form-control" id="floatingTextarea2" v-model="dog.observaciones"
                                        style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">observaciones</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="col-1">
                                    <button @click="cancelar" class="btn btn-danger">Cancelar</button>
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
export default {
    name: "editar-perro",
    data() {
        return {
            imagenMiniatura: '',
            dog: {
                raza: "",
                observaciones: "",
                tamaño: "",
                pelo: "",
                color: "",
                origen: "",
                imagen: "",
                imagenFile: "",
            }
        }
    },
    mounted() {
        this.mostrarDog()
    },
    methods: {
        async mostrarDog() {
            await this.axios.get(`/api/Dog/${this.$route.params.id}`).then(response => {
                const { raza, observaciones, tamaño, pelo, color,origen,imagen, } = response.data
                this.dog.raza = raza
                this.dog.pelo = pelo
                this.dog.color = color
                this.dog.tamaño = tamaño
                this.dog.origen = origen
                this.dog.imagen = imagen
                this.dog.observaciones = observaciones
                this.imagenMiniatura=imagen
            }).catch(error => {
                console.log(error)
            })
        },
        async actualizar() {  
            Swal.fire({
                icon: 'success',
                title: 'guardado',
                text: 'Perrito guardado correctamente',

            })
            await this.axios.put(`/api/Dog/${this.$route.params.id}`, this.dog).then(response => {
                this.$router.push({ name: "mostrarPerros" })
            }).catch(error => {
                console.log(error)
            })
        },
        obtenerImagen(e) {
            let file = e.target.files[0];
            console.log(file)
            this.dog.imagen = "images/" + file.name
            this.dog.imagenFile = file
            this.cargarImagen(file);
        },
        cargarImagen(file) {
            let reader = new FileReader();
            reader.onload = (e) => {
                this.imagenMiniatura = e.target.result;
            }

            reader.readAsDataURL(file);
        },
        cancelar() {
            window.history.back();
        },
    },
    computed: {
        imagen() {
            return this.imagenMiniatura;
        }
    }
}
</script>