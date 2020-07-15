<template>
  <div>
    <div class="d-flex mb-4">
      <h5 class="text-muted flex-grow-1">MANAGE USER</h5>
      <el-button
        type="primary"
        size="small"
        icon="el-icon-plus"
        @click="() => { formModel = {}, showForm = true; }"
      >ADD USER</el-button>
    </div>
    <el-table :data="users">
      <el-table-column type="index" label="#"></el-table-column>
      <el-table-column prop="name" label="Name"></el-table-column>
      <el-table-column prop="email" label="Email"></el-table-column>
      <el-table-column prop="role_name" label="Role"></el-table-column>
      <!-- <el-table-column prop="status" label="Status"></el-table-column> -->
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
      title="USER FORM"
      :before-close="(done) => { formError = {}; done(); }"
      :close-on-click-modal="false"
    >
      <el-form label-position="left" label-width="150px">
        <el-form-item label="Name" :class="formError.name ? 'is-error' : ''">
          <el-input placeholder="Name" v-model="formModel.name"></el-input>
          <div class="el-form-item__error" v-if="formError.name">{{formError.name.join(', ')}}</div>
        </el-form-item>
        <el-form-item label="Email" :class="formError.email ? 'is-error' : ''">
          <el-input placeholder="Email" v-model="formModel.email"></el-input>
          <div class="el-form-item__error" v-if="formError.email">{{formError.email.join(', ')}}</div>
        </el-form-item>
        <el-form-item label="Role" :class="formError.role ? 'is-error' : ''">
          <el-select v-model="formModel.role" placeholder="Role" style="width:100%">
            <el-option :value="0" label="User"></el-option>
            <el-option :value="1" label="Editor"></el-option>
            <el-option :value="2" label="Admin"></el-option>
          </el-select>
          <div class="el-form-item__error" v-if="formError.role">{{formError.role.join(', ')}}</div>
        </el-form-item>
        <el-form-item label="Password" :class="formError.password ? 'is-error' : ''">
          <el-input type="password" placeholder="Password" v-model="formModel.password"></el-input>
          <div
            class="el-form-item__error"
            v-if="formError.password"
          >{{formError.password.join(', ')}}</div>
        </el-form-item>
        <el-form-item label="Confirm Password" :class="formError.password ? 'is-error' : ''">
          <el-input
            type="password"
            placeholder="Confirm Password"
            v-model="formModel.password_confirmation"
          ></el-input>
          <div
            class="el-form-item__error"
            v-if="formError.password"
          >{{formError.password.join(', ')}}</div>
        </el-form-item>
        <!-- <el-form-item label="Status">
          <el-checkbox v-model="formModel.status">Active</el-checkbox>
        </el-form-item>-->
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
      users: [],
      showForm: false,
      formModel: {},
      formError: {}
    };
  },
  created() {
    this.getData();
  },
  methods: {
    getData() {
      axios.get("user").then(r => (this.users = r.data));
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
        .post("/user", this.formModel)
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
        .put(`/user/${this.formModel.id}`, this.formModel)
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
            .delete(`/user/${id}`)
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

<style lang="scss" scoped>
</style>
