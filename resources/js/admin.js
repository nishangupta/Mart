// admin panel sidebar jquery
require("./admin-utils");

//admin vue components

window.Vue = require("vue");

Vue.component("image-upload", require("./components/ImageUpload").default);

const app = new Vue({
    el: "#app"
});
