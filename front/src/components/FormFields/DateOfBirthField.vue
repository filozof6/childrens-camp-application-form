<template>
    <b-form-group
            :id="`${id}Fieldset`"
            label="Dátum narodenia"
            :label-for="`${id}`"
            :invalid-feedback="dateOfBirthInvalidFeedback"
            :valid-feedback="dateOfBirthValidFeedback"
            :state="dateOfBirthState"
    >
        <b-form-input :id="`${id}`" :value="value" @input="setter" trim/>
    </b-form-group>
</template>

<script>
  export default {
    name: 'date-of-birth-field',
    props: {
      id: {
        type: String,
        default: () => {
          return 'lastName';
        }
      },
      value: {
        type: String,
      },
      setter: {
        type: Function,
      }
    },
    computed: {
      dateOfBirthInvalidFeedback() {
        if (this.value.length > 1) {
          return ''
        } /*else if (this.value.length > 0) {
          return 'Nesprávny formát priezviska'
        }*/ else {
          return 'Povinné pole'
        }
      },
      dateOfBirthValidFeedback() {
        return this.dateOfBirthState === true ? '✓' : ''
      },
      dateOfBirthState() {
        return this.value.length >= 1
      },
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
