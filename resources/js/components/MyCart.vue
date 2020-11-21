<template>
  <div class="card shadow">
    <div class="card-header bg-light border-bottom">
      <p class="mb-0">My Cart</p>
    </div>

    <div class="card-body" v-if="cartItems.length">
      <div class="row">
        <div class="col-12 bg-light">
          <div class="d-flex justify-content-between">
            <p>Select items</p>
            <div>
              <button type="submit" class="btn" @click.prevent="deleteCart">
                <span
                  class="spinner-grow spinner-grow-sm"
                  role="status"
                  aria-hidden="true"
                  v-if="deleteLoading"
                ></span>
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

              <div class="col-md-1 col-2">
                <img
                  :src="cartItem.product.get_image[0].original"
                  class="img-fluid"
                  alt="Product"
                />
              </div>

              <div class="col-md-4 col-9">
                <a
                  :href="
                    'shop/' + cartItem.product.id + '-' + cartItem.product.slug
                  "
                  target="_blank"
                >
                  <p class="text-grey-800">{{ cartItem.product.title }}</p>
                </a>
              </div>

              <div class="col-md-2 col-6 mt-sm-2 mt-md-0">
                <p class="text-orange h5">
                  Rs.{{
                    cartItem.product.onSale
                      ? cartItem.product.sale_price
                      : cartItem.product.price
                  }}
                </p>
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
            <div class="d-flex justify-content-between">
              <div>
                <p>Total:</p>
              </div>
              <div>
                <p class="h5 text-orange">Rs.{{ cartTotalPrice }}</p>
              </div>
            </div>
            <button
              class="btn btn-block btn-primary"
              data-toggle="modal"
              data-target="#checkoutModal"
              @click.prevent="proceedToCheckout"
            >
              Proceed to checkout
            </button>
          </div>
        </div>
      </div>
    </div>
    <empty-cart v-else></empty-cart>

    <div
      class="modal fade"
      id="checkoutModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="checkoutModalTitle"
      aria-hidden="true"
      v-if="showModal"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Place order</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/order" method="POST">
            <div class="modal-body">
              <h5>Product name: {{ modalProduct.title }}</h5>
              <h6>Product quantity: {{ modalProduct.quantity }}</h6>
              <input type="hidden" name="_token" :value="csrf" />
              <input
                type="hidden"
                name="cart_id"
                :value="modalProduct.cartId"
              />
              <input
                type="hidden"
                name="quantity"
                :value="modalProduct.quantity"
              />
              <h6>
                Product price:
                <span class="text-orange">Rs. {{ modalProduct.price }}</span>
              </h6>
              <h6>
                Shipping cost:
                <span class="text-orange">Rs. 100</span>
              </h6>
              <h6>
                Total shipping fee:
                <span class="text-orange"
                  >Rs. {{ Number(modalProduct.price) + 100 }}</span
                >
              </h6>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary">
                Place order now
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import EmptyCart from "./EmptyCart";
export default {
  name: "my-cart",
  data() {
    return {
      cartItems: [],
      selectedCart: [],
      cartTotalPrice: 0,
      modalProduct: {
        cartId: null,
        quantity: 0,
        title: 0,
        price: 0,
      },
      showModal: false,
      deleteLoading: false,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  components: {
    EmptyCart,
  },
  mounted() {
    this.getCartItems();
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
        if (newCart.product.onSale) {
          this.cartTotalPrice += Number(
            newCart.product.sale_price * newCart.quantity
          );
        } else {
          this.cartTotalPrice += Number(
            newCart.product.price * newCart.quantity
          );
        }

        //selection of item
        this.selectedCart.push(newCart.id);
        e.target.setAttribute("checked", "true");
      } else {
        if (newCart.product.onSale) {
          this.cartTotalPrice -= Number(
            newCart.product.sale_price * newCart.quantity
          );
        } else {
          this.cartTotalPrice -= Number(
            newCart.product.price * newCart.quantity
          );
        }

        this.selectedCart = this.selectedCart.filter((cart) => cart !== cartId);
        e.target.removeAttribute("checked");
      }
    },

    deleteCart() {
      this.deleteLoading = true;
      if (this.selectedCart.length < 1) {
        alert("Please select atleast one item.");
        return;
      }

      axios
        .post("/cart/destroy/selected", { cart: this.selectedCart })
        .then((res) => res.data)
        .then((data) => {
          this.getCartItems();
          this.deleteLoading = false;
          this.selectedCart = [];
          this.cartTotalPrice = 0;
        })
        .catch((e) => {
          console.log(e);
          this.getCartItems();
          this.selectedCart = [];
          this.deleteLoading = false;
        });
    },

    cartIncrement(cartId) {
      const cartItem = this.cartItems.find((cart) => cart.id === cartId);
      if (cartItem.quantity < cartItem.product.stock && cartItem.quantity < 5) {
        cartItem.quantity += 1;

        if (this.selectedCart.includes(cartId)) {
          if (cartItem.product.onSale) {
            this.cartTotalPrice += Number(cartItem.product.sale_price);
          } else {
            this.cartTotalPrice += Number(cartItem.product.price);
          }
        }
      } else {
        alert("Max reached");
      }
    },
    cartDecrement(cartId) {
      const cartItem = this.cartItems.find((cart) => cart.id === cartId);
      if (cartItem.quantity > 1) {
        cartItem.quantity -= 1;
        if (this.selectedCart.includes(cartId)) {
          if (cartItem.product.onSale) {
            this.cartTotalPrice -= Number(cartItem.product.sale_price);
          } else {
            this.cartTotalPrice -= Number(cartItem.product.price);
          }
        }
      }
    },
    proceedToCheckout() {
      if (this.selectedCart.length !== 1) {
        alert("Please select exactly one item to checkout");
        this.showModal = false;
        return;
      }
      this.showModal = true;

      const cart = this.cartItems.find(
        (cart) => cart.id === this.selectedCart[0]
      );
      this.modalProduct.cartId = cart.id;
      this.modalProduct.title = cart.product.title;
      this.modalProduct.quantity = cart.quantity;
      this.modalProduct.price = this.cartTotalPrice;
    },
  },
};
</script>

<style scoped>
</style>