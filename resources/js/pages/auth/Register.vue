

<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Register</div>

          <div class="card-body">
            <form >

              <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                <div class="col-md-6">
                  <input id="name" type="input" class="form-control " name="name" v-model="user.name" required >
                </div>
              </div>

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
              <div class="row mb-3">
                <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                <div class="col-md-6">
                  <input id="password_confirmation" type="password" v-model="user.password_confirmation" class="form-control " name="password_confirmation"  required >
                </div>
              </div>


              <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="button" @click="register" class="btn btn-primary">
                    SignUp
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
export default {
  data() {
    return {
      user: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    };
  },

  methods: {
    register() {
      this.makeRequest('post','/api/register', this.user)
          .then((res) => {
            if(!res.error){
              this.$router.push('/auth/login');
            }
          });
    }
  }
}
</script>