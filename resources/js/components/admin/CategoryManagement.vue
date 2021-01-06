<template>
  <div class="container">
    <ul class="list-group">
      <li
        class="list-group-item"
        v-for="category in categories"
        :key="category.id"
      >
        {{ category.name }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  props: {
    categories: Array,
  },
  mounted() {},
};
</script>

<style scoped>
.uploader {
  min-height: 20vh;
}
</style>