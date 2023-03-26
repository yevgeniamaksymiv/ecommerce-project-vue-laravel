<template>
 <div>
      <el-container>
        <el-header>
          <HeaderComponent />
        </el-header>
        <el-main>
          <LoginForm />
        </el-main>
        <el-footer>
          <FooterComponent />
        </el-footer>
      </el-container>
    </div>
</template>

<script>
import HeaderComponent from '@/components/HomePage/HeaderComponent.vue';
import LoginForm from '@/components/LoginPage/LoginForm.vue';
import FooterComponent from '@/components/HomePage/FooterComponent.vue';

export default {
  name: "LoginComponent",
  components: {
    HeaderComponent,
    LoginForm,
    FooterComponent
  }
}
</script>