<template>
  <div class="container">
    <form>
      <div class="mt-3">
        <label for="email_login" class="form-label"> Электроная почта</label>
        <input
          type="email"
          class="form-control"
          id="email_login"
          v-model="email"
          aria-describedby="emailHelp"
        />
      </div>
      <div class="mb-3">
        <label for="password_login" class="form-label">Пароль</label>
        <input
          v-model="password"
          type="password"
          class="form-control"
          id="password_login"
        />
      </div>
      <button type="submit" @click.prevent="login" class="btn btn-primary">
        Войти
      </button>
    </form>
  </div>
</template>

<script>
export default {
  name: "LoginComponent",

  data() {
    return {
      email: null,
      password: null,
      user: null,
    };
  },

  methods: {
    login() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/user/login", {
            email: this.email,
            password: this.password,
          })

          .then((response) => {
            this.user = response.data;
            // this.$router.push({path: '/'});
          });
      });
    },
  },

  mounted() {
    console.log("login.");
  },
};
</script>
