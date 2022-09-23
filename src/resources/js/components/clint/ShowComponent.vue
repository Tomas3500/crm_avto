<template>
  <!-- card -->
  <div>
    <div>
      <div class="card p-2 mt-3 w-50">
        <div class="card-body">
          <h5 class="card-title">Информация о кленте:</h5>
          <p class="card-text">Имя: {{ data.name }}</p>
          <p class="card-text">Номер телефона: {{ data.phone_number }}</p>
          <a href="#" @click.prevent="modal" class="btn btn-danger">Удалить</a>
          <a href="#" @click.prevent="editClint" class="btn btn-success"
            >Редактировать</a
          >
        </div>
        <div v-if="isEdit" class="edit">
          <InputComponent
            v-model="name"
            id="name"
            placeholder="имя"
            type="text"
            lable="имя"
          />
          <InputComponent
            id="phone"
            v-model="phone_number"
            placeholder="телефон"
            type="text"
            lable="номер телефона"
          />
          <a href="#" @click.prevent="updateClint" class="mt-2 btn btn-primary"
            >Изменить
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import InputComponent from "../layout/InputComponent.vue";
export default {
  name: "ShowComponent",

  data() {
    return {
      name: null,
      phone_number: null,
      clints: null,
      isEdit: false,
    };
  },

  components: {
    InputComponent,
  },

  props: {
    data: {
      type: Object,
    },
  },

  created() {
    this.name = this.data.name;
    this.phone_number = this.data.phone_number;
  },

  methods: {
    modal() {
      this.$emit("modal", this.data.id);
    },

    editClint() {
      this.isEdit = !this.isEdit;
      this.$emit("edit-clint", this.data.id);
    },

    updateClint() {
      this.isEdit = false;
      this.$emit("update-clint", {
        id: this.data.id,
        name: this.name,
        phone_number: this.phone_number,
      });
    },
  },
};
</script>

<style>
</style>