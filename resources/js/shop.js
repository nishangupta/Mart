//shop vue components

window.Vue = require("vue");

Vue.component("my-cart", require("./components/MyCart").default);

const app = new Vue({
    el: "#app"
});

//loading js
$(document).ready(function() {
    console.log(1123);
    $("#loaderSvg").remove();
});
