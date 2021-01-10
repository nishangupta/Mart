<template>
  <div class="product-section">
    <div class="row">
      <div class="col-sm-12 col-md-4 ml-auto">
        <div class="product-section-image" id="productCurrentImage">
          <img
            :src="product.image.original"
            alt="product"
            class="active img-fluid"
            id="currentImage"
          />
        </div>
        <div class="product-section-images">
          <div class="row mt-3">
            <div
              class="col-sm-4 col-md-4 col-xl-3 col-3 mb-2"
              v-for="p in product.product_image"
              :key="p.id"
            >
              <div class="product-section-thumbnail">
                <img :src="p.original" class="w-100" alt="product" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-7 pl-md-5 mt-5 mt-md-0 mr-auto">
        <div class="product-section-information">
          <h3 class="product-section-title text-gray-900">
            {{ product.title }}
          </h3>
          <div>
            Brand: {{ product.brand == "" ? "no brand" : product.brand }}
          </div>

          <div class="my-4">
            <div class="text-orange h4" v-if="!product.discount">
              Rs.{{ getProductPrice }}
            </div>
            <div v-else>
              <p class="text-orange h4">Rs.{{ getProductPrice }}</p>
              <span class="line-through h6"> Rs.{{ product.price }}</span>
              <span class="btn btn-primary btn-sm disabled ml-3"
                >{{ product.discount }}% off</span
              >
            </div>
          </div>

          <!-- variants -->
          <div class="my-2" v-if="activeVariants.length">
            <div class="h6 text-uppercase">
              {{ activeVariants[0].type }}:
              <span v-if="notSelected" class="text-danger"
                >please select a variant</span
              >
            </div>
            <div class="attrContainer">
              <div
                class="attrBox"
                v-for="attr in activeVariants"
                :key="attr.id"
                :title="attr.type"
                :id="attr.id"
                @click="selectVariant"
              >
                {{ attr.attribute }}
              </div>
            </div>
          </div>

          <div v-if="variantSelected">
            <p class="text-muted text-info">
              {{ form.variant.stock }} in stock
            </p>
          </div>

          <div class="my-3">
            <h4>Quantity:</h4>
            <div class="d-flex">
              <button
                @click="cartDecrement"
                class="btn btn-outline-primary px-3"
              >
                -
              </button>
              <input
                type="text"
                v-model="form.quantity"
                class="pl-3 border"
                disabled
                style="width: 50px"
              />
              <button
                @click="cartIncrement"
                class="btn btn-outline-primary px-3"
              >
                +
              </button>
            </div>
          </div>

          <p>&nbsp;</p>

          <div class="d-flex">
            <button
              type="submit"
              class="btn btn-orange mr-3 py-2 px-3"
              @click="addToCart"
            >
              Add to Cart
              <div
                class="spinner-border spinner-border-sm"
                v-if="isLoadingBtn"
                role="status"
              >
                <span class="sr-only">Loading...</span>
              </div>
            </button>
            <button
              type="submit"
              class="btn btn-primary py- px-3"
              @click="buyNow"
            >
              Buy now
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "product-show",
  components: {},
  props: ["product", "user"],
  data() {
    return {
      variantSelected: false,
      form: {
        productId: this.product.id,
        quantity: 1,
        variant: null,
      },
      stock: null,
      notSelected: false,
      isLoadingBtn: false,
    };
  },
  mounted() {
    console.log(this.product);
  },
  computed: {
    activeVariants: function () {
      return this.product.attributes.filter((e) => e.live && e.stock >= 1);
    },
    getProductPrice: function () {
      if (this.product.discount) {
        return (
          this.product.price -
          (this.product.discount * this.product.price) / 100
        );
      }
      return this.product.price;
    },
  },
  methods: {
    selectVariant(e) {
      this.resetSelection();

      //getting the selected variant obj
      this.form.variant = this.product.attributes.find(
        (item) => item.id == e.target.id
      );

      this.variantSelected = true;
      this.notSelected = false;
      e.target.classList.add("selected");
    },

    resetSelection() {
      //removing the selected class
      let divs = document.querySelectorAll(".attrBox");
      divs.forEach((e) => e.classList.remove("selected"));

      this.form.variant = null;
      this.form.quantity = 1;
      this.variantSelected = false;
    },

    cartDecrement() {
      if (this.variantSelected == false) {
        this.notSelected = true;
      }

      if (this.form.quantity <= 1) {
        return;
      }

      this.form.quantity--;
    },

    cartIncrement() {
      if (this.variantSelected == false) {
        this.notSelected = true;
      }
      if (this.form.quantity >= this.form.variant.stock) {
        return;
      }
      this.form.quantity++;
    },

    //add to cart
    addToCart() {
      if (this.variantSelected == false) {
        this.notSelected = true;
        return;
      }

      this.checkLogin();

      this.isLoadingBtn = true;
      axios({
        method: "post",
        url: "/cart",
        data: {
          productId: this.form.productId,
          quantity: this.form.quantity,
          variantId: this.form.variant.id,
        },
        headers: {
          "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        },
      })
        .then((res) => res.data)
        .then((data) => {
          console.log(data);
          swal({
            title: data.msg,
            icon: "success",
          });
        })
        .catch((e) => {
          console.log(e);
          swal({
            title: "Something went wrong",
            icon: "error",
          });
        })
        .finally((e) => {
          this.isLoadingBtn = false;
        });
    },
    buyNow() {},

    //check login
    checkLogin() {
      if (!this.user) {
        location.replace("/login");
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.attrContainer {
  display: flex;
  align-items: center;
  margin: 0.5rem 0rem;
  flex-wrap: wrap;
}
.attrBox {
  padding: 0.25rem 1rem;
  border: 1px solid #2874f0;
  font-size: 1.25rem;
  margin: 0.25rem;
  transition: 20ms ease;
  cursor: pointer;
  &:hover {
    border-color: #fd7e14;
  }
  &.selected {
    color: #fff;
    border: 1px solid #fd7e14;
    background-color: #fd7e14;
  }
}
</style>>