<template>
  <div>
    <navbar-component></navbar-component>
  </div>
</template>

<script>
import Clint from "../views/Clints.vue";
export default {
  name: "dashbar",
  components: {
    // Clint,
  },

  updated() {
    this.token = localStorage.getItem("api_token");
    console.log(this.token);
  },
};
</script>

<style>
</style>