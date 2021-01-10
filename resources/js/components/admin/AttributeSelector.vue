<template>
  <div class="form-group mb-4">
    <p class="h5 mb-4 text-primary">
      Here you can add the attributes of this product such as size,color
    </p>
    <input type="hidden" name="attr" :value="finalValue" />

    <div class="row py-2 my-2" ref="attrEditor">
      <div class="col-1">
        <label for="">Live</label>
        <select v-model="live" class="form-control">
          <option value="1" :selected="live">On</option>
          <option value="0" :selected="!live">Off</option>
        </select>
      </div>

      <div class="col-3">
        <label for="">Type</label>

        <input
          type="text"
          class="form-control"
          v-model="type"
          placeholder="type"
        />
      </div>
      <div class="col-3">
        <label for="">Attribute</label>

        <input
          type="text"
          class="form-control"
          v-model="attribute"
          placeholder="attribute"
        />
      </div>
      <div class="col-3">
        <label for="">Stock</label>

        <input
          type="number"
          class="form-control"
          v-model="stock"
          placeholder="stock"
        />
      </div>

      <div class="col-2">
        <button
          class="btn btn-success btn-sm btn-block"
          @click.prevent="addAttribute"
          :disabled="!updateDisabled"
        >
          Add
        </button>
        <button
          class="btn btn-info btn-sm float-left btn-block w-50"
          @click.prevent="updateAttribute"
          :disabled="updateDisabled"
        >
          Update
        </button>
        <button
          class="btn btn-danger btn-sm float-right btn-block w-50"
          @click.prevent="cancelUpdate"
          :disabled="updateDisabled"
        >
          Cancel
        </button>
      </div>
    </div>

    <br /><br />

    <p>Attributes of this product</p>
    <div class="attribute-box my-2">
      <div class="table-responsive">
        <table class="table table-hover small">
          <thead>
            <tr>
              <th>Available</th>
              <th>Type</th>
              <th>Attribute</th>
              <th>Stock</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody ref="tbody">
            <!-- <tr>
              <td>
                <div class="custom-control custom-switch">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    name="live"
                    id="productAvailability"
                  />
                  <label class="custom-control-label" for="productAvailability"
                    >Live</label
                  >
                </div>
              </td>

              <td>
                <input type="text" class="form-control" v-model="type" />
              </td>
              <td>
                <input type="text" class="form-control" v-model="attribute" />
              </td>

              <td>
                <input type="number" class="form-control" v-model="stock" />
              </td>
              <td>
                <button
                  class="btn btn-success btn-sm btn-block"
                  @click.prevent="addAttribute"
                >
                  +
                </button>
              </td>
            </tr> -->

            <!-- looped table rows -->
            <tr v-for="row in attrRows" :key="row.uid">
              <td>
                <span
                  :class="
                    'btn btn-sm disabled ' +
                    [row.live ? 'btn-success' : 'btn-danger']
                  "
                >
                  {{ row.live ? "on" : "off" }}
                </span>
              </td>
              <td>
                <input
                  type="text"
                  class="form-control"
                  :value="row.type"
                  disabled
                />
              </td>
              <td>
                <input
                  type="text"
                  class="form-control"
                  :value="row.attribute"
                  disabled
                />
              </td>
              <td>
                <input
                  type="number"
                  class="form-control"
                  :value="row.stock"
                  disabled
                />
              </td>
              <td>
                <button
                  class="btn btn-info btn-sm btn-block"
                  @click.prevent="editRow(row.uid)"
                >
                  Edit
                </button>
                <button
                  class="btn btn-danger btn-sm btn-block"
                  @click.prevent="deleteRow(row.uid)"
                  :disabled="!updateDisabled"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      attrRows: [],
      type: "",
      attribute: "",
      stock: "",
      live: 1,
      updateDisabled: true,
      selectedUid: "",
      finalValue: "",
    };
  },
  props: {
    attributes: {
      type: Array, //here we get the attributes array from backend
    },
  },
  mounted() {
    if (this.attributes.length) {
      this.attrRows = this.attributes;
      this.save();
    }
  },
  methods: {
    addAttribute() {
      let uid = Math.floor(1000 + Math.random() * 900000);

      if (this.type == "" || this.attribute == "" || this.stock == "") {
        alert("You need to fill the attrribute boxes");
        return;
      }

      let data = {
        uid: uid,
        type: this.type,
        attribute: this.attribute,
        stock: this.stock,
        live: 1,
      };

      this.attrRows.push(data);
      //saving the new values
      this.save();

      this.clearInputs();
    },

    deleteRow(id) {
      if (confirm("Are you sure to delete?")) {
        this.attrRows = this.attrRows.filter((item) => item.uid !== id);
      }

      this.save();
      return;
    },

    editRow(id) {
      const row = this.attrRows.find((el) => el.uid == id);

      //selecting the editing uid
      this.selectedUid = row.uid;

      this.type = row.type;
      this.attribute = row.attribute;
      this.stock = row.stock;
      this.live = row.live;
      this.updateDisabled = false;
    },

    updateAttribute() {
      const row = this.attrRows.find((el) => el.uid == this.selectedUid);

      //updating the selected row
      this.attrRows.filter((el) => {
        if (el.uid == this.selectedUid) {
          el.type = this.type;
          el.attribute = this.attribute;
          el.stock = this.stock;

          el.live = Number(this.live);
        }
      });

      //saving the new values
      this.save();

      this.clearInputs();
      this.updateDisabled = true;
    },

    cancelUpdate() {
      this.clearInputs();
      this.updateDisabled = true;
    },

    save() {
      this.finalValue = JSON.stringify(this.attrRows);
    },
    clearInputs() {
      this.type = "";
      this.attribute = "";
      this.stock = "";
      this.live = "";
      this.selectedUid = null;
    },
  },
};
</script>

<style scoped>
</style>