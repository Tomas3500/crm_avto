<template>
  <div class="container justify-content-center">
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

    <div>Жалобы</div>
    <textarea v-model="problem" cols="70" rows="10"></textarea>
    <div>
      <button
        type="button"
        @click.prevent="add"
        value="store"
        class="btn btn-outline-dark"
      >
        добавить
      </button>
    </div>
    <!-- Lorem ipsum dolor sit amet consectetur adipisicing elit.  -->
    <table class="table mt-3">
      <thead>
        <span v-if="cars.lenght === 0">нет автомобиля</span>
        <tr>
          <th scope="col">id</th>
          <th scope="col">марка авто</th>
          <th scope="col">номерной знак</th>
          <th scope="col">Vin code</th>
          <th scope="col">жалоба</th>
        </tr>
      </thead>
      <ShowComponent
        v-for="car of cars"
        :key="car.id"
        :car="car"
        @remove-car="removeCar"
        @edit-car="editCar"
        @update-car="updataCar"
      />
    </table>
  </div>
</template>

<script>
import InputComponentVue from "../layout/InputComponent.vue";
import ShowComponent from "../car/ShowComponent.vue";
import { required, minLength } from "vuelidate/lib/validators";

export default {
  name: "Cars",
  data() {
    return {
      brand: null,
      license_plate: null,
      vin_code: null,
      problem: null,
      cars: [],
    };
  },

  components: {
    InputComponentVue,
    ShowComponent,
  },

  mounted() {
    this.getCars();
    console.log(this.getCars());
  },

  methods: {
    getCars() {
      axios
        .get("/api/car/index")
        .then((response) => {
          this.cars = response.data;
        })
        .then((response) => {
          console.log(response);
        });
    },

    updataCar(id, brand, license_plate, vin_code, problem) {
      axios
        .patch("/api/car/" + id, {
          brand: brand,
          license_plate: license_plate,
          vin_code: vin_code,
          problem: problem,
        })
        .then((response) => {
          this.getCars();
          this.brand = null;
          console.log(response);
        });
    },

    removeCar(id) {
      axios.delete("/api/car/" + id).then((response) => {
        this.getCars();
      });
    },

    editCar(id) {
      console.log(id);
    },

    add() {
      axios
        .post("/api/car/store", {
          brand: this.brand,
          license_plate: this.license_plate,
          vin_code: this.vin_code,
          problem: this.problem,
        })
        .then((response) => {
          this.getCars();
          console.log(response);
        });

      // console.log("11111");
    },
  },
};
</script>

<style>
</style>

