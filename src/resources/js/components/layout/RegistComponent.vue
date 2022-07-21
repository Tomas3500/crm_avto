<template>
  <div class="container">
    <h1>Регистрация</h1>
    <form @submit.prevent="regist()" method="post" novalidate="true">
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
          <span class="invalid" v-if="$v.email.$dirty && !$v.email.required"
            >обязательное поле
          </span>

          <span class="invalid" v-if="$v.email.$dirty && !$v.email.email"
            >Введите коректно Email
          </span>
        </div>

        <div class="mb-3">
          <label for="name" class="form-label">Имя</label>
          <input
            v-model.trim="name"
            type="text"
            class="form-control"
            id="name"
          />
          <span
            :class="{ 'form-group--error': $v.name.$error }"
            v-if="!$v.name.required"
            >обязательное поле</span
          >
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
            v-if="!$v.password.required"
            >обязательное поле
          </span>
          <span
            :class="{ 'form-group--error': $v.password.$error }"
            v-if="!$v.password.minLength"
            >минимально 8 символов</span
          >
        </div>
        <button type="submit" value="register" class="btn btn-primary">
          Регистрация
        </button>

        <!-- !! метод! -->
        <router-link :to="{ name: 'user.login' }" class="btn-secondary btn"
          >Войти в систему
        </router-link>
      </div>
    </form>
  </div>
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

  mounted() {},

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

          .then((response) => {
            console.log(response);
            localStorage.setItem(
              "api_token",
              response.data.plainTextToken
              // config.headers["X-XSRF-TOKEN"]
            );
            // this.$router.push({ name: "clint" });
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

