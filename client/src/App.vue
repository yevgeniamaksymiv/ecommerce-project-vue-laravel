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
import HeaderComponent from '@/components/HeaderComponent.vue';
import FooterComponent from '@/components/FooterComponent.vue';
import { mapActions } from 'vuex';
import emitter from 'tiny-emitter/instance';
import pusher from '@/services/pusher';

export default {
  name: 'App',
  components: {
    HeaderComponent,
    FooterComponent
  },

  data() {
    return {
      channel: null,
    }
  },

  created() {
    pusher.connection.bind('connected', () => {
      this.channel = pusher.subscribe('order_pdf');
      this.channel.bind('pdf-created', data => {
        emitter.emit('pdf-url-updated', data.pdf_url);
      });
    });
  },

  methods: {
    ...mapActions(['storePdfPath']),
  },
}

</script>

<style>
body {
  margin: 0;
  padding: 0;
  width: 100vw;
  height: 100vh;
  overflow-x: hidden;
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
