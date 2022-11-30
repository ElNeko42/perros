<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Perro</h4>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" @submit.prevent="crear">
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
                                        <img width="200" height="200" :src="imagen" alt="foto perro">
                                    </figure>
                                </div>

                            </div>
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label>Tamaño</label>
                                    <select class="form-select form-select-lg mb-3"
                                        aria-label=".form-select-lg example" v-model="dog.tamaño">
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
                                    <select class="form-select form-select-lg mb-3"
                                        aria-label=".form-select-lg example" v-model="dog.pelo">
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
    name: "crear-perro",
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
            }
        }
    },
    methods: {
        async crear() {
            let formdata = new FormData();
           
            formdata.append('raza', this.dog.raza)
            formdata.append('observaciones', this.dog.observaciones)
            formdata.append('imagen', this.dog.imagen)
            formdata.append('imagenFile', this.dog.imagenFile)
            formdata.append('tamaño', this.dog.tamaño)
            formdata.append('pelo', this.dog.pelo)
            formdata.append('color', this.dog.color)
            formdata.append('origen', this.dog.origen)
            Swal.fire({
                icon: 'success',
                title: 'guardado',
                text: 'Perrito guardado correctamente',

            })
            await this.axios.post('/api/Dog', formdata).then(response => {

                this.$router.push({ name: "mostrarPerros" })
            }).catch(error => {
                console.log(error)
            })
        },
        cancelar() {
            window.history.back();
        },
        obtenerImagen(e) {
            let file = e.target.files[0];
            console.log(file)
            this.dog.imagen = "images/"+file.name
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
    },
    computed: {
        imagen() {
            return this.imagenMiniatura;
        }
    }
}
</script>