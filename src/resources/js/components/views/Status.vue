<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="d-flex">
        <ShowComponent
          v-for="(clint, index) in clints"
          :key="clint.id"
          :clint="clint"
          :index="index"
        />
      </div>
    </div>
  </div>
</template>

<script>
import ShowComponent from "../Status/ShowComponent.vue";

export default {
  name: "status",
  data() {
    return {
      clints: [],
      index: null,
    };
  },

  components: {
    ShowComponent,
  },

  mounted() {
    this.getClint();
  },

  methods: {
    getClint() {
      axios.get("/api/status/index").then((response) => {
        this.clints = response.data;
      });
    },
  },
};
</script>