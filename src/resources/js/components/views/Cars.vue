<template>
  <div class="container justify-content-center">
    <InputComponentVue
      placeholder="Марка авто"
      lable="Авто"
      type="text"
      v-model.trim="brand"
    />
    <span class="invalid" v-if="$v.brand.$dirty && !$v.brand.required"
      >введите поле</span
    >
    <span class="invalid" v-if="!$v.brand.minLength"
      >минимальное имя {{ $v.brand.$params.minLength.min }}
      {{ brand.minLength }}</span
    >
    <InputComponentVue
      class="mt-3 mb-3"
      placeholder="номерной знак"
      lable="Номерной знак автомобиля"
      type="text"
      v-model.trim="license_plate"
    />
    <span
      class="invalid"
      v-if="$v.license_plate.$dirty && !$v.license_plate.required"
      >введите поле</span
    >
    <span class="invalid" v-if="!$v.license_plate.maxLength"
      >максимально символов {{ $v.license_plate.$params.maxLength.max }}</span
    >
    <InputComponentVue
      class="mt-3 mb-3"
      placeholder="VIN CODE"
      lable="VIN код"
      type="text"
      v-model.trim="vin_code"
      to-upper-case
    />
    <span class="invalid" v-if="$v.vin_code.$dirty && !$v.vin_code.required"
      >введите поле</span
    >
    <span class="invalid" v-if="!$v.vin_code.maxLength"
      >максимально количество знаков
      {{ $v.vin_code.$params.maxLength.max }}</span
    >
    <div>Жалобы</div>
    <textarea v-model="problem" cols="70" rows="10"></textarea>
    <p>
      <span class="invalid" v-if="$v.problem.$dirty && !$v.problem.required"
        >введите поле</span
      >
      <span class="invalid" v-if="!$v.problem.maxLength"
        >максимально количество знаков
        {{ $v.problem.$params.maxLength.max }}</span
      >
    </p>

    <!-- select clint -->
    <div class="row">
      <div class="col-lg-5">
        <p>Выберте клиента</p>
        <select mt-3 mb-3 v-model="clint_id" class="form-select">
          <option v-for="clint in clints" :key="clint.id" :value="clint.id">
            {{ clint.name }}
          </option>
        </select>
      </div>
    </div>
    <!-- upload file -->
    <FileUploadComponent
      @upload-file="uploadFile"
      ref="image"
      type="file"
      lable="Загрузка
    изоброжения"
    />
    <span class="invalid" v-if="errorFile"
      >Ошибка неверный формат файла , выберите расширение: jpg,svg,png</span
    >
    <div class="mt-4">
      <button
        type="button"
        @click.prevent="add($event)"
        value="store"
        :disabled="disabled"
        class="btn btn-outline-dark"
      >
        добавить
      </button>
    </div>

    <div class="row mt-3 align-items-center">
      <div class="col-4">
        <label for="search">Поиск по марке автомобиля:</label>
        <input id="search" class="form-control" type="text" v-model="search" />
      </div>
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
          <th scope="col">клиент</th>
        </tr>
      </thead>
      <ShowComponent
        v-for="car of searchHandler"
        :key="car.id"
        :car="car"
        @modal="modal"
        @edit-car="editCar"
        @update-car="updataCar"
      />
    </table>
    <modal-component v-if="showModal">
      <template v-slot:body> хотите удалить? </template>
      <template v-slot:footer>
        <button @click.prevent="removeCar" class="btn btn-danger">
          удалить
        </button>

        <button @click.prevent="cancel" class="btn btn-primary">отмена</button>
      </template>
    </modal-component>
  </div>
</template>

<script>
import InputComponentVue from "../layout/InputComponent.vue";
import indexClint from "../mixins/indexClint.js";
import ModalComponent from "../ModalComponent.vue";
import FileUploadComponent from "../layout/FileUploadComponent.vue";

import ShowComponent from "../car/ShowComponent.vue";
import {
  required,
  minLength,
  maxLength,
  helpers,
} from "vuelidate/lib/validators";

export default {
  name: "Cars",
  mixins: [indexClint],

  data() {
    return {
      brand: null,
      license_plate: null,
      vin_code: null,
      problem: null,
      cars: [],
      clint_id: null,
      search: "",
      secrchSelect: "",
      showModal: false,
      image: null,
      errorFile: null,
      disabled: false,
      typeImage: ["image/jpeg", "image/png", "image/svg+xml"],
    };
  },

  components: {
    InputComponentVue,
    ShowComponent,
    ModalComponent,
    FileUploadComponent,
  },

  validations: {
    brand: {
      required,
      minLength: minLength(3),
    },
    license_plate: {
      required,
      maxLength: maxLength(8),
    },
    vin_code: {
      required,
      maxLength: maxLength(17),
    },
    problem: {
      required,
      minLength: minLength(5),
      maxLength: maxLength(255),
    },
  },

  mounted() {
    this.getCars();
  },

  computed: {
    searchHandler() {
      return this.cars.filter((elem) => {
        return elem.brand.toLowerCase().includes(this.search.toLowerCase());
      });
    },
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

    editCar(id) {
      this.id = id;
    },

    uploadFile(event) {
      this.image = event.target.files[0];
      console.log(this.image);
      let indexImage = this.typeImage.indexOf(this.image.type);

      if (indexImage != -1) {
        return;
      } else {
        this.disabled = true;
        return (this.errorFile = true);
      }
    },

    updataCar(event) {
      axios
        .patch("/api/car/" + event.id, {
          brand: event.brand,
          license_plate: event.license_plate,
          vin_code: event.vin_code,
          clint_id: event.clint_id,
        })
        .then((response) => {
          this.getCars();
        });
    },

    removeCar() {
      axios
        .delete("/api/car/" + this.cars.id)
        .then((response) => {
          this.getCars();
        })
        .then((response) => {
          this.showModal = false;
        });
    },

    modal(id) {
      this.showModal = true;
      this.cars.id = id;
    },

    cancel() {
      this.showModal = false;
    },

    add() {
      // if (this.$v.$invalid) {
      //   this.$v.$touch();
      //   return alert("заполните поля");
      // }
      let formData = new FormData();
      formData.append("image", this.image);
      formData.append("brand", this.brand);
      formData.append("license_plate", this.license_plate);
      formData.append("vin_code", this.vin_code);
      formData.append("problem", this.problem);
      formData.append("clint_id", this.clint_id);
      axios
        .post("/api/car/store", formData)
        .then((response) => {
          console.log(response);
        })
        .then((response) => {
          this.getCars();
          console.log(response);
        });
    },
  },
};
</script>

<style scoped>
span {
  color: red;
}
</style>>

