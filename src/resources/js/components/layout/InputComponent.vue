<template>
  <div>
    <label :for="id">{{ lable }}</label>
    <input
      v-on:input="$emit('input', $event.target.value)"
      :placeholder="placeholder"
      :value="inputValue"
      :type="type"
      class="form-control"
    />
  </div>
</template>

<script>
export default {
  name: "input-layout",
  data() {
    return {
      inputValue: null,
    };
  },

  props: {
    lable: {
      type: String,
    },

    placeholder: {
      type: String,
    },

    id: {
      type: String,
    },

    type: {
      type: String,
    },
  },

  created() {
    this.inputValue = this.value;
  },
};
</script>

