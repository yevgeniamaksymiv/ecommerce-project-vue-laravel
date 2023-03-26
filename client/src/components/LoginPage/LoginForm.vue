<template>
  <el-row>
    <el-col :span="12">
      <div class="form-section">
        <h3>Ви користувач?</h3>
        <el-form label-position="top" ref="formRef" label-width="120px">
          <el-form-item prop="email" label="Електронна пошта">
            <el-input size="large" v-model="loginEmail" />
          </el-form-item>
          <el-form-item label="Пароль" prop="pass">
            <el-input type="password" autocomplete="off" show-password size="large" v-model="loginPassword" />
          </el-form-item>
          <el-button size="large" style="width: 150px;" @click="login" type="primary" plain>
            Увійти
          </el-button>
        </el-form>
      </div>
    </el-col>
    <el-col :span="12" style="background-color: #f3f3f5;">
      <div class="form-section">
        <h3>Це ваш перший візит?</h3>
        <el-form label-position="top" ref="formRef" label-width="120px">
          <el-form-item prop="email" label="Електронна пошта">
            <el-input size="large" v-model="signupEmail" />
          </el-form-item>
          <el-form-item prop="email" label="Ім'я">
            <el-input size="large" v-model="signupName" />
          </el-form-item>
          <el-form-item prop="email" label="Прізвище">
            <el-input size="large" v-model="signupSurname" />
          </el-form-item>
          <el-form-item label="Пароль" prop="pass">
            <el-input type="password" autocomplete="off" show-password size="large" v-model="signupPassword" />
          </el-form-item>
          <el-button size="large" @click="signup" type="info">Зареєструватись</el-button>
        </el-form>
      </div>
    </el-col>
  </el-row>
</template>

<script>

export default {
  name: "LoginForm",

  data() {
    return {
      loginEmail: '',
      loginPassword: '',
      signupEmail: '',
      signupName: '',
      signupSurname: '',
      signupPassword: '',
    }
  },

  methods: {
    login() {

    },

    signup() {

    }
  }
}
</script>

<style>
.form-section {
  padding: 60px 100px;
}
</style>