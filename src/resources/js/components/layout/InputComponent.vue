<template>
  <div>
    <label>{{ lable }}</label>
    <input
      v-on:input="inputHandler"
      :placeholder="placeholder"
      :value="value"
      :type="type"
      class="form-control"
    />
  </div>
</template>

<script>
export default {
  name: "input-layout",
  methods: {
    inputHandler(event) {
      let inputCase = event.target.value;
      if (this.toUpperCase) {
        this.$emit("input", inputCase.toUpperCase());
      } else {
        this.$emit("input", inputCase);
      }
    },
  },

  props: {
    lable: {
      type: String,
    },

    placeholder: {
      type: String,
    },

    type: {
      type: String,
    },

    value: {
      type: [String, Number],
    },

    toUpperCase: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

