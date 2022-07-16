<template>
  <nav class="col-lg-4 d-none d-md-block fs-4 sidebar">
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

  mounted() {
    console.log(this.links);
  },
};
</script>

<style>
</style>