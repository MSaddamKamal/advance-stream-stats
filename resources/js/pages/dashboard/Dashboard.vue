<template>
  <section>
    <div class="container py-5">
      <header class="text-center mb-5 text-white">
        <div class="row">
          <div class="col-lg-7 mx-auto">
            <h1>Live Stats</h1>
            <p></p>
          </div>
        </div>
      </header>
      <div class="row text-center mb-5 justify-content-center">
        <div class="col-sm-3 mb-5 mb-lg-0" v-for="(item,index) in stats">
          <div class="bg-white p-5 rounded-lg shadow">
            <h1 class="h6 text-uppercase font-weight-bold mb-4">{{ item.title }}</h1>
            <h2 class="h1 font-weight-bold">{{ item.statistics }}</h2>
            <div class="custom-separator my-4 mx-auto bg-success"></div>
          </div>
        </div>
      </div>

      <header class="text-center mb-5 mt-5 text-white">
        <div class="row">
          <div class="col-lg-7 mx-auto">
            <h1>Advance Stream Stats Plans</h1>
            <p>Subscribe to one of the plan below to enjoy access to stats</p>
          </div>
        </div>
      </header>
      <div v-show="!initialize" class="row text-center justify-content-center">
        <div class="col-lg-4 mb-5 mb-lg-0" v-for="(item,index) in plans" :key="index">
          <div class="bg-white p-5 rounded-lg shadow">
            <h1 class="h6 text-uppercase font-weight-bold mb-4">{{ item.name }}</h1>
            <h2 class="h1 font-weight-bold">${{ item.price }}<span class="text-small font-weight-normal ml-2">/
                                {{ item.monthly_billing_frequency == 1 ? 'month' : 'year' }}</span></h2>
            <div class="custom-separator my-4 mx-auto bg-primary"></div>
            <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
              <li class="mb-3">
                <i class="fa fa-check mr-2 text-primary"></i> Lorem ipsum dolor sit amet
              </li>
              <li class="mb-3">
                <i class="fa fa-check mr-2 text-primary"></i> iuionnm daaa nnrnwer
              </li>
              <li class="mb-3 text-muted" v-if="item.monthly_billing_frequency == 1">
                <i class="fa fa-times mr-2"></i>
                <del class="text-danger">Sed ut perspiciatis</del>
              </li>
              <li class="mb-3" v-else>
                <i class="fa fa-check mr-2 text-primary"></i> Sed ut perspiciatis
              </li>
              <li class="mb-3">
                <i class="fa fa-check mr-2 text-primary"></i> At vero eos et accusamus
              </li>
              <li class="mb-3">
                <i class="fa fa-check mr-2 text-primary"></i> Nam libero tempore
              </li>
              <li class="mb-3">
                <i class="fa fa-check mr-2 text-primary"></i> iuionmpodasdkn ipu jkj
              </li>
            </ul>
            <a v-if="!item.subscribed" href="javascript:void(0)" @click="subscribe(item)"
               class="btn btn-primary btn-block p-2 shadow rounded-pill">Subscribe</a>
            <h2 v-else class="text-success"><strong>Already Subscribed</strong></h2>
          </div>
        </div>
        <!-- END -->

      </div>
      <BrantreeDropIn
          wrapperClass="constrain"
          v-show="initialize"
          :collectCardHolderName="true"
          :enableDataCollector="true"
          :enablePayPal="true"
          @hide="initialize = false"
          @nonce="getNonce"
      >
      </BrantreeDropIn>
    </div>
  </section>

</template>
<script>
import BrantreeDropIn from '../../components/BrantreeDropIn.vue'

export default {
  components: {
    BrantreeDropIn
  },
  mounted() {
    this.getAllPlans()
    this.getAllStats()
  },
  data() {
    return {
      initialize: false,
      plans: [],
      stats: [],
      selectedPlan: {}
    }
  },
  methods: {
    subscribe(item) {
      this.initialize = true
      this.selectedPlan = item
    },
    getNonce(nonce) {
      this.makeRequest('post', 'api/process-payment', {
        payment_method_nonce: nonce,
        plan_id: this.selectedPlan.braintree_plan_id
      }).then((res) => {
        if (!res.error) {
          this.$router.push({name: 'subscriptions'})
        }
      })
    },
    getAllPlans() {
      this.makeRequest('post', 'api/get-all-plans', {}, {}, false).then((res) => {
        if (!res.error) {
          this.plans = res.response.data.data
        }

      })
    },
    getAllStats() {
      this.makeRequest('post', 'api/get-stats', {}, {}, false).then((res) => {
        if (!res.error) {
          this.stats = res.response.data.data
        }
      })
    },
  }

}
</script>
