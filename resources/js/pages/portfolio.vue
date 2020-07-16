<template>
  <div>
    <div class="mb-4 d-flex">
      <h4 class="flex-grow-1">PORTFOLIO</h4>
      <el-button
        type="primary"
        size="small"
        icon="el-icon-plus"
        @click="() => { formModel = {}; showForm = true; imageUrl = ''; }"
      >ADD PORTFOLIO</el-button>
    </div>

    <el-table :data="portfolios">
      <el-table-column label="Image" width="150">
        <template slot-scope="scope">
          <el-image style="height: 50px;" :src="scope.row.image_url" fit="scale-down"></el-image>
        </template>
      </el-table-column>
      <el-table-column label="Description">
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
      title="FORM PORTFOLIO"
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
        <el-form-item label="Image">
          <el-upload
            class="avatar-uploader"
            action="/upload"
            with-credentials
            :show-file-list="false"
            :on-success="handleUploadSuccess"
            :headers="{ 'X-Requested-With': 'XMLHttpRequest' }"
          >
            <el-image style="height: 50px;" v-if="imageUrl" :src="imageUrl" fit="scale-down"></el-image>
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
          </el-upload>
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
      portfolios: [],
      formModel: {},
      formError: {},
      showForm: false,
      imageUrl: ""
    };
  },
  created() {
    this.getData();
  },
  methods: {
    handleUploadSuccess(res, file) {
      this.imageUrl = URL.createObjectURL(file.raw);
      this.formModel.attachment = res;
    },
    getData() {
      axios.get("portfolio").then(r => (this.portfolios = r.data));
    },
    edit(data) {
      this.formModel = JSON.parse(JSON.stringify(data));
      this.showForm = true;
      this.imageUrl = data.image_url;
    },
    save() {
      if (this.formModel.id) this.update();
      else this.store();
    },
    store() {
      axios
        .post("portfolio", this.formModel)
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
        .put(`portfolio/${this.formModel.id}`, this.formModel)
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
            .delete(`portfolio/${id}`)
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

<style lang="css" scoped>
.avatar-uploader {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  width: 150px;
}
.avatar-uploader .el-upload:hover {
  border-color: #409eff;
}
.avatar-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 150px;
  height: 150px;
  line-height: 150px;
  text-align: center;
}
</style>
