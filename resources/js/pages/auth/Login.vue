<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form >
                      <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                        <div class="col-md-6">
                          <input id="email" type="email" class="form-control   " name="email" v-model="user.email" required autocomplete="email" autofocus>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                        <div class="col-md-6">
                          <input id="password" type="password" v-model="user.password" class="form-control " name="password"  required >
                        </div>
                      </div>
                      <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                          <button type="button" @click="login" class="btn btn-primary">
                            Login
                          </button>



                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import Auth from "../../Auth";

export default {
  mounted(){
    localStorage.clear()
  },
  data() {
    return {
      user: {
        email: '',
        password: '',
      }
    };
  },

  methods: {
    login() {
      this.makeRequest('post','/api/login', this.user)
          .then((res) => {
            if(!res.error){
              Auth.login(  res.response.data.access_token,  res.response.data.data);
              this.$store.dispatch('setLoggedIn',true)
              this.$router.push('/');
            }

          })
    }
  }
}
</script>