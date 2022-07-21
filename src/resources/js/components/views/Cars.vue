<template>
  <div>
    <InputComponentVue
      placeholder="Марка авто"
      lable="Авто"
      type="text"
      v-model="brand"
    />

    <InputComponentVue
      class="mt-3 mb-3"
      placeholder="номерной знак"
      lable="Номерной знак автомобиля"
      type="text"
      v-model="license_plate"
    />
    <InputComponentVue
      class="mt-3 mb-3"
      placeholder="VIN CODE"
      lable="VIN код"
      type="text"
      v-model="vin_code"
    />
    <span></span>
    <textarea v-model="problem" cols="70" rows="10"></textarea>
    <ShowComponent />
  </div>
</template>

<script>
import InputComponentVue from "../layout/InputComponent.vue";
import ShowComponent from "../car/ShowComponent.vue";

export default {
  name: "Car",
  data() {
    return {
      brand: null,
      license_plate: null,
      vin_code: null,
      problem: null,
    };
  },

  components: {
    InputComponentVue,
    ShowComponent,
  },
};
</script>

<style>
</style>

