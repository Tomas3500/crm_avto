<template>
  <div class="container justify-content-center">
    <form @submit.prevent="add()" method="post" novalidate="true">
      <div class="mb-3">
        <input-component-vue
          placeholder="имя"
          type="text"
          lable="Имя"
          v-model="name"
          id="name"
        />
        <span class="invalid" v-if="$v.name.$dirty && !$v.name.required"
          >введите поле</span
        >
        <span class="invalid" v-if="!$v.name.minLength"
          >слишком короткое имя {{ name.minLength }}</span
        >
      </div>
      <div class="mb-3">
        <input-component-vue
          placeholder="номер телефона"
          type="text"
          lable="номер телефона"
          v-model="phone"
          id="phone"
        />
        <!-- <span class="invalid" v-if="$v.phone.$dirty && !$v.phone.required"
          >введите поле</span
        > -->
        <span
          :class="{ 'form-group--error': $v.phone.$error }"
          v-if="!$v.phone.minLength"
          >минимально 8 символов</span
        >
      </div>
      <button type="button" @click.prevent="add()" class="btn btn-outline-dark">
        add
      </button>
    </form>
  </div>
</template>

<script>
import InputComponentVue from "../layout/InputComponent.vue";
import { required, minLength } from "vuelidate/lib/validators";

export default {
  name: "clint",
  data() {
    return {
      name: null,
      phone: null,
    };
  },
  components: {
    InputComponentVue,
  },
  validations: {
    name: {
      required,
      minLength: minLength(4),
    },
    phone: {
      required,
      minLength: minLength(5),
    },
  },

  methods: {
    add() {
      if (this.$v.$invalid) {
        this.$v.$touch();
        return;
      }
    },
  },
};
</script>

<style scoped>
span {
  color: red;
}
</style>>


