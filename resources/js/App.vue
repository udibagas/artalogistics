<template>
  <el-container>
    <el-aside :width="collapse ? 'auto' : '200px'">
      <el-menu
        :collapse="collapse"
        router
        background-color="#545c64"
        text-color="#fff"
        active-text-color="#ffd04b"
      >
        <el-menu-item v-for="(m, i) in menus" :index="m.path" :key="i">
          <i :class="m.icon"></i>
          <span slot="title">{{m.label}}</span>
        </el-menu-item>
      </el-menu>
    </el-aside>
    <el-main>
      <router-view></router-view>
    </el-main>
  </el-container>
</template>

<script>
export default {
  data() {
    return {
      collapse: false,
      menus: [
        { label: "Dashboard", path: "/", icon: "el-icon-s-home" },
        { label: "About", path: "/about", icon: "el-icon-s-home" },
        { label: "Services", path: "/service", icon: "el-icon-s-home" },
        { label: "Call to Action", path: "/cta", icon: "el-icon-s-home" },
        { label: "Features", path: "/features", icon: "el-icon-s-home" },
        { label: "Client", path: "/client", icon: "el-icon-s-home" },
        { label: "Counter", path: "/counter", icon: "el-icon-s-home" },
        { label: "Portfolio", path: "/portfolio", icon: "el-icon-s-home" },
        { label: "Pricing", path: "/pricing", icon: "el-icon-s-home" },
        { label: "FAQ", path: "/faq", icon: "el-icon-s-home" },
        { label: "Contact", path: "/contact", icon: "el-icon-s-home" },
        { label: "User", path: "/user", icon: "el-icon-user" }
      ]
    };
  }
};
</script>

<style lang="scss" scoped>
.el-menu {
  height: calc(100vh - 55px);
}
</style>
