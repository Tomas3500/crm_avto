<template>
  <div class="container pt-3">
    <div class="row">
      <div class="col">
        <HomeCrmComponent />
      </div>
    </div>
  </div>
</template>

<script>
import HomeCrmComponent from "./HomeCrmComponent.vue";
export default {
  name: "App",

  components: {
    HomeCrmComponent,
  },

  updated() {
    this.token = localStorage.getItem("api_token");
  },
};
</script>
