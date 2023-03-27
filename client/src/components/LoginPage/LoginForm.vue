<template>
  <el-row>
    <el-col :span="12">
      <div class="form-section">
        <h3>Ви користувач?</h3>
        <el-form label-position="top" ref="formRef" label-width="120px">
          <el-form-item prop="email" label="Електронна пошта">
            <el-input size="large" v-model="loginEmail" />
            <el-text class="mx-1" type="danger" v-text="errorsLogin.email"></el-text>
          </el-form-item>
          <el-form-item label="Пароль" prop="pass">
            <el-input type="password" autocomplete="off" show-password size="large" v-model="loginPassword" />
            <el-text class="mx-1" type="danger" v-text="errorsLogin.password"></el-text>
          </el-form-item>
          <el-text class="mx-1" type="danger" v-text="errorFormLogin"></el-text>
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
            <el-text class="mx-1" type="danger" v-text="errorsSignup.email"></el-text>
          </el-form-item>
          <el-form-item prop="email" label="Ім'я">
            <el-input size="large" v-model="signupName" />
            <el-text class="mx-1" type="danger" v-text="errorsSignup.name"></el-text>
          </el-form-item>
          <el-form-item prop="email" label="Прізвище">
            <el-input size="large" v-model="signupSurname" />
            <el-text class="mx-1" type="danger" v-text="errorsSignup.surname"></el-text>
          </el-form-item>
          <el-form-item label="Пароль" prop="pass">
            <el-input type="password" autocomplete="off" show-password size="large" v-model="signupPassword" />
            <el-text class="mx-1" type="danger" v-text="errorsSignup.password"></el-text>
          </el-form-item>
          <el-button size="large" @click="signup" type="info">Зареєструватись</el-button>
        </el-form>
      </div>
    </el-col>
  </el-row>
</template>

<script>
import axiosBase from '@/axios-config';

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
      errorsLogin: {},
      errorFormLogin: '',
      errorsSignup: {}
    }
  },

  methods: {
    login() {
      axiosBase.post('/api/users/login', this.loginFormData)
        .then(response => {
          if (response.status === 200) {
            this.$router.push({
              name: 'home'
            });
          }
        })
        .catch(error => {
          this.errorFormLogin = error.response['data']['error'];
        })
    },

    signup() {
      axiosBase.post('/api/users/register', this.signupFormData)
        .then(response => {
          console.log(response.data.data['name'])
          if (response.status === 200) {
            this.$router.push({
              name: 'home'
            });
          }
        })
        .catch(error => {
          this.errorsSignup = error.response['data']['errors'];
        })
    }
  },

  computed: {
    signupFormData() {
      return {
        name: this.signupName,
        surname: this.signupSurname,
        email: this.signupEmail,
        password: this.signupPassword,
      }
    },

    loginFormData() {
      return {
        email: this.loginEmail,
        password: this.loginPassword,
      }
    },
  }
}
</script>

<style>
.form-section {
  padding: 60px 100px;
}
</style>