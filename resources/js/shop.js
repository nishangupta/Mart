//shop vue components

window.Vue = require("vue");

Vue.component("my-cart", require("./components/MyCart").default);
Vue.component("product-show", require("./components/ProductShow").default);

const app = new Vue({
    el: "#app"
});

//loading js
$(document).ready(function() {
    $("#loaderSvg").remove();
});
