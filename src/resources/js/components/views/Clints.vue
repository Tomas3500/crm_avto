<template>
  <div class="container justify-content-center">
    <div class="mb-3">
      <input-component-vue
        placeholder="имя"
        type="text"
        lable="Имя"
        v-model.trim="name"
      />
      <span class="invalid" v-if="$v.name.$dirty && !$v.name.required"
        >заполните поле</span
      >
      <span class="invalid" v-if="!$v.name.minLength"
        >минимально {{ $v.name.$params.minLength.min }}</span
      >
      <span
        :class="{ 'form-group--error': $v.name.$error }"
        v-if="!$v.name.maxLength"
        >максимально {{ $v.name.$params.maxLength.max }} символов</span
      >
    </div>
    <div class="mb-3">
      <input-component-vue
        placeholder="номер телефона"
        type="text"
        lable="номер телефона"
        v-model.trim.number="phone_number"
      />
      <span
        class="invalid"
        v-if="$v.phone_number.$dirty && !$v.phone_number.required"
        >заполните поле</span
      >
      <span
        :class="{ 'form-group--error': $v.phone_number.$error }"
        v-if="!$v.phone_number.minLength"
        >минимально {{ $v.phone_number.$params.minLength.min }} символов</span
      >
      <span
        :class="{ 'form-group--error': $v.phone_number.$error }"
        v-if="!$v.phone_number.maxLength"
        >максимально {{ $v.phone_number.$params.maxLength.max }} символов</span
      >
    </div>

    <button
      type="button"
      @click.prevent="add"
      value="store"
      class="btn btn-outline-dark"
    >
      добавить
    </button>
    <ShowComponent
      @remove-clint="removeClint"
      @edit-clint="editClint"
      @update-clint="updateClint"
      :data="clint"
      v-for="clint of clints"
      :key="clint.id"
    />
    <h2 v-if="clints.length === 0">нет клиентов</h2>
  </div>
</template>

<script>
import InputComponentVue from "../layout/InputComponent.vue";
import ShowComponent from "../clint/ShowComponent.vue";
import { required, minLength, maxLength } from "vuelidate/lib/validators";

export default {
  name: "clint",
  data() {
    return {
      clints: [],
      name: null,
      isEdit: null,
      phone_number: null,
    };
  },

  components: {
    InputComponentVue,
    ShowComponent,
  },
  validations: {
    name: {
      required,
      minLength: minLength(4),
      maxLength: maxLength(50),
    },

    phone_number: {
      required,
      minLength: minLength(10),
      maxLength: maxLength(12),
    },
  },

  mounted() {
    this.getClint();
  },

  methods: {
    getClint() {
      axios.get("/api/clint/index").then((response) => {
        this.clints = response.data;
      });
    },

    add() {
      if (this.$v.$invalid && typeof this.$v.phone_number !== "number") {
        this.$v.$touch();
        return alert("отредактируйте поля");
      }
      axios
        .post("/api/clint/store", {
          name: this.name,
          phone_number: this.phone_number,
        })

        .then((response) => {
          this.getClint();
          (this.name = null), (this.phone_number = null), console.log(response);
        });
    },

    removeClint(id) {
      axios.delete("/api/clint/" + id).then((response) => {
        this.getClint();
      });
    },

    editClint(id) {
      this.id = id;
    },

    updateClint(event) {
      axios
        .patch("/api/clint/" + event.id, {
          name: event.name,
          phone_number: event.phone_number,
        })
        .then((response) => {
          this.getClint();
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


