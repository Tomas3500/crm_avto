<template>
  <tbody>
    <tr>
      <th scope="row">{{ car.id }}</th>
      <td scope="row">{{ car.brand }}</td>
      <td scope="row">{{ car.license_plate }}</td>
      <td scope="row">{{ car.vin_code }}</td>
      <td scope="row">{{ car.problem }}</td>
      <td scope="row">
        <a href="#" class="btn btn-danger" @click.prevent="removeCar(car.id)"
          >удалить</a
        >
      </td>
      <td>
        <a href="#" class="btn btn-primary" @click.prevent="editCar(car.id)"
          >изминить</a
        >
      </td>
    </tr>
    <tr v-if="edit">
      <td scope="row">
        марка авто<InputComponent v-model.trim="brand" type="text" />
      </td>
      <td scope="row">
        номерной знак<InputComponent v-model.trim="license_plate" type="text" />
      </td>
      <td scope="row">
        Vin code<InputComponent v-model.trim="vin_code" type="text" />
      </td>
      <td scope="row">
        жалоба<InputComponent v-model.trim="problem" type="text" />
      </td>
      <td scope="row">
        <a
          href="#"
          class="btn btn-success"
          @click.prevent="
            updataCar(car.id, brand, license_plate, vin_code, problem)
          "
          >Обновить</a
        >
      </td>
    </tr>
  </tbody>
</template>

<script>
import InputComponent from "../layout/InputComponent.vue";

export default {
  name: "Car",
  data() {
    return {
      brand: null,
      license_plate: null,
      vin_code: null,
      problem: null,
      edit: false,
    };
  },
  props: {
    car: {
      type: Object,
    },
  },

  components: {
    InputComponent,
  },

  methods: {
    removeCar(id) {
      this.$emit("remove-car", id);
    },

    editCar(id) {
      this.edit = this.$emit("edit-car", id);
    },

    updataCar(id, brand, license_plate, vin_code, problem) {
      this.$emit("update-car", id, brand, license_plate, vin_code, problem);
    },
  },
};
</script>


<style>
</style>