<template>
  <q-page class="q-pa-md">
    <q-card flat bordered>
      <q-card-section>
        <q-form @submit.prevent="productosGet">
          <div class="row">
            <div class="col-8 col-md-3">
              <q-input v-model="filter" label="Buscar" outlined dense clearable>
                <template v-slot:prepend>
                  <q-icon name="search" />
                </template>
              </q-input>
            </div>
            <div class="col-4 col-md-2 flex flex-center">
              <q-btn color="primary" label="Buscar" type="submit" no-caps icon="search" :loading="loading" />
            </div>
            <div class="col-12 col-md-7 text-right">
              <q-btn color="positive" label="Nuevo" @click="productoNew" no-caps icon="add_circle_outline" :loading="loading" />
            </div>
          </div>
        </q-form>

        <div class="row">
          <div class="col-12 flex flex-center">
            <q-pagination
              v-if="totalPages > 1"
              v-model="currentPage"
              :max="totalPages"
              :max-pages="5"
              boundary-numbers
              color="black"
              @update:model-value="productosGet"
            />
          </div>
        </div>

        <q-markup-table dense wrap-cells flat bordered>
          <thead class="bg-black text-white">
          <tr>
            <td>Opciones</td>
            <td>Medicamento</td>
            <td>Forma Farmacéutica</td>
            <td>Concentración</td>
            <td>Precio</td>
            <td>Stock</td>
          </tr>
          </thead>
          <tbody>
          <tr v-for="producto in productos" :key="producto.id">
            <td>
              <q-btn-dropdown dense size="10px" label="Opciones" no-caps dropdown-icon="more_vert" color="orange" :loading="loading">
                <q-list>
                  <q-item clickable v-ripple @click="productoEdit(producto)" v-close-popup>
                    <q-item-section>Editar</q-item-section>
                  </q-item>
                  <q-item clickable v-ripple @click="productoDelete(producto.id)" v-close-popup>
                    <q-item-section>Eliminar</q-item-section>
                  </q-item>
                </q-list>
              </q-btn-dropdown>
            </td>
            <td>{{ producto.medicamento }}</td>
            <td>{{ producto.forma_farmaceutica }}</td>
            <td>{{ producto.concentracion }}</td>
            <td>{{ producto.precio }}</td>
            <td>{{ producto.stock }}</td>
          </tr>
          </tbody>
        </q-markup-table>
      </q-card-section>
    </q-card>
    <q-dialog v-model="productoDialog" persistent position="right" maximized>
      <q-card style="min-width: 300px">
        <q-card-section class="q-pb-none row items-center">
          <div class="text-bold text-sub">
            {{ actionProducto }} Producto
          </div>
          <q-space />
          <q-btn icon="close" flat round dense @click="productoDialog = false" />
        </q-card-section>
        <q-card-section>
          <q-form @submit.prevent="producto.id ? productoPut() : productoPost()">
            <q-input v-model="producto.medicamento" label="Medicamento" dense outlined :rules="[val => !!val || 'Campo requerido']"  hint=""/>
<!--            <q-input v-model="producto.forma_farmaceutica" label="Forma Farmacéutica" dense outlined :rules="[val => !!val || 'Campo requerido']"  hint=""/>-->
            <q-select v-model="producto.forma_farmaceutica" label="Forma Farmacéutica" dense outlined :rules="[val => !!val || 'Campo requerido']"  :options="formas_farmaceutica"  hint=""/>
            <q-input v-model="producto.concentracion" label="Concentración" dense outlined  hint=""/>
            <q-input v-model="producto.precio" label="Precio" dense outlined type="number"  hint=""/>
            <q-input v-model="producto.stock" label="Stock" dense outlined type="number"  hint=""/>

            <div class="text-right">
              <q-btn color="negative" label="Cancelar" @click="productoDialog = false" no-caps :loading="loading" />
              <q-btn color="primary" label="Guardar" type="submit" no-caps class="q-ml-sm" :loading="loading" />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
export default {
  name: "ProductosPage",
  data() {
    return {
      productos: [],
      producto: {},
      productoDialog: false,
      loading: false,
      actionProducto: '',
      filter: '',
      totalPages: 1,
      currentPage: 1,
      formas_farmaceutica:[
      'Aerosol',
      'Cápsula',
      'Cápsula blanda',
      'Cápsula o Comprimido',
      'Cápsula o Perla',
      'Cartucho dental',
      'Comprimido',
      'Comprimido o Cápsula',
      'Comprimido o Cápsula blanda',
      'Comprimido ranurado',
      'Comprimido recubierto',
      'Comprimido sublingual',
      'Comprimido vaginal',
      'Crema a Pomada',
      'Crema dérmica',
      'Crema o Pomada',
      'Crema o Pomada oftálmica',
      'Crema vaginal',
      'Crema, Pomada o Gel',
      'Emulsión dermica',
      'Emulsión inyectable',
      'Emulsión oral',
      'Gas',
      'Gel',
      'Gel o Jalea',
      'Gel o Pasta',
      'Gotas',
      'Gotas óticas',
      'Granulado',
      'Implante subdérmico',
      'Inyectable',
      'Jarabe',
      'Jarabe o Solución Oral',
      'Loción',
      'Óvulo',
      'Pasta 1 kg',
      'Pasta o Pomada',
      'Plegable Frasco Vial',
      'Polvo',
      'Polvo liofilizado',
      'Polvo o granulado',
      'Polvo para enema',
      'Polvo para inyectable',
      'Polvo para solución oral',
      'Polvo, pasta o Granulado según disponibilidad',
      'Pomada o Gel',
      'Sobres',
      'Solución',
      'Solución 1 l',
      'Solución acuosa',
      'Solución hidroalcohólica',
      'Solución nasal',
      'Solución o Loción',
      'Solución oftálmica',
      'Solución oral',
      'Solución oral gotas',
      'Solución para atomización',
      'Solución para gotas orales',
      'Solución para nebulización',
      'Solución parenteral',
      'Solución parenteral de gran volúmen',
      'Solución tópica',
      'Supositorio',
      'Suspensión',
      'Suspensión o Jarabe',
      'Suspensión oral',
      'Ungüento o crema',
      'Ungüento o Pomada oftálmica',
      'Ungüento oftálmico',
      ]
    };
  },
  mounted() {
    this.productosGet();
  },
  methods: {
    productoNew() {
      this.producto = {
        medicamento: '',
        forma_farmaceutica: '',
        concentracion: '',
        precio: 0,
        stock: 0,
        imagen: null, // Valor por defecto
        categoria_id: null // Valor por defecto
      };
      this.actionProducto = "Nuevo";
      this.productoDialog = true;
    },
    productosGet() {
      this.loading = true;
      this.$axios
        .get("productos", {
          params: {
            filter: this.filter,
            page: this.currentPage
          }
        })
        .then(res => {
          this.productos = res.data.data;
          this.totalPages = res.data.last_page;
        })
        .catch(error => {
          this.$alert.error(error.response?.data?.message || "Error al cargar productos");
        })
        .finally(() => {
          this.loading = false;
        });
    },
    productoPost() {
      this.loading = true;
      this.$axios
        .post("productos", this.producto)
        .then(() => {
          this.productoDialog = false;
          this.productosGet();
          this.$alert.success("Producto creado correctamente");
        })
        .catch(error => {
          this.$alert.error(error.response?.data?.message || "Error al crear producto");
        })
        .finally(() => {
          // this.loading = false;
        });
    },
    productoPut() {
      this.loading = true;
      this.$axios
        .put(`productos/${this.producto.id}`, this.producto)
        .then(() => {
          this.productoDialog = false;
          this.productosGet();
          this.$alert.success("Producto actualizado correctamente");
        })
        .catch(error => {
          this.$alert.error(error.response?.data?.message || "Error al actualizar producto");
        })
        .finally(() => {
          this.loading = false;
        });
    },
    productoEdit(producto) {
      this.producto = { ...producto };
      this.actionProducto = "Editar";
      this.productoDialog = true;
    },
    productoDelete(id) {
      this.$alert
        .dialog("¿Desea eliminar el producto?")
        .onOk(() => {
          this.loading = true;
          this.$axios
            .delete(`productos/${id}`)
            .then(() => {
              this.productosGet();
              this.$alert.success("Producto eliminado correctamente");
            })
            .catch(error => {
              this.$alert.error(error.response?.data?.message || "Error al eliminar producto");
            })
            .finally(() => {
              this.loading = false;
            });
        });
    }
  }
};
</script>
