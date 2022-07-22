<template>
  <div class="container justify-content-center">
    <div class="mb-3">
      <input-component-vue
        placeholder="имя"
        type="text"
        lable="Имя"
        v-model="name"
        id="name"
      />
      <span class="invalid" v-if="$v.name.$dirty && !$v.name.required"
        >введите поле</span
      >
      <span class="invalid" v-if="!$v.name.minLength"
        >слишком короткое имя {{ name.minLength }}</span
      >
    </div>
    <div class="mb-3">
      <input-component-vue
        placeholder="номер телефона"
        type="text"
        lable="номер телефона"
        v-model="phone_number"
        id="phone"
      />
      <span
        :class="{ 'form-group--error': $v.phone_number.$error }"
        v-if="!$v.phone_number.minLength"
        >минимально 8 символов</span
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
import { required, minLength } from "vuelidate/lib/validators";

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
    },
    phone_number: {
      required,
      minLength: minLength(5),
    },
  },

  watch: {
    clints() {
      this.$set(this.clints);
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
      if (this.$v.$invalid) {
        return alert("заполните поля");
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

    updateClint(id, name, phone_number) {
      axios
        .patch("/api/clint/" + id, {
          name: name,
          phone_number: phone_number,
        })

        .then((response) => {
          this.getClint();
          name = null;
          phone_number = null;
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


