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
    "category-selector",
    require("./components/admin/CategorySelector").default
);

Vue.component(
    "attribute-selector",
    require("./components/admin/AttributeSelector").default
);

const app = new Vue({
    el: "#app"
});
