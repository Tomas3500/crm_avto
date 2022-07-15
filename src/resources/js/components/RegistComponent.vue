<template>
  <form @submit.prevent="checkForm()" method="post" novalidate="true">
    <div class="container">
      <div class="mt-3">
        <label for="email" class="form-label"> Электроная почта</label>
        <input
          v-model.trim="email"
          type="email"
          class="form-control"
          id="email"
          aria-describedby="emailHelp"
        />
        <span
          :class="{ 'form-group--error': $v.email.$error }"
          v-if="!$v.email.required && $v.email.email"
          >не ввели поле</span
        >
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input v-model.trim="name" type="text" class="form-control" id="name" />
        <span
          :class="{ 'form-group--error': $v.name.$error }"
          v-if="!$v.name.minLength"
          >слишком короткое имя</span
        >
      </div>
      <div class="mb-3">
        <label for="password_regist" class="form-label">Пароль</label>
        <input
          v-model.trim="password"
          type="password"
          class="form-control"
          id="password_regist"
        />
        <span
          :class="{ 'form-group--error': $v.password.$error }"
          v-if="!$v.password.minLength"
          >слишком короткий Пароль</span
        >
      </div>
      <button
        type="submit"
        @click.prevent="regist"
        value="register"
        class="btn btn-primary"
      >
        Регистрация
      </button>
    </div>
  </form>
</template>

<script>
import { email, required, minLength } from "vuelidate/lib/validators";
export default {
  name: "RegistComponent",

  data() {
    return {
      inputValue: "",
      email: null,
      name: null,
      password: null,
    };
  },

  validations: {
    email: {
      required,
      email,
    },

    name: {
      required,
      minLength: minLength(5),
    },

    password: {
      required,
      minLength: minLength(8),
    },
  },

  mounted() {
    console.log(this.users);

    console.log("login.");
  },

  methods: {
    regist() {
      if (this.$v.$invalid) {
        this.$v.$touch();
        return;
      }

      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/user/register", {
            email: this.email,
            name: this.name,
            password: this.password,
          })

          .then((r) => {
            this.$router.push("/");
          });
      });
    },
  },
};
</script>

<style scoped>
span {
  color: red;
}
</style>

