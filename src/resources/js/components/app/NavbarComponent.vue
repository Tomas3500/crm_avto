<template>
  <nav class="col-2 d-none d-md-block fs-4 sidebar">
    <div class="sidebar-sticky">
      <ul class="nav flex-column">
        <router-link
          v-for="link in links"
          :key="link.url"
          :to="link.url"
          tag="li"
          :exact="link.exact"
        >
          <a class="nav-link" href="#">{{ link.nameLink }}</a>
        </router-link>
      </ul>
      <!-- ?? -->
      <a v-if="token" href="#" class="nav-link" v-on:click.prevent="logout"
        >Выход</a
      >
    </div>
  </nav>
</template>

<script>
export default {
  name: "navbar",
  data() {
    return {
      links: [
        { nameLink: "Клиенты", url: "/clint", exact: true },
        { nameLink: "Автомобили", url: "/cars" },
        { nameLink: "Статус", url: "/status" },
      ],
    };
  },

  props: {
    token: {
      type: String,
    },
  },

  methods: {
    logout() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.post("/api/logout").then((response) => {
          console.log(localStorage.getItem("api_token"));
          console.log(localStorage.getItem("api_token"));
          localStorage.removeItem("api_token");
          this.$router.push({ name: "user.login" });
        });
      });
    },
  },
};
</script>

<style>
</style>