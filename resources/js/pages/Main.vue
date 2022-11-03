<template>
  <div class="container-loader" v-show="loader">

    <svg class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340">
      <circle cx="170" cy="170" r="160" stroke="#E2007C"/>
      <circle cx="170" cy="170" r="135" stroke="#404041"/>
      <circle cx="170" cy="170" r="110" stroke="#E2007C"/>
      <circle cx="170" cy="170" r="85" stroke="#404041"/>
    </svg>

  </div>
  <div v-show="!loader">
    <nav class="navbar navbar-expand-md navbar-light bg-secondary shadow-sm">
      <div class="container">
        <router-link class="navbar-brand text-white font-weight-bolder" to="/"><strong>Advance Stream Stats</strong></router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
          <ul class="navbar-nav me-auto">

          </ul>

        
          <ul class="navbar-nav ms-auto">
          
            <template v-if="isLoggedIn">
              <li class="nav-item" >
                <a class="nav-link text-white" href="javascript:void(0)" ><strong>{{loggedUser?.name}}</strong></a>
              </li>

              <li class="nav-item" >
                <router-link class="nav-link text-white" to="/"><strong>Home</strong></router-link>
              </li>

              <li class="nav-item" >
                <router-link class="nav-link text-white" to="/manage-subscriptions"><strong>Subscriptions</strong></router-link>
              </li>

              <li class="nav-item" >
                <a class="nav-link text-white" href="javascript:void(0)" @click="logout()"><strong>Logout</strong></a>
              </li>
            </template>


            <template v-else>
              <li class="nav-item">
                <router-link class="nav-link text-white" to="/auth/login"><strong>Login</strong></router-link>
              </li>



              <li class="nav-item">
                <router-link class="nav-link text-white" to="/auth/register"><strong>Register</strong></router-link>
              </li>
            </template>


          </ul>
        </div>
      </div>
    </nav>
    <main class="py-4">
      <router-view></router-view>
    </main>

  </div>

  </template>
  
  <script>
  import Auth from "../Auth";
  import { mapState } from 'vuex'
  export default {
    data() {
      return {
        loggedUser: this.auth.user
      };
    },
    mounted() {

    },
    computed:{
      ...mapState(['isLoggedIn','loader']),
    },
    methods: {
      logout() {
        localStorage.clear()
        this.makeRequest('post','/api/logout')
            .then((res) => {
              if(!res.error){
                this.$store.dispatch('setLoggedIn',false)
                Auth.logout(); //reset local storage
                this.$router.push('/auth/login');
              }
            });
      }
    }
  }
  </script>
  
  