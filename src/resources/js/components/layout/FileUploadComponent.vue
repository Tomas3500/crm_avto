<template>
  <div class="row">
    <div class="col-lg-5">
      <div class="mb-3">
        <label for="formFile" class="form-label">{{ lable }}</label>
        <input
          @change="uploadFile"
          class="form-control"
          :type="type"
          id="formFile"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "uploadFile",

  props: {
    lable: {
      type: String,
    },

    type: {
      type: String,
    },
  },

  methods: {
    uploadFile(event) {
      this.$emit("upload-file", event);
    },
  },
};
</script>

<style>
</style>