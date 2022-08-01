<template>
  <tbody>
    <tr>
      <th scope="row">{{ car.id }}</th>
      <td scope="row">{{ car.brand }}</td>
      <td scope="row">{{ car.license_plate }}</td>
      <td scope="row">{{ car.vin_code }}</td>
      <td scope="row">{{ car.problem }}</td>
      <td scope="row">{{ car.clint.name }}</td>

      <td scope="row">
        <a href="#" class="btn btn-danger" @click.prevent="modal">удалить</a>
      </td>
      <td>
        <a href="#" class="btn btn-primary" @click.prevent="editCar"
          >изминить</a
        >
      </td>
    </tr>

    <tr v-if="edit">
      <td scope="row">
        <InputComponent
          placeholder="авто"
          lable="авто"
          v-model.trim="brand"
          type="text"
        />
      </td>
      <td scope="row">
        <InputComponent
          placeholder="знак"
          lable="знак"
          v-model.trim="license_plate"
          type="text"
        />
      </td>
      <td scope="row">
        <InputComponent
          placeholder="вин"
          lable="вин"
          v-model.trim="vin_code"
          type="text"
        />
      </td>
      <td scope="row">
        <button class="btn btn-success" @click.prevent="updataCar">
          Обновить
        </button>
      </td>
    </tr>
  </tbody>
</template>

<script>
import InputComponent from "../layout/InputComponent.vue";
import { required, minLength, maxLength } from "vuelidate/lib/validators";

export default {
  name: "Car",
  data() {
    return {
      brand: null,
      license_plate: null,
      vin_code: null,
      problem: null,
      edit: false,
      // clint_id: null,
    };
  },
  props: {
    car: {
      type: Object,
    },
  },

  created() {
    this.brand = this.car.brand;
    this.license_plate = this.car.license_plate;
    this.vin_code = this.car.vin_code;
  },

  components: {
    InputComponent,
  },

  methods: {
    modal() {
      this.$emit("modal", this.car.id);
    },

    editCar() {
      this.edit = !this.edit;
      this.$emit("edit-car", this.car.id);
    },

    updataCar() {
      this.$emit("update-car", {
        id: this.car.id,
        brand: this.brand,
        vin_code: this.vin_code,
        license_plate: this.license_plate,
        clint_id: this.car.clint.id,
      });
      this.edit = false;
    },
  },
};
</script>


<style>
</style>