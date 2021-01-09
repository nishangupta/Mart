<template>
  <div class="form-group">
    <div class="row">
      <div class="col">
        <label for="">Choose a category</label>
        <select
          class="form-control"
          @change="categorySelected"
          required
          name="category_id"
        >
          <option>Choose a category</option>
          <option
            v-for="category in mainCategories"
            :key="category.id"
            :value="category.id"
            :selected="selectedMainCategoryId == category.id"
          >
            {{ category.name }}
          </option>
        </select>
      </div>
      <div class="col">
        <label class="small" for="">Choose a subCategory</label>
        <select class="form-control" name="subCategory_id" required>
          <option value="" selected disabled v-if="!subCategories">
            Choose a Subcategory
          </option>
          <option v-for="sub in subCategories" :key="sub.id" :value="sub.id">
            {{ sub.name }}
          </option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      mainCategories: [],
      subCategories: [],
      selectedMainCategoryId: null,
    };
  },
  props: ["categories", "selected_id"],

  mounted() {
    //getting the parent categories only
    this.mainCategories = this.categories.filter(
      (item) => item.is_parent == true
    );

    //if receives a selected_id prop
    if (this.selected_id) {
      this.selectById(this.selected_id);
    }
  },
  methods: {
    categorySelected(e) {
      this.subCategories = this.categories.filter(
        (item) => item.parent_id == e.target.value
      );
    },

    selectById(id) {
      //getting the subCategory
      this.subCategories = this.categories.filter((item) => item.id == id);

      //get the parentCategory
      this.selectedMainCategoryId = this.subCategories[0].parent_id;
    },
  },
};
</script>

<style scoped>
</style>