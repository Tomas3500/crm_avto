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
import indexClint from "../mixins/indexClint.js";

export default {
  name: "status",
  mixins: [indexClint],

  data() {
    return {
      index: null,
    };
  },

  components: {
    ShowComponent,
  },
};
</script>