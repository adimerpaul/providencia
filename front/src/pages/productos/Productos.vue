<template>
  <q-page class="q-pa-md">
    <q-card flat bordered>
      <q-card-section>
        <div class="row">
          <div class="col-12 col-md-6">
            <q-input v-model="filter" label="Buscar" outlined dense />
          </div>
        </div>
        <q-markup-table dense wrap-cells flat bordered >
          <thead>
            <tr>
              <td>Opciones</td>
              <td>Medicamento</td>
              <td>Forma farmaceutica</td>
              <td>Concentracion</td>
              <td>Precio</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="producto in productos" :key="producto.id">
              <td>
<!--                <q-btn icon="edit" flat round dense @click="productoEdit(producto)" />-->
<!--                <q-btn icon="delete" flat round dense @click="productoDelete(producto.id)" />-->
              </td>
              <td>{{ producto.medicamento }}</td>
              <td>{{ producto.forma_farmaceutica }}</td>
              <td>{{ producto.concentracion }}</td>
              <td>{{ producto.precio }}</td>
            </tr>
          </tbody>
        </q-markup-table>
        <pre>{{productos}}</pre>
<!--        [-->
<!--        {-->
<!--        "id": 1,-->
<!--        "medicamento": "Abacavir",-->
<!--        "forma_farmaceutica": "Comprimido",-->
<!--        "concentracion": "300 mg",-->
<!--        "imagen": null,-->
<!--        "precio": "2.89",-->
<!--        "costo": null,-->
<!--        "stock": null,-->
<!--        "activo": null,-->
<!--        "categoria_id": null-->
<!--        },-->
      </q-card-section>
    </q-card>
    <q-dialog v-model="productoDialog" persistent position="right" maximized>
      <q-card style="min-width: 300px">
        <q-card-section class="q-pb-none row items-center">
          <div>
            {{ actionPeriodo }} producto
          </div>
          <q-space />
          <q-btn icon="close" flat round dense @click="productoDialog = false" />
        </q-card-section>
        <q-card-section class="q-pt-none">
          <q-form @submit="producto.id ? productoPut() : productoPost()">
            <q-input v-model="producto.name" label="Nombre" dense outlined :rules="[val => !!val || 'Campo requerido']" />
            <q-input v-model="producto.productoname" label="Usuario" dense outlined :rules="[val => !!val || 'Campo requerido']" />
            <q-input v-model="producto.password" label="Contraseña" dense outlined :rules="[val => !!val || 'Campo requerido']" v-if="!producto.id" />
            <div class="text-right" >
              <q-btn color="negative" label="Cancelar" @click="productoDialog = false" no-caps :loading="loading" />
              <q-btn color="primary" label="Guardar" type="submit" no-caps :loading="loading" class="q-ml-sm" />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
  </q-page>
</template>
<script>
import moment from 'moment'
export default {
  name: 'ProductosPage',
  data() {
    return {
      productos: [],
      producto: {},
      productoDialog: false,
      loading: false,
      actionPeriodo: '',
      gestiones: [],
      filter: '',
      columns: [
        { name: 'actions', label: 'Acciones', align: 'center' },
        { name: 'name', label: 'Nombre', align: 'left', field: 'name' },
        { name: 'productoname', label: 'Usuario', align: 'left', field: 'productoname' },
        { name: 'role', label: 'Rol', align: 'left', field: 'role' },
        // { name: 'email', label: 'Email', align: 'left', field: 'email' }
      ],
      permissions: [],
      dialogPermisos: false
    }
  },
  mounted() {
    this.productosGet()
  },
  methods: {
    productoNew() {
      this.producto = {
        name: '',
        email: '',
        password: '',
        area_id: 1,
        productoname: '',
        cargo: '',
        role: 'Vendedor',
      }
      this.actionPeriodo = 'Nuevo'
      this.productoDialog = true
    },
    productosGet() {
      this.loading = true
      this.$axios.get('productos').then(res => {
          // {
          //   "current_page": 1,
          //   "data": [
          //   {
          //     "id": 1,
          //     "medicamento": "Abacavir",
          //     "forma_farmaceutica": "Comprimido",
          //     "concentracion": "300 mg",
          //     "imagen": null,
          //     "precio": "2.89",
          //     "costo": null,
          //     "stock": null,
          //     "activo": null,
          //     "categoria_id": null
          //   },
        this.productos = res.data.data
      }).catch(error => {
        this.$alert.error(error.response.data.message)
      }).finally(() => {
        this.loading = false
      })
    },
    productoPost() {
      this.loading = true
      this.$axios.post('productos', this.producto).then(res => {
        this.productosGet()
        this.productoDialog = false
        this.$alert.success('Periodo creado')
      }).catch(error => {
        this.$alert.error(error.response.data.message)
      }).finally(() => {
        this.loading = false
      })
    },
    productoPut() {
      this.loading = true
      this.$axios.put('productos/' + this.producto.id, this.producto).then(res => {
        this.productosGet()
        this.productoDialog = false
        this.$alert.success('Periodo actualizado')
      }).catch(error => {
        this.$alert.error(error.response.data.message)
      }).finally(() => {
        this.loading = false
      })
    },
    productoEdit(producto) {
      this.producto = { ...producto }
      this.actionPeriodo = 'Editar'
      this.productoDialog = true
    },
    productoDelete(id) {
      this.$alert.dialog('¿Desea eliminar el producto?')
        .onOk(() => {
          this.loading = true
          this.$axios.delete('productos/' + id).then(res => {
            this.productosGet()
            this.$alert.success('Periodo eliminado')
          }).catch(error => {
            this.$alert.error(error.response.data.message)
          }).finally(() => {
            this.loading = false
          })
        })
    }
  }
}
</script>
