<template>
  <header class="text-center mb-5 mt-5 text-white">
    <div class="row">
      <div class="col-lg-7 mx-auto">
        <h1>Manage Subscriptions</h1>

      </div>
    </div>
  </header>
  <div class="container bg-white p-5 rounded-lg shadow">
    <h2 class="mb-5">My Subscriptions</h2>

    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th>#</th>
          <th>Plan Name</th>
          <th>Payment Method</th>
          <th>Price Paid</th>
          <th>Status</th>
          <th>Ends At</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item,index) in subscriptions">
            <td>{{index+1}}</td>
            <td>{{item.plan?.name}}</td>
            <td class="text-primary"><strong>{{item.payment_method}}</strong></td>
            <td class=" text-success"><strong>{{item.plan?.currency +item.cost}}</strong></td>
            <td><strong>{{item.status}}</strong></td>
            <td class="text-danger"><span>{{new Date(item.ends_at).toDateString()}}</span></td>
          <td><button @click="cancelSubscription(item.braintree_subscription_id)" v-if="item.status == 'ACTIVE'" type="button" class="btn btn-secondary btn-sm">Cancel</button></td>
        </tr>
        <tr v-if="subscriptions.length == 0" ><strong>No Data Avaliable</strong></tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
export default {
  mounted() {
    this.getUserSubscriptions()
  },
  data(){
    return{
      subscriptions:[]
    }
  },
  methods:{
    cancelSubscription(subId){
      this.makeRequest('post','api/cancel-subscription',{subscription_id:subId}).then((res)=>{
        if(!res.error){
          this.getUserSubscriptions()
        }
      })
    },
    getUserSubscriptions(){
      this.makeRequest('post','api/get-user-subscription',{}).then((res)=>{
        if(!res.error){
          this.subscriptions = res.response.data.data
        }
      })
    }
  }
}
</script>