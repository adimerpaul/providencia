<template>
  <q-layout class="bgLogin">
    <q-page-container>
      <q-page>
        <div class="row">
          <div class="col-12 col-md-6 q-pa-lg" style="background: rgba(255,255,255,0.75);height: 100vh;backdrop-filter: blur(17px);">
            <div class="row flex flex-center">
              <div class="col-12 text-center">
                <q-img src="logo.png" class="q-ma-md" width="150px"/>
              </div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-8 text-h6 text-bold">
                Iniciar sesión
              </div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-8 text-subtitle">
                Accede al panel de Administración usando tus credenciales.
              </div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-8 text-subtitle q-pt-md">
                Nombre de usuario
                <q-input v-model="username" outlined dense placeholder="Nombre de usuario"
                         bg-color="white"
                >
                  <template v-slot:append>
                    <q-icon name="account_circle" size="xs" />
                  </template>
                </q-input>
              </div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-8 text-subtitle q-pt-md">
                Contraseña
                <q-input v-model="password" outlined dense placeholder="Contraseña" :type="showPassword ? 'text' : 'password'">
                  <template v-slot:append>
                    <q-icon :name="showPassword ? 'visibility' : 'visibility_off'" @click="showPassword = !showPassword" size="xs" />
                  </template>
                </q-input>
              </div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-8 q-pt-xs row items-center">
                <q-checkbox v-model="rememberMe" label="Recuérdame" color="primary" />
                <q-space />
                <q-btn flat dense label="¿Has olvidado tu contraseña?" color="red" no-caps class="text-bold" />
              </div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-8 text-subtitle q-pt-md">
                <q-btn color="primary" label="Iniciar sesión" dense class="full-width btnLogin" no-caps unelevated size="18px" :loading="loading" />
              </div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-8 text-subtitle q-pt-md">
                Eres un usuario nuevo? <q-btn flat dense label="Regístrate" color="black" class="text-bold" no-caps  />
              </div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-2"></div>
              <div class="col-12 col-md-8 text-subtitle q-pt-lg">
                <q-separator />
                Copyright © {{ new Date().getFullYear() }} Providencia. Todos los derechos reservados.
              </div>
              <div class="col-12 col-md-2"></div>
            </div>
          </div>
        </div>
      </q-page>
    </q-page-container>
  </q-layout>
</template>
<script setup>
import { ref } from 'vue'
const username = ref('')
const password = ref('')
const showPassword = ref(false)
const rememberMe = ref(false)
const loading = ref(false)

</script>
<style scoped>
.bgLogin {
  background-image: url('./../bg.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  height: 100vh;
}
.btnLogin:hover {
  background-color: #fff !important;
  color: var(--q-primary) !important;
  outline: 1px solid var(--q-primary) !important;
  transition: all 0.3s ease-in-out;
}
</style>
