<template>
    <b-form-group
            :id="`${id}Fieldset`"
            label="Meno"
            :label-for="`${id}`"
            :invalid-feedback="firstNameInvalidFeedback"
            :valid-feedback="firstNameValidFeedback"
            :state="firstNameState"
    >
        <b-form-input :id="`${id}`" :value="value" @input="setter" trim/>
    </b-form-group>
</template>

<script>
  export default {
    name: 'first-name-field',
    props: {
      id: {
        type: String,
        default: () => {
          return 'firstName';
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
      firstNameInvalidFeedback() {
        if (this.value.length > 1) {
          return ''
        } else if (this.value.length > 0) {
          return 'Nesprávny formát mena'
        } else {
          return 'Povinné pole'
        }
      },
      firstNameValidFeedback() {
        return this.firstNameState === true ? '✓' : ''
      },
      firstNameState() {
        return this.value.length >= 1
      },
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
