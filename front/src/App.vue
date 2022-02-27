<template>
    <div id="app">
        <b-container>
            <b-row align-h="start">
                <b-col>
                    <b-form-group
                            id="tripFieldset"
                            description="Vyberte si turnus."
                            label="Termíny detské tábory SMAJLOVO"
                            label-for="trip"
                    >
                        <b-form-select id="trip" v-model="selectedTrip"
                                       :options="$store.state.orderForm.trip.options" />
                    </b-form-group>
                </b-col>
            </b-row>
        </b-container>
        <b-container v-if="selectedTrip">
            <customer-form />
            <b-row>
                <b-col>
                    <strong>Údaje o dieťati</strong>
                </b-col>
            </b-row>
            <ChildForm index="0" />
            <template v-if="anotherKid">
                <b-row>
                    <b-col>
                        <strong>Ďalšie dieťa - súrodenec</strong>
                    </b-col>
                </b-row>
                <ChildForm index="1" />
                <b-row>
                    <b-col>
                        <p>„Súrodenecká zľava za 2 deti: {{ getTripData(selectedTrip).siblingDiscount }} €/dieťa (spolu {{ getTripData(selectedTrip).siblingDiscount * 2 }} €)“.</p>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col>
                        <b-button :variant="'danger'" @click="removeAnotherKid">
                            <b-icon-x />
                            Odobrať súrodenca
                        </b-button>
                    </b-col>
                </b-row>
            </template>
            <b-row v-else>
                <b-col>
                    <b-button :variant="'success'" @click="addAnotherKid">
                        <b-icon-plus />
                        Pridať súrodenca
                    </b-button>
                </b-col>
            </b-row>
            <b-row class="margin-top-primary">
                <b-col>
                    <b-form-group
                            id="notesFieldset"
                            label="Poznámky"
                            label-for="notes"
                    >
                        <b-form-textarea
                                id="textarea"
                                v-model="notes"
                                placeholder="lieky, diéta, potvrdenie o absolvovaní tábora, iný spôsob úhrady, ..."
                                rows="3"
                                max-rows="6"
                        />
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <strong>Doprava (vyberte jednu z možností)</strong>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-form-radio v-model="transportation" name="transportation" value="individual">individuálna
                        doprava
                    </b-form-radio>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-form-radio v-model="transportation" name="transportation" value="group">spoločná doprava
                        (príplatok {{ getTripData(selectedTrip).groupTransportFee }} €/dieťa)
                    </b-form-radio>
                </b-col>
                <b-col v-if="transportation === 'group'">
                    <b-form-group
                            id="groupTransportFieldset"
                            label="miesto nástupu"
                            label-for="groupTransport"
                            label-align="right"
                            label-cols-sm="6"
                    >
                        <b-form-select id="groupTransport" v-model="selectedGroupTransport"
                                       :options="$store.state.orderForm.groupTransport.options" />
                    </b-form-group>
                </b-col>
            </b-row>

            <b-row class="margin-top-primary">
                <b-col>
                    <strong>Celková cena spolu</strong>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-alert :show="true" :variant="'dark'">{{ totalPrice }} EUR</b-alert>
                </b-col>
            </b-row>

            <b-row class="margin-top-half">
                <b-col>
                    <b-link href="https://www.smajlovo.sk/files/download/pdf/zasady_spracovania_osobnych_udajov.pdf"
                            target="_blank"
                    >
                        Oboznámil(a) som sa s informáciami o spracovaní osobných údajov.
                    </b-link>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-link href="https://smajlovo.sk/files/download/pdf/vseobecne_podmienky_poskytovania_sluzieb_smajlovo.pdf"
                            target="_blank"
                    >
                        Oboznámil(a) som sa so Všeobecnými podmienkami poskytovania služieb.
                    </b-link>
                </b-col>
            </b-row>
            <b-row class="margin-top-half">
                <b-col>
                    <b-form-checkbox
                            id="gdprConsent"
                            v-model="gdprConsent"
                            name="gdprConsent"
                            :value="true"
                            :unchecked-value="false"
                    >
                        Súhlasím so spracovaním osobných údajov
                    </b-form-checkbox>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-form-checkbox
                            id="termsAndConditionsConsent"
                            v-model="termsAndConditionsConsent"
                            name="termsAndConditionsConsent"
                            :value="true"
                            :unchecked-value="false"
                    >
                        Súhlasím so Všeobecnými podmienkami poskytovania služieb
                    </b-form-checkbox>
                </b-col>
            </b-row>

            <b-row class="margin-top-half">
                <b-col>
                    Po odoslaní objednávky Vám budú na Vašu emailovú adresu odoslané dva e-maily s dokumentmi<br>
                </b-col>
            </b-row>
            <b-row class="margin-top-half">
                <b-col>
                    <b-button @click="clickOnSubmit" :disabled="!canBeSubmitted" :variant="'warning'" style="width: 100%"
                              size="lg">OBJEDNAŤ
                    </b-button>
                </b-col>
            </b-row>
        </b-container>
        <b-modal ref="my-modal" hide-footer hide-header>
            <div class="d-block text-center">
                <div v-if="!responseReceived">
                <h3>Spracovávame...</h3>
                    <b-spinner
                            :variant="'success'"
                            type="grow"
                    />
                    <b-spinner
                            :variant="'warning'"
                    />
                    <b-spinner
                            :variant="'success'"
                            type="grow"
                    />
                </div>
                <div v-else-if="responseReceived===200">
                    <h3>Vaša objednávka bola spracovaná!</h3>
                    <h4>Skontrolujte si svoj e-mail.</h4>
                    <b-icon :style="{ width: '10em', height: '10em' }" icon="check-circle" :variant="'success'" />
                </div>
                <div v-else>
                    <h3>Akcia sa nepodarila</h3>
                    <h4>Prosím kontaktujte nás na smajlovo@smajlovo.sk</h4>
                    <b-icon :style="{ width: '10em', height: '10em' }" icon="wrench" :variant="'danger'" />
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
  import store from './store/index.js';
  import CustomerForm from "./components/CustomerForm";
  import ChildForm from "./components/ChildForm";
  import { BIconPlus, BIconX } from 'bootstrap-vue';
  import { mapActions, mapGetters, mapState } from 'vuex';
  import _ from 'lodash';

  export default {
    name: 'app',
    components: {
      ChildForm,
      CustomerForm,
      BIconPlus, BIconX,
    },
    store,
    methods: {
      addAnotherKid() {
        this.anotherKid = true;
      },
      removeAnotherKid() {
        this.anotherKid = false;
      },
      ...mapActions('orderForm', [
        'fetchFormData',
        'submitForm'
      ]),
      toggleModal() {
        this.$refs['my-modal'].toggle('#toggle-btn');
      },
      clickOnSubmit() {
        this.toggleModal();
        this.submitForm();
      }
    },
    computed: {
      selectedTrip: {
        get() {
          return this.$store.state.orderForm.trip.selected;
        },
        set(value) {
          this.$store.commit('orderForm/selectTrip', value)
        }
      },
      anotherKid: {
        get() {
          return this.$store.state.orderForm.anotherKid;
        },
        set(value) {
          this.$store.commit('orderForm/updateAnotherKid', value)
        }
      },
      notes: {
        get() {
          return this.$store.state.orderForm.notes;
        },
        set(value) {
          this.$store.commit('orderForm/updateNotes', _.capitalize(value))
        }
      },
      transportation: {
        get() {
          return this.$store.state.orderForm.transportation;
        },
        set(value) {
          this.$store.commit('orderForm/updateTransportation', value)
        }
      },
      selectedGroupTransport: {
        get() {
          return this.$store.state.orderForm.groupTransport.selected;
        },
        set(value) {
          this.$store.commit('orderForm/selectGroupTransport', value)
        }
      },
      gdprConsent: {
        get() {
          return this.$store.state.orderForm.gdprConsent;
        },
        set(value) {
          this.$store.commit('orderForm/updateGdprConsent', value)
        }
      },
      termsAndConditionsConsent: {
        get() {
          return this.$store.state.orderForm.termsAndConditionsConsent;
        },
        set(value) {
          this.$store.commit('orderForm/updateTermsAndConditionsConsent', value)
        }
      },
      ...mapGetters('orderForm', [
        'totalPrice',
        'getTripData',
        'canBeSubmitted',
      ]),
      ...mapState('orderForm', [
        'responseReceived',
      ])
    },

    created() {
      this.fetchFormData();
    }
  }
</script>

<style>
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #2c3e50;
        margin-top: 60px;
    }

    .margin-top-primary {
        margin-top: 60px;
    }

    .margin-top-half {
        margin-top: 30px;
    }
</style>
