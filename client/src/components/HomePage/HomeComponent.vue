<template>
  <div>
    <el-container>
      <el-header>
        <HeaderComponent />
      </el-header>
      <el-main>
        <MainComponent />
      </el-main>
      <el-footer>
        <FooterComponent />
      </el-footer>
    </el-container>
  </div>
</template>

<script>
import MainComponent from '@/components/HomePage/MainComponent.vue'
import HeaderComponent from '@/components/HomePage/HeaderComponent.vue'
import FooterComponent from '@/components/HomePage/FooterComponent.vue'

export default {
  name: 'HomeComponent',
  components: {
    HeaderComponent,
    MainComponent,
    FooterComponent
  }
}
</script>