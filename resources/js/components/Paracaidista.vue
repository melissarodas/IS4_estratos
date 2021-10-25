<template>
    <div>
        <h1 class="text-center">Listado de Paracaidistas</h1>
        <hr>

        <!-- Button trigger modal -->
        <button @click="update=false; openModal();" type="button" class="btn btn-primary">Nuevo Paracaidista</button>

        <!-- Modal -->
        <div class="modal" :class="{show:modal}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{titleModal}}</h5>
                        <button @click="closeModal();" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="cedula">Cedula / RUC</label>
                            <input v-model="paracaidista.cedula" type="text" class="form-control" id="cedula" placeholder="Numero de cedula"  name="">
                        </div>
                        <div>
                            <label for="nombre">Nombre(s)</label>
                            <input v-model="paracaidista.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del paracaidista"  name="">
                        </div>
                        <div>
                            <label for="apellido">Apellido(s)</label>
                            <input v-model="paracaidista.apellido" type="text" class="form-control" id="apellido" placeholder="Apellido del paracaidista"  name="">
                        </div>
                        <div>
                            <label for="fecha_nacimiento">Fecha de nacimiento.</label>
                            <input v-model="paracaidista.fecha_nacimiento" type="text" class="form-control" id="fecha_nacimiento" placeholder="Fecha de naciemiento"  name="">
                        </div>
                        <div>
                            <label for="telefono">Telefono</label>
                            <input v-model="paracaidista.telefono" type="text" class="form-control" id="telefono" placeholder="Telefono"  name="">
                        </div>
                         <div>
                            <label for="direccion">Dirección</label>
                            <input v-model="paracaidista.direccion" type="text" class="form-control" id="direccion" placeholder="Direccion"  name="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="closeModal();" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button @click="guardar();" type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>



        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cedula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Fecha de nacimiento</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Dirección</th>
                    <th scope="col" colspan="2" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="paracaidista in paracaidistas" :key='paracaidista.id'>
                    <th scope="row">{{paracaidista.id}}</th>
                    <td>{{paracaidista.cedula}}</td>
                    <td>{{paracaidista.nombre}}</td>
                    <td>{{paracaidista.apellido}}</td>
                    <td>{{paracaidista.fecha_nacimiento}}</td>
                    <td>{{paracaidista.telefono}}</td>
                    <td>{{paracaidista.direccion}}</td>
                    <td>
                        <button @click="update=true; openModal(paracaidista);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(paracaidista.id)" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>       
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    data() {
        return {
            paracaidista:{
                cedula:'',
                nombre:'',
                apellido:'',
                fecha_nacimiento:'',
                telefono:'',
                direccion:'',
            },
            id:0,
            update:true,//variable para controlar si el  modal es de registro o de creacion
            modal:0, //modal = 0 cerrado y modal=1 abierto
            titleModal: '',
            paracaidistas:[],

        }
    },
   methods: {
       async list(){
           const res = await axios.get('paracaidistas');
           this.paracaidistas = res.data;
       },
       async eliminar(id) {
           const res = await axios.delete('/paracaidistas/'+id);
           this.list();//para cargar de vuelta el listado
       },
       async guardar() {
           if(this.update){
               const res = await axios.put('/paracaidistas/'+this.id, this.paracaidista);
           }else{
               const res = await axios.post('/paracaidistas', this.paracaidista);
           }
           this.closeModal();
           this.list();
       },
        openModal(data={}) {
           this.modal = 1;
           if(this.update){
               this.id = data.id;
               this.titleModal='Modificar Paracaidista'
               this.paracaidista.cedula = data.cedula;
               this.paracaidista.nombre = data.nombre;
               this.paracaidista.apellido = data.apellido;
               this.paracaidista.fecha_nacimiento = data.fecha_nacimiento;
               this.paracaidista.telefono = data.telefono;
               this.paracaidista.direccion = data.direccion;
           }else{
               this.id = data.id;
               this.titleModal='Agregar Paracaidista'
               this.paracaidista.cedula = '';
               this.paracaidista.nombre = '';
               this.paracaidista.apellido = '';
               this.paracaidista.fecha_nacimiento = '';
               this.paracaidista.telefono = '';
               this.paracaidista.direccion = '';
           }
       },
       closeModal() {
           this.modal = 0;
       }
   },
   created() {
       this.list();
   },
}
</script>

<style>
    .show{
        display: list-item;
        opacity:1;
        background: rgba(44,38,75,0.849);
    }
</style>
