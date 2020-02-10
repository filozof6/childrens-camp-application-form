<template>
    <b-row>
        <b-col sm="4">
            <first-name-field
                    :id="`childFirstNameFieldset${index}`"
                    :value="$store.state.orderForm.children[this.index].firstName"
                    :setter="setChildFirstName"
            />
        </b-col>
        <b-col sm="4">
            <last-name-field
                    :id="`childFirstNameFieldset${index}`"
                    :value="$store.state.orderForm.children[this.index].lastName"
                    :setter="setChildLastName"
            />
        </b-col>
        <b-col sm="4">
            <date-of-birth-field
                    :id="`childFirstNameFieldset${index}`"
                    :value="$store.state.orderForm.children[this.index].dateOfBirth"
                    :setter="setDateOfBirth"
            />
        </b-col>
    </b-row>
</template>

<script>
  import FirstNameField from './FormFields/FirstNameField';
  import LastNameField from './FormFields/LastNameField';
  import DateOfBirthField from './FormFields/DateOfBirthField';
  import _ from 'lodash';

  export default {
    name: 'child-form',
    components: {FirstNameField, LastNameField, DateOfBirthField},
    props: {
      index: String,
      default: function () {
        return "0"
      }
    },
    methods: {
      setChildFirstName(value) {
        let kidStructure = {...this.$store.state.orderForm.children[this.index]};
        kidStructure.firstName = _.capitalize(value);
        this.$store.commit('orderForm/updateChildren', {id: this.index, kidStructure})
      },
      setChildLastName(value) {
        let kidStructure = {...this.$store.state.orderForm.children[this.index]};
        kidStructure.lastName = _.capitalize(value);
        this.$store.commit('orderForm/updateChildren', {id: this.index, kidStructure})
      },
      setDateOfBirth(value) {
        let kidStructure = {...this.$store.state.orderForm.children[this.index]};
        kidStructure.dateOfBirth = _.capitalize(value);
        this.$store.commit('orderForm/updateChildren', {id: this.index, kidStructure})
      },
    }

  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
