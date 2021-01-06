<template>
  <div class="container uploader">
    <div class="row justify-content-center mb-3" ref="imageUpload">
      <div class="col-12 bg-primary text-white rounded py-3 my-2 text-center">
        DROP IMAGES HERE
      </div>
    </div>
  </div>
</template>

<script>
import Dropzone from "dropzone";
export default {
  name: "image-upload",
  data() {
    return {
      dropzone: null,
    };
  },
  props: {
    productId: {
      type: String,
      required: true,
    },
  },
  mounted() {
    this.dropzone = new Dropzone(this.$refs.imageUpload, {
      url: "/api/product/images/" + this.productId,
      method: "POST",
    });
  },
};
</script>

<style scoped>
.uploader {
  min-height: 20vh;
}
</style>