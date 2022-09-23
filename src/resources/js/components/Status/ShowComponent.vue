<template>
  <div class="card m-1" style="width: 18rem">
    <div class="card-body">
      <h5 class="card-title">Клиент: {{ clint.name }}</h5>
      <h6 class="card-subtitle mb-2 text-muted">
        Номер телефона:{{ clint.phone_number }}
      </h6>

      <div>
        <hr />
        <p v-for="car in clint.cars" :key="car.id">
          Марка авто: {{ car.brand }}
          <br />
          номерной знак: {{ car.license_plate }}
          <br />
          Vin Code:
          {{ car.vin_code }}
          <br />
          Жалобы: {{ car.problem }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ShowComponent",
  created() {},

  methods: {},

  props: {
    clint: {
      type: Object,
    },
  },
};
</script>

<style>
</style>