<template>
  <div class="common-layout">
    <el-container>
      <el-header style="--el-header-height: 100px;">
        <HeaderComponent />
      </el-header>
      <el-main>
        <router-view></router-view>
      </el-main>
      <el-footer class="footer" style="--el-footer-height: 120px;">
        <FooterComponent />
      </el-footer>
    </el-container>
  </div>
</template>

<script>
import HeaderComponent from '@/components/HeaderComponent.vue'
import FooterComponent from '@/components/FooterComponent.vue'


export default {
  name: 'App',
  components: {
    HeaderComponent,
    FooterComponent
  }
}
</script>

<style>
body {
  margin: 0;
  padding: 0;
  width: 100vw;
  height: 100vh;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

.el-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.footer {
  margin-top: auto;
  width: 100%;
  height: 120px;
  line-height: 120px;
  background-color: #f3f3f5;
}
</style>
