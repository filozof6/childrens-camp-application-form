<template>
    <b-form-group
            :id="`${id}Fieldset`"
            label="Priezvisko"
            :label-for="`${id}`"
            :invalid-feedback="lastNameInvalidFeedback"
            :valid-feedback="lastNameValidFeedback"
            :state="lastNameState"
    >
        <b-form-input :id="`${id}`" :value="value" @input="setter" trim/>
    </b-form-group>
</template>

<script>
  export default {
    name: 'last-name-field',
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
      lastNameInvalidFeedback() {
        if (this.value.length > 1) {
          return ''
        } /*else if (this.value.length > 0) {
          return 'Nesprávny formát priezviska'
        }*/ else {
          return 'Povinné pole'
        }
      },
      lastNameValidFeedback() {
        return this.lastNameState === true ? '✓' : ''
      },
      lastNameState() {
        return this.value.length >= 1
      },
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
