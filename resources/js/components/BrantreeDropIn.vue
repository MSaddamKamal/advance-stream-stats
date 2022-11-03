<template>
    <div :class="wrapperClass">

      <div id="dropin-container"></div>
      <div class="row mt-2 " >

        <div class="col-12 justify-content-center d-flex" >
          <button  type="button" class="btn btn-warning "  @click="dropinRequestPaymentMethod">Pay</button>
          <button type="button" class="mx-2 btn btn-secondary" @click="$emit('hide')"  >Subscribe Other Plan</button>
        </div>



      </div>

    </div>
  </template>
  
  <script>
    import dropin from "braintree-web-drop-in";

    export default {
      props: {

        wrapperClass: {
          value: String,
        },
        loaderClass: {
          value: String,
        },
        inputClass: {
          value: String,
        },
        collectCardHolderName: {
          value: Boolean,
        },
        collectPostalCode: {
          value: Boolean,
        },
        enableDataCollector: {
          value: Boolean,
        },
        enablePayPal: {
          value: Boolean,
        },
      },
      mounted() {
        this.dropinCreate();
        
        // this.$parent.$on('tokenize', () => {
        //   this.dropinRequestPaymentMethod();
        // });
      },
      data () {
        return {
          errorMessage: '',
          dropinInstance: '',
          paymentPayload: '',
          dataCollectorPayload: '',
        }
      },
      methods: {
        dropinCreate() {
          axios.post('api/get-token',{}).then((res)=>{
            const dropin = require('braintree-web-drop-in');

            // setup drop-in options
            const dropinOptions = {
              authorization: res.data.data.token,
              selector: '#dropin-container',
            }

            // if PayPal enabled, add to options settings
            if (this.enablePayPal) {
              dropinOptions.paypal = {
                flow: 'vault'
              };
            }

            dropin.create(dropinOptions, (dropinError, dropinInstance) => {
              if (dropinError) {
                this.errorMessage = 'There was an error setting up the client instance. Message: ' + dropinError.message;
                this.$emit('bt.error', this.errorMessage);
                return;
              }

              this.dropinInstance = dropinInstance;
            });
          },(err)=>{
            console.log(err)
          })
          return

        },
        dropinRequestPaymentMethod() {
          this.dropinInstance.requestPaymentMethod((requestErr, payload) => {
            
            if (requestErr) {
              this.errorMessage = 'There was an error setting up the client instance. Message: ' + requestErr.message;
              this.$emit('bt.error', this.errorMessage);
              return;
            }
  
            this.paymentPayload = payload;
            this.$emit('nonce',this.paymentPayload)


          });
        },
      },

    };
  </script>
  