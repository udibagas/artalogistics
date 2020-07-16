<template>
  <div>
    <div class="mb-4 d-flex">
      <h4 class="flex-grow-1">FAQS</h4>
      <el-button
        type="primary"
        size="small"
        icon="el-icon-plus"
        @click="() => { formModel = {}; showForm = true; imageUrl = ''; }"
      >ADD FAQ</el-button>
    </div>

    <el-table :data="faqs">
      <el-table-column label="FAQ">
        <template slot-scope="scope">
          <strong>{{scope.row.question}}</strong>
          <div class="text-muted">{{scope.row.answer}}</div>
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
      title="FORM FAQ"
      :before-close="(done) => { formError = {}; done(); }"
      :close-on-click-modal="false"
    >
      <el-form label-position="left" label-width="150px">
        <el-form-item label="Question" :class="formError.question ? 'is-error' : ''">
          <el-input placeholder="Question" v-model="formModel.question"></el-input>
          <div
            class="el-form-item__error"
            v-if="formError.question"
          >{{formError.question.join(', ')}}</div>
        </el-form-item>
        <el-form-item label="Answer" :class="formError.answer ? 'is-error' : ''">
          <el-input
            type="textarea"
            placeholder="Answer"
            v-model="formModel.answer"
            :autosize="{ minRows: 4}"
          ></el-input>
          <div class="el-form-item__error" v-if="formError.answer">{{formError.answer.join(', ')}}</div>
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
      faqs: [],
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
      axios.get("faq").then(r => (this.faqs = r.data));
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
        .post("faq", this.formModel)
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
        .put(`faq/${this.formModel.id}`, this.formModel)
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
            .delete(`faq/${id}`)
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
