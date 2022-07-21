<template>
  <main class="col-lg-9">
    <router-view />
    <!-- <Clint /> -->
  </main>
</template>

<script>
import Clint from "../views/Clints.vue";
export default {
  name: "dashbar",
  components: {
    // Clint,
  },
};
</script>

<style>
</style>