<template>
  <div>
    <button
      class="btn btn-sm btn-block btn-primary mb-2"
      @click="getProductImages"
    >
      <span
        v-if="isLoading"
        class="spinner-border spinner-border-sm"
        role="status"
        aria-hidden="true"
      ></span>
      Refresh
    </button>
    <div class="row" v-if="images.length">
      <div
        class="col-sm-6 col-md-4 my-3 border p-4"
        v-for="image in images"
        :key="image.id"
      >
        <a :href="image.original" target="_blank">
          <img :src="image.thumbnail" class="img-fluid" alt="" />
        </a>

        <button
          @click="deleteImage(image.id)"
          class="btn btn-outline-danger btn-sm mt-1 btn-rounded"
        >
          delete
        </button>
      </div>
    </div>
    <div v-if="noImages">
      <p class="text-center">No images uploded for this product</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "product-images",
  data() {
    return {
      images: [],
      isLoading: true,
      noImages: false,
    };
  },
  props: {
    productId: {
      type: String,
      required: true,
    },
  },
  mounted() {
    this.getProductImages();
  },
  methods: {
    getProductImages() {
      this.isLoading = true;
      axios
        .get(`/product/get/image/${this.productId}`)
        .then((res) => res.data)
        .then((data) => {
          this.images = data;
          this.isLoading = false;
          if (!data.length) {
            this.noImages = true;
          }
        })
        .catch((e) => {
          console.log(e);
          this.isLoading = false;
        });
    },

    deleteImage(imageId) {
      this.isLoading = true;
      axios
        .delete(`/product/${imageId}/image`)
        .then((res) => res.data)
        .then((data) => {
          if (data.success) {
            this.isLoading = false;
            this.images = this.images.filter((image) => image.id !== imageId);
          }
        })
        .catch((e) => {
          console.log(e);
          this.isLoading = false;
        });
    },
  },
};
</script>

<style scoped>
.uploader {
  min-height: 20vh;
}
</style>