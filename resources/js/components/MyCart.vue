<template>
  <div class="card shadow">
    <div class="card-header bg-light border-bottom">
      <p class="mb-0">My Cart</p>
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-12 bg-light">
          <div class="d-flex justify-content-between">
            <p>Select items</p>
            <div>
              <button type="submit" class="btn" @click.prevent="deleteCart">
                <i class="fas fa-trash-alt text-dark"></i>
              </button>
            </div>
          </div>
        </div>

        <div
          class="col-12 mb-2 bg-light"
          v-for="cartItem in cartItems"
          :key="cartItem.id"
        >
          <div class="d-flex justify-content-between">
            <div class="row pt-4 pb-2">
              <div class="col-md-1 col-1">
                <input
                  type="checkbox"
                  @change="cartSelect(cartItem.id, $event)"
                  :value="'selector-' + cartItem.id"
                />
              </div>

              <div class="col-md-2 col-2">
                <img
                  :src="cartItem.product.get_image[0].original"
                  class="img-fluid"
                  alt="Product"
                />
              </div>

              <div class="col-md-4 col-8">
                <a :href="`/shop/${cartItem.product.id}`" target="_blank">
                  <p class="text-grey-800">{{ cartItem.product.title }}</p>
                </a>
              </div>

              <div class="col-md-2 col-6 mt-sm-2 mt-md-0">
                <p class="text-orange h5">Rs.{{ cartItem.product.price }}</p>
              </div>

              <div class="col-md-2 col-6">
                <div class="d-flex small">
                  <button
                    @click="cartDecrement(cartItem.id)"
                    class="btn btn-outline-primary px-3"
                  >
                    -
                  </button>
                  <input
                    type="text"
                    :id="cartItem.id"
                    :value="cartItem.quantity"
                    placeholder="1"
                    class="pl-3 border"
                    disabled
                    style="width: 50px"
                  />
                  <button
                    @click="cartIncrement(cartItem.id)"
                    class="btn btn-outline-primary px-3"
                  >
                    +
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-4" />
      <h6
        class="heading-small text-muted mb-4 text-right"
        id="password-section"
      >
        Order Summary
      </h6>
      <div class="pl-lg-4">
        <div class="row mb-3">
          <div class="col-12 col-sm-12 col-md-4 ml-auto">
            <form action="" method="POST">
              <div class="d-flex justify-content-between">
                <div>
                  <p>Total:</p>
                </div>
                <div>
                  <p class="h5 text-orange">Rs.{{ cartTotalPrice }}</p>
                </div>
              </div>
              <button class="btn btn-block btn-primary">
                Proceed to checkout
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "my-cart",
  data() {
    return {
      cartItems: [],
      selectedCart: [],
      cartTotalPrice: 0,
    };
  },
  mounted() {
    this.getCartItems();
  },
  computed: {
    totalPrice() {
      let products = this.cartItems
        .filter((cart) => this.selectedCart.includes(cart.id))
        .map((c) => c.price);
    },
  },
  methods: {
    getCartItems() {
      axios
        .get("/cart/api/all")
        .then((res) => res.data)
        .then((data) => {
          this.cartItems = data;
        })
        .catch((e) => console.log(e));
    },

    //select function
    cartSelect(cartId, e) {
      let newCart = this.cartItems.find((cart) => cart.id === cartId);
      if (!e.target.getAttribute("checked")) {
        this.cartTotalPrice += Number(newCart.product.price);

        //selection of item
        this.selectedCart.push(newCart.id);
        e.target.setAttribute("checked", "true");
      } else {
        this.cartTotalPrice =
          Number(this.cartTotalPrice) - Number(newCart.product.price);

        this.selectedCart = this.selectedCart.filter((cart) => cart !== cartId);
        e.target.removeAttribute("checked");
      }
    },

    deleteCart() {
      if (this.selectedCart.length < 0) {
        alert("Please select alteast one item.");
        return;
      }

      axios
        .post("/cart/destroy/selected", { cart: this.selectedCart })
        .then((res) => res.data)
        .then((data) => {
          this.getCartItems();
        });
    },

    cartIncrement(cartId) {
      const cartItem = this.cartItems.find((cart) => cart.id === cartId);
      if (cartItem.quantity < cartItem.product.stock && cartItem.quantity < 5) {
        cartItem.quantity += 1;
        this.cartTotalPrice += Number(cartItem.product.price);
      } else {
        alert("Max reached");
      }
    },
    cartDecrement(cartId) {
      const cartItem = this.cartItems.find((cart) => cart.id === cartId);
      if (cartItem.quantity > 1) {
        cartItem.quantity -= 1;
        this.cartTotalPrice -= Number(cartItem.product.price);
      }
    },
  },
};
</script>

<style scoped>
</style>