<template>
    <div>
        <b-row>
            <b-col>
                <strong>Objednávateľ</strong><br>
                <p>(táto osoba bude uvedená na zmluve, na faktúre, a na potvrdení o absolvovaní tábora )</p>
            </b-col>
        </b-row>
        <b-row>
            <b-col sm="4">
                <b-form-group
                        id="titleFieldset"
                        label="Titul"
                        label-for="title"
                >
                    <b-form-input id="title" v-model="title" trim/>
                </b-form-group>
            </b-col>
            <b-col sm="4">
                <first-name-field
                        id="customerFirstName"
                        :value="$store.state.orderForm.customer.firstName"
                        :setter="setCustomerFirstName"
                />
            </b-col>
            <b-col sm="4">
                <last-name-field
                        id="customerFirstName"
                        :value="$store.state.orderForm.customer.lastName"
                        :setter="setCustomerLastName"
                />
            </b-col>
            <b-col sm="4">
                <b-form-group
                        id="mobileFieldset"
                        label="Telefónne číslo"
                        label-for="mobile"
                        :invalid-feedback="mobileInvalidFeedback"
                        :valid-feedback="mobileValidFeedback"
                        :state="mobileState"
                >
                    <b-form-input id="mobile" type="tel" v-model="mobile" trim/>
                </b-form-group>
            </b-col>
            <b-col sm="4">
                <b-form-group
                        id="emailFieldset"
                        label="Email"
                        label-for="email"
                        :invalid-feedback="emailInvalidFeedback"
                        :valid-feedback="emailValidFeedback"
                        :state="emailState"
                >
                    <b-form-input id="email" type="email" v-model="email" trim/>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <p><strong>Adresa objednávateľa</strong></p>
            </b-col>
        </b-row>
        <b-row>
            <b-col sm="4">
                <b-form-group
                        id="streetNumberFieldset"
                        label="Ulica a číslo domu"
                        label-for="streetNumber"
                        :invalid-feedback="streetNumberInvalidFeedback"
                        :valid-feedback="streetNumberValidFeedback"
                        :state="streetNumberState"
                >
                    <b-form-input id="streetNumber" v-model="streetNumber" trim/>
                </b-form-group>
            </b-col>
            <b-col sm="4">
                <b-form-group
                        id="cityFieldset"
                        label="Mesto/Obec"
                        label-for="city"
                        :invalid-feedback="cityInvalidFeedback"
                        :valid-feedback="cityValidFeedback"
                        :state="cityState"
                >
                    <b-form-input id="city" v-model="city" trim/>
                </b-form-group>
            </b-col>
            <b-col sm="4">
                <b-form-group
                        id="zipCodeFieldset"
                        label="PSČ"
                        label-for="zipCode"
                        :invalid-feedback="zipCodeInvalidFeedback"
                        :valid-feedback="zipCodeValidFeedback"
                        :state="zipCodeState"
                >
                    <b-form-input id="zipCode" v-model="zipCode" trim/>
                </b-form-group>
            </b-col>
        </b-row>
    </div>
</template>

<script>
  import FirstNameField from './FormFields/FirstNameField';
  import LastNameField from './FormFields/LastNameField';
  import _ from 'lodash';

  export default {
    name: 'customer-form',
    components: {FirstNameField, LastNameField},
    computed: {
      title: {
        get() {
          return this.$store.state.orderForm.customer.title;
        },
        set(value) {
          let newCustomerData = {...this.$store.state.orderForm.customer};
          newCustomerData.title = _.capitalize(value);
          this.$store.commit('orderForm/updateCustomer', newCustomerData)
        }
      },
      mobile: {
        get() {
          return this.$store.state.orderForm.customer.mobile;
        },
        set(value) {
          let newCustomerData = {...this.$store.state.orderForm.customer};
          newCustomerData.mobile = value;
          this.$store.commit('orderForm/updateCustomer', newCustomerData)
        }
      },
      mobileInvalidFeedback() {
        if (this.$store.state.orderForm.customer.mobile.length > 1) {
          return ''
        } /*else if (this.$store.state.orderForm.customer.mobile.length > 0) {
          return 'Nesprávny formát telefónu'
        }*/ else {
          return 'Povinné pole'
        }
      },
      mobileValidFeedback() {
        return this.mobileState === true ? '✓' : ''
      },
      mobileState() {
        return this.$store.state.orderForm.customer.mobile.length >= 1
      },
      email: {
        get() {
          return this.$store.state.orderForm.customer.email;
        },
        set(value) {
          let newCustomerData = {...this.$store.state.orderForm.customer};
          newCustomerData.email = value;
          this.$store.commit('orderForm/updateCustomer', newCustomerData)
        }
      },
      emailInvalidFeedback() {
        if (this.$store.state.orderForm.customer.email.length > 1) {
          return ''
        } /*else if (this.$store.state.orderForm.customer.email.length > 0) {
          return 'Nesprávny formát email adresy'
        }*/ else {
          return 'Povinné pole'
        }
      },
      emailValidFeedback() {
        return this.emailState === true ? '✓' : ''
      },
      emailState() {
        return this.$store.state.orderForm.customer.email.length >= 1
      },
      streetNumber: {
        get() {
          return this.$store.state.orderForm.customer.address.streetNumber;
        },
        set(value) {
          let newCustomerData = {...this.$store.state.orderForm.customer};
          newCustomerData.address.streetNumber = _.capitalize(value);
          this.$store.commit('orderForm/updateCustomer', newCustomerData)
        }
      },
      streetNumberInvalidFeedback() {
        if (this.$store.state.orderForm.customer.address.streetNumber.length > 1) {
          return ''
        } /*else if (this.$store.state.orderForm.customer.address.streetNumber.length > 0) {
          return 'Nesprávny formát adresy'
        }*/ else {
          return 'Povinné pole'
        }
      },
      streetNumberValidFeedback() {
        return this.streetNumberState === true ? '✓' : ''
      },
      streetNumberState() {
        return this.$store.state.orderForm.customer.address.streetNumber.length >= 1
      },
      city: {
        get() {
          return this.$store.state.orderForm.customer.address.city;
        },
        set(value) {
          let newCustomerData = {...this.$store.state.orderForm.customer};
          newCustomerData.address.city = _.capitalize(value);
          this.$store.commit('orderForm/updateCustomer', newCustomerData)
        }
      },
      cityInvalidFeedback() {
        if (this.$store.state.orderForm.customer.address.city.length > 1) {
          return ''
        } /*else if (this.$store.state.orderForm.customer.address.city.length > 0) {
          return 'Nesprávny formát názvu mesta'
        }*/ else {
          return 'Povinné pole'
        }
      },
      cityValidFeedback() {
        return this.cityState === true ? '✓' : ''
      },
      cityState() {
        return this.$store.state.orderForm.customer.address.city.length >= 1
      },
      zipCode: {
        get() {
          return this.$store.state.orderForm.customer.address.zipCode;
        },
        set(value) {
          let newCustomerData = {...this.$store.state.orderForm.customer};
          newCustomerData.address.zipCode = value;
          this.$store.commit('orderForm/updateCustomer', newCustomerData)
        }
      },
      zipCodeInvalidFeedback() {
        if (this.$store.state.orderForm.customer.address.zipCode.length > 1) {
          return ''
        }/* else if (this.$store.state.orderForm.customer.address.zipCode.length > 0) {
          return 'Nesprávny formát poštového čísla'
        }*/ else {
          return 'Povinné pole'
        }
      },
      zipCodeValidFeedback() {
        return this.zipCodeState === true ? '✓' : ''
      },
      zipCodeState() {
        return this.$store.state.orderForm.customer.address.zipCode.length >= 1
      },
    },
    methods: {
      required(value) {
        if (value.length > 0) {
          return ''
        } else {
          return 'Please enter something'
        }
      },
      setCustomerFirstName(value) {
        let newCustomerData = {...this.$store.state.orderForm.customer};
        newCustomerData.firstName = _.capitalize(value);
        this.$store.commit('orderForm/updateCustomer', newCustomerData)
      },
      setCustomerLastName(value) {
        let newCustomerData = {...this.$store.state.orderForm.customer};
        newCustomerData.lastName = _.capitalize(value);
        this.$store.commit('orderForm/updateCustomer', newCustomerData)
      },
    }

  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
