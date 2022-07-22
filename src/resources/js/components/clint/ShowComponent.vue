<template>
  <!-- card -->
  <div>
    <div>
      <div class="card p-2 mt-3 w-50">
        <div class="card-body">
          <h5 class="card-title">Информация о кленте:</h5>
          <p class="card-text">Имя: {{ data.name }}</p>
          <p class="card-text">Номер телефона: {{ data.phone_number }}</p>
          <a
            href="#"
            @click.prevent="removeClint(data.id)"
            class="btn btn-danger"
            >Удалить</a
          >
          <a
            href="#"
            @click.prevent="editClint(data.id)"
            class="btn btn-success"
            >Редактировать</a
          >
        </div>
        <div v-if="isVisibal" class="edit">
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
          <a
            href="#"
            @click.prevent="updateClint(data.id, name, phone_number)"
            class="mt-2 btn btn-primary"
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
      isVisibal: false,
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

  methods: {
    removeClint(id) {
      this.$emit("remove-clint", id);
    },

    editClint(id) {
      this.isVisibal = true;
      this.$emit("edit-clint", id);
    },

    updateClint(id, name, phone_number) {
      this.isVisibal = false;
      this.$emit("update-clint", id, name, phone_number);
    },
  },
};
</script>

<style>
</style>