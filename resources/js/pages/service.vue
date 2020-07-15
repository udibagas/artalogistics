<template>
  <div>
    <div class="mb-4 d-flex">
      <h4 class="flex-grow-1">SERVICES</h4>
      <el-button
        type="primary"
        size="small"
        icon="el-icon-plus"
        @click="() => { formModel = {}; showForm = true; imageUrl = ''; }"
      >ADD SERVICE</el-button>
    </div>

    <el-table :data="services">
      <el-table-column label="Icon" width="100">
        <template slot-scope="scope">
          <i :class="scope.row.icon" style="font-size:30px"></i>
        </template>
      </el-table-column>
      <el-table-column label="Title">
        <template slot-scope="scope">
          <strong>{{scope.row.title}}</strong>
          <div class="text-muted">{{scope.row.description}}</div>
        </template>
      </el-table-column>
      <el-table-column width="100" align="center">
        <template slot="header">
          <el-button icon="el-icon-refresh" type="text" @click="getData"></el-button>
        </template>
        <template slot-scope="scope">
          <el-button icon="el-icon-edit" type="text" @click="edit(scope.row)"></el-button>
          <el-button icon="el-icon-delete" type="text" @click="del(scope.row.id)"></el-button>
        </template>
      </el-table-column>
    </el-table>

    <el-dialog
      :visible.sync="showForm"
      title="FORM SERVICE"
      :before-close="(done) => { formError = {}; done(); }"
      :close-on-click-modal="false"
    >
      <el-form label-position="left" label-width="150px">
        <el-form-item label="Title" :class="formError.title ? 'is-error' : ''">
          <el-input placeholder="Title" v-model="formModel.title"></el-input>
          <div class="el-form-item__error" v-if="formError.title">{{formError.title.join(', ')}}</div>
        </el-form-item>
        <el-form-item label="Description" :class="formError.description ? 'is-error' : ''">
          <el-input
            type="textarea"
            autosize
            placeholder="Description"
            v-model="formModel.description"
          ></el-input>
          <div
            class="el-form-item__error"
            v-if="formError.description"
          >{{formError.description.join(', ')}}</div>
        </el-form-item>
        <el-form-item label="Icon" :class="formError.icon ? 'is-error' : ''">
          <el-input placeholder="Icon" v-model="formModel.icon" :suffix-icon="formModel.icon"></el-input>
          <div class="el-form-item__error" v-if="formError.icon">{{formError.icon.join(', ')}}</div>
        </el-form-item>
      </el-form>

      <div slot="footer">
        <el-button type="text" @click="() => { showForm = false; formError = {}; }">CANCEL</el-button>
        <el-button type="primary" @click="save">SAVE</el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>
export default {
  data() {
    return {
      services: [],
      formModel: {},
      formError: {},
      showForm: false
    };
  },
  created() {
    this.getData();
  },
  methods: {
    getData() {
      axios.get("service").then(r => (this.services = r.data));
    },
    edit(data) {
      this.formModel = JSON.parse(JSON.stringify(data));
      this.showForm = true;
    },
    save() {
      if (this.formModel.id) this.update();
      else this.store();
    },
    store() {
      axios
        .post("service", this.formModel)
        .then(r => {
          this.$message({
            message: r.data.message,
            type: "success",
            showClose: true,
            duration: 10000
          });
          this.showForm = false;
          this.getData();
        })
        .catch(e => {
          this.$message({
            message: e.response.data.message,
            type: "error",
            showClose: true,
            duration: 10000
          });

          if (e.response.status == 422) this.formError = e.response.data.errors;
        });
    },
    update() {
      axios
        .put(`service/${this.formModel.id}`, this.formModel)
        .then(r => {
          this.$message({
            message: r.data.message,
            type: "success",
            showClose: true,
            duration: 10000
          });
          this.showForm = false;
          this.getData();
        })
        .catch(e => {
          this.$message({
            message: e.response.data.message,
            type: "error",
            showClose: true,
            duration: 10000
          });

          if (e.response.status == 422) this.formError = e.response.data.errors;
        });
    },
    del(id) {
      this.$confirm("Are you sure?", "Warning", { type: "warning" })
        .then(() => {
          axios
            .delete(`service/${id}`)
            .then(r => {
              this.$message({
                message: r.data.message,
                type: "success",
                showClose: true,
                duration: 10000
              });
              this.getData();
            })
            .catch(e => {
              this.$message({
                message: e.response.data.message,
                type: "error",
                showClose: true,
                duration: 10000
              });
            });
        })
        .catch(e => console.log(e));
    }
  }
};
</script>
