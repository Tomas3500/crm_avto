<template>
  <div class="container">
    <h1>Вход</h1>

    <form @submit.prevent="login()" method="post" novalidate="true">
      <div class="mt-3">
        <label for="email_login" class="form-label"> Электроная почта</label>
        <input
          type="email"
          class="form-control"
          id="email_login"
          v-model="email"
          aria-describedby="emailHelp"
        />
        <span
          :class="{ 'form-group--error': $v.email.$error }"
          v-if="!$v.email.required && $v.email.email"
          >обязательное поле</span
        >
      </div>
      <div class="mb-3">
        <label for="password_login" class="form-label">Пароль</label>
        <input
          v-model="password"
          type="password"
          class="form-control"
          id="password_login"
        />
        <span
          :class="{ 'form-group--error': $v.password.$error }"
          v-if="!$v.password.required"
          >обязательное поле
        </span>
        <span
          :class="{ 'form-group--error': $v.password.$error }"
          v-if="!$v.password.minLength"
          >пароль из 8 символов</span
        >
      </div>
      <button type="submit" class="btn btn-primary">Войти</button>
    </form>
  </div>
</template>

<script>
import { email, required, minLength } from "vuelidate/lib/validators";

export default {
  name: "LoginComponent",

  data() {
    return {
      email: null,
      password: null,
      user: null,
    };
  },

  validations: {
    email: {
      required,
      email,
    },
    password: {
      required,
      minLength: minLength(8),
    },
  },

  methods: {
    login() {
      if (this.$v.$invalid) {
        this.$v.$touch();
        return alert("заполните поля ввода");
      }
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/user/login", {
            email: this.email,
            password: this.password,
          })
          .then((response) => {
            this.user = response.data;
            localStorage.setItem("api_token", response.data.plainTextToken);
            this.$router.push({ name: "clint" });
          });
      });
    },
  },

  mounted() {
    console.log("login.");
  },
};
</script>
<style scoped>
span {
  color: red;
}
</style>