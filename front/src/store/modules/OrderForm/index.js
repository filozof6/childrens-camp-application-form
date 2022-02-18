import axios from 'axios';
import _ from 'lodash';

// initial state
const state = {
  trip: {
    selected: null,
    options: []
  },
  customer: {
    title: '',
    firstName: '',
    lastName: '',
    mobile: '',
    email: '',
    address: {
      streetNumber: '',
      city: '',
      zipCode: '',
    }
  },
  children: {
    "0": {
      firstName: '',
      lastName: '',
      dateOfBirth: '',
    },
    "1": {
      firstName: '',
      lastName: '',
      dateOfBirth: '',
    }
  },
  anotherKid: false,
  notes: '',
  transportation: '',
  groupTransport: {
    selected: null,
    options: []
  },

  gdprConsent: false,
  termsAndConditionsConsent: false,
  responseReceived: 0,
};

// getters
const getters = {
  totalPrice: (state, getters) => {
    let priceToReturn = 0;
    if (state.trip.selected) {
      const tripData = getters.getTripData(state.trip.selected);
      priceToReturn += tripData.priceForKid;

      if (state.transportation === 'group') {
        priceToReturn += tripData.groupTransportFee;
        if (state.anotherKid) {
          priceToReturn += tripData.groupTransportFee;
        }
      }

      if (state.anotherKid) {
        priceToReturn += tripData.priceForKid;
        priceToReturn -= (tripData.siblingDiscount * 2);
      }
    }

    return priceToReturn;
  },
  getTripData: (state) => (selectedTripValue) => {
    if (selectedTripValue) {
      return state.trip.options.find(element => element.value === selectedTripValue);
    }

    return null;
  },
  canBeSubmitted: (state) => {
    return state.customer.firstName.length &&
      state.customer.lastName.length &&
      state.customer.mobile.length &&
      state.customer.email.length &&
      state.customer.address.streetNumber.length &&
      state.customer.address.city.length &&
      state.customer.address.zipCode.length &&
      // child validation
      state.children[0].firstName.length &&
      state.children[0].lastName.length &&
      state.children[0].dateOfBirth.length &&
      (
        !state.anotherKid ||
        (
          state.anotherKid &&
          state.children[1].firstName.length &&
          state.children[1].lastName.length &&
          state.children[1].dateOfBirth.length
        )
      ) &&
      // transport validation
      (
        state.transportation === 'individual' ||
        (state.transportation === 'group' && state.groupTransport.selected)
      ) &&
      // consents validation
      state.gdprConsent &&
      state.termsAndConditionsConsent;
  }
};

// actions
const actions = {
  fetchFormData(context) {
    console.log('fetchFormData')
    axios.get('https://smajlovo.sk/orderForm/back/public/index.php/getFormData')
      .then(function (response) {
        // handle success
        console.log(response);
        context.commit('setTripOptions', response.data.tripData)
        context.commit('setGroupTransportOptions', response.data.groupTransportStops)
      });
  },
  submitForm(context) {
    console.log('submit form action', context)
    context.commit('setResponseReceived', false);
    const dataToSend = { ...context.state, };
    console.log('submit form action', dataToSend);
    dataToSend.totalPrice = context.getters.totalPrice;
    axios.post('https://smajlovo.sk/orderForm/back/public/index.php/submitForm', dataToSend)
      .then(function (response) {
        // handle success
        console.log(response);
        context.commit('setResponseReceived', 200)
      })
      .catch(function (e) {
        // handle success
        console.log(e);
        context.commit('setResponseReceived', 500)
      });
  }
};

// mutations
const mutations = {
  selectTrip(state, value) {
    state.trip.selected = value;
  },
  setTripOptions(state, value) {
    state.trip.options = value;
  },
  setGroupTransportOptions(state, value) {
    state.groupTransport.options = value;
  },
  updateCustomer(state, customer) {
    state.customer = _.merge({}, state.customer, customer);
  },
  updateChildren(state, { id, kidStructure }) {
    state.children = _.merge({}, state.children, { [id]: kidStructure });
  },
  updateAnotherKid(state, value) {
    state.anotherKid = value;
  },
  updateNotes(state, value) {
    state.notes = value;
  },
  updateTransportation(state, value) {
    state.transportation = value;
  },
  selectGroupTransport(state, value) {
    state.groupTransport.selected = value;
  },
  updateGdprConsent(state, value) {
    state.gdprConsent = Boolean(value);
  },
  updateTermsAndConditionsConsent(state, value) {
    state.termsAndConditionsConsent = Boolean(value);
  },
  setResponseReceived(state, value) {
    state.responseReceived = value;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
