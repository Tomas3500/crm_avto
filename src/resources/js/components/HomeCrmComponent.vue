<template>
  <div class="row">
    <navbar-component :token="token"></navbar-component>
    <main class="col-lg-9">
      <router-view />
    </main>
  </div>
</template>

<script>
import NavbarComponent from "./app/NavbarComponent";
export default {
  name: "HomeCrm",
  components: {
    NavbarComponent,
  },

  data() {
    return {
      token: "",
    };
  },
  updated() {
    this.token = localStorage.getItem("api_token");
  },
};
</script>

<style>
</style>