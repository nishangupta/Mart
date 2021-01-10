<template>
  <div
    class="modal fade"
    id="loginModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    v-show="show"
    ref="modal"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <h5 class="font-weight-light text-center">
          Login/Register to your account
        </h5>
        <div v-if="tryLogin">
          <!-- <form action="/login" method="POST"> -->
          <div class="form-group">
            <label class="small" for="">Email Address*</label>
            <input
              type="email"
              placeholder="E-mail address"
              class="form-control"
              name="email"
              v-model="login.email"
              required
            />
          </div>
          <div class="form-group">
            <label class="small" for="">Password*</label>
            <input
              type="password"
              name="password"
              v-model="login.password"
              placeholder="Password Minimum 8 characters"
              class="form-control"
              required
            />
          </div>

          <button @click.prevent="loginUser" class="btn btn-orange btn-block">
            Login
          </button>

          <div class="my-2">
            <span
              >Don't have a account?
              <button
                @click="() => (tryLogin = false)"
                class="btn btn-secondary btn-sm"
              >
                Register
              </button>
            </span>
          </div>

          <p class="text-center">or</p>

          <div class="my-4">
            <a href="#loginUsingFacebook" class="btn btn-block btn-facebook"
              >Facebook</a
            >
            <a href="#loginUsingGoogle" class="btn btn-block btn-google"
              >Google</a
            >
          </div>
          <!-- </form> -->
        </div>

        <!-- register modal -->
        <div v-else>
          <!-- <form action="/register" method="POST"> -->
          <div class="form-group">
            <label class="small" for="">Name*</label>
            <input
              type="text"
              name="name"
              v-model="register.name"
              placeholder="Your name"
              class="form-control"
              required
            />
          </div>
          <div class="form-group">
            <label class="small" for="">Email Address*</label>
            <input
              type="email"
              placeholder="E-mail address"
              class="form-control"
              name="email"
              v-model="register.email"
              required
              autocomplete="email"
            />
          </div>
          <div class="form-group">
            <label class="small" for="">Password*</label>
            <input
              type="password"
              name="password"
              v-model="register.password"
              placeholder="Password Minimum 8 characters"
              class="form-control"
              required
            />
          </div>

          <button
            @click.prevent="registerUser"
            class="btn btn-orange btn-block"
          >
            Register
          </button>

          <div class="my-2">
            <span
              >Already have an account ?
              <button
                class="btn btn-secondary btn-sm"
                @click="() => (tryLogin = true)"
              >
                login
              </button>
            </span>
          </div>

          <p class="text-center">or</p>

          <div class="my-4">
            <a href="#loginUsingFacebook" class="btn btn-block btn-facebook"
              >Facebook</a
            >
            <a href="#loginUsingGoogle" class="btn btn-block btn-google"
              >Google</a
            >
          </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tryLogin: true,
      login: {
        email: "",
        password: "",
      },
      register: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  props: ["show"],
  methods: {
    loginUser() {
      let obj = { email: this.login.email, password: this.login.password };
      axios({
        method: "post",
        url: "/login",
        data: obj,
        headers: {
          "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        },
      })
        .then(function (response) {
          //handle success
          console.log(response);
        })
        .catch(function (response) {
          //handle error
          console.log(response);
        });
    },
    registerUser() {
      let obj = {
        name: this.register.name,
        email: this.register.email,
        password: this.register.password,
      };
      axios({
        method: "post",
        url: "/register",
        data: obj,
        headers: {
          "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        },
      })
        .then(function (response) {
          //handle success
          console.log(response);
        })
        .catch(function (response) {
          //handle error
          console.log(response);
        });
    },
  },
  watch: {
    show: function (newVal, oldVal) {
      $("#loginModal").modal("show");
    },
  },
};
</script>

<style lang="scss" scoped>
.container {
  padding: 2rem 0rem;
}

@media (min-width: 576px) {
  .modal-dialog {
    max-width: 400px;

    .modal-content {
      padding: 1rem;
    }
  }
}

.modal-header {
  .close {
    margin-top: -1.5rem;
  }
}

.form-title {
  margin: -2rem 0rem 2rem;
}

.btn-round {
  border-radius: 3rem;
}

.delimiter {
  padding: 1rem;
}

.social-buttons {
  .btn {
    margin: 0 0.5rem 1rem;
  }
}

.signup-section {
  padding: 0.3rem 0rem;
}
</style>