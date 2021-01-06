// admin panel sidebar jquery
require("./admin-utils");

//admin vue components

window.Vue = require("vue");

Vue.component(
    "image-upload",
    require("./components/admin/ImageUpload").default
);
Vue.component(
    "product-images",
    require("./components/admin/ProductImages").default
);
Vue.component(
    "category-management",
    require("./components/admin/CategoryManagement").default
);

const app = new Vue({
    el: "#app"
});
