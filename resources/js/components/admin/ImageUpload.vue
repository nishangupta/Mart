<template>
  <div class="container uploader">
    <div class="row">
      <!-- image upload here -->
      <div class="col-12">
        <div class="image-upload">
          <i class="fas fa-cloud-upload-alt fa-2x"></i>
          <h5 class="py-2"><b>Click here to upload</b></h5>
          <h6 class="mt-10 mb-70">Or Drop Your Image Here</h6>
        </div>

        <div class="upload-box" ref="uploadBox"></div>
      </div>

      <br />
      <div class="col-12 mt-5">
        <!-- product images here -->
        <div class="product-images">
          <button
            class="btn btn-sm btn-block btn-primary mb-5"
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
          <div class="card-columns" v-if="images.length">
            <div class="card p-3" v-for="image in images" :key="image.id">
              <a :href="image.original" target="_blank">
                <img
                  :src="image.thumbnail"
                  class="card-img-top"
                  alt="product img"
                />
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

    //initializing dropzone
    let dropzone = new Dropzone(this.$refs.uploadBox, {
      url: "/admin/product/image/" + this.productId,
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
      },
    });

    dropzone.on("uploadprogress", function (file) {
      this.isLoading = true;
    });

    dropzone.on("complete", (file) => {
      this.isLoading = false;
      dropzone.removeFile(file);
      this.getProductImages();
    });
  },
  methods: {
    getProductImages() {
      this.isLoading = true;
      axios
        .get(`/admin/product/get/image/${this.productId}`)
        .then((res) => res.data)
        .then((data) => {
          this.images = data;
          if (!data.length) {
            this.noImages = true;
          }
        })
        .catch((e) => {
          console.log(e);
        })
        .finally((e) => {
          this.isLoading = false;
        });
    },

    deleteImage(imageId) {
      this.isLoading = true;
      axios
        .delete(`/admin/product/${imageId}/image`)
        .then((res) => res.data)
        .then((data) => {
          if (data.success) {
            this.images = this.images.filter((image) => image.id !== imageId);
          }
        })
        .catch((e) => {
          console.log(e);
        })
        .finally((e) => {
          this.isLoading = false;
        });
    },
  },
};
</script>

<style scoped>
.uploader {
  min-height: 300px;
  position: relative;
}
.image-upload {
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
  padding: 2rem;
}
.upload-box {
  height: 100%;
  width: 100%;
  border: 3px dotted #444;
  position: absolute;
  overflow: hidden;
  top: 0;
  left: 0;
}
</style>