<template>
  <div class="row">
    <navbar-component></navbar-component>
    <main-component></main-component>
  </div>
</template>

<script>
import NavbarComponent from "./app/NavbarComponent";
import MainComponent from "./app/MainComponent";
export default {
  name: "HomeCrm",
  components: {
    NavbarComponent,
    MainComponent,
  },
};
</script>

<style>
</style>