<template>
  <div class="container pt-3">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <router-link
          :to="{ name: 'user.regist' }"
          class="btn btn-primary btn-lg"
        >
          Зарегистрироваться</router-link
        >
        <router-link :to="{ name: 'user.login' }" class="btn-secondary btn-lg"
          >Войти в систему</router-link
        >
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "App",

  mounted() {
    console.log("Component mounted.");
  },
};
</script>
