// admin panel sidebar jquery
require("./admin-utils");

//admin vue components

window.Vue = require("vue");

Vue.component("image-upload", require("./components/ImageUpload").default);
Vue.component("product-images", require("./components/ProductImages").default);

const app = new Vue({
    el: "#app"
});
