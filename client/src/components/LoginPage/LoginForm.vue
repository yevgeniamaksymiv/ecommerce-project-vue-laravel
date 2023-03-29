<template>
  <el-row>
    <el-col :span="12">
      <div class="form-section">
        <h3>Ви користувач?</h3>
        <el-form label-position="top" ref="loginFormRef" label-width="120px">
          <el-form-item prop="email" label="Електронна пошта">
            <el-input size="large" v-model="loginForm.email" />
            <el-text class="mx-1" type="danger" v-for="error of loginFormRef.loginForm.email.$errors" :key="error.$uid">{{
              error.$message }}</el-text>
          </el-form-item>
          <el-form-item label="Пароль" prop="pass">
            <el-input type="password" autocomplete="off" show-password size="large" v-model="loginForm.password" />
            <el-text class="mx-1" type="danger" v-for="error of loginFormRef.loginForm.password.$errors"
              :key="error.$uid">{{ error.$message }}</el-text>
          </el-form-item>
          <el-text class="mx-1" type="danger">{{ this.getErrorLogin }}</el-text>
          <el-button size="large" style="width: 150px;" @click="loginFormSubmit" type="primary" plain>
            Увійти
          </el-button>
        </el-form>
      </div>
    </el-col>

    <el-col :span="12" style="background-color: #f3f3f5;">
      <div class="form-section">
        <h3>Це ваш перший візит?</h3>
        <el-form label-position="top" ref="signupFormRef" label-width="120px">
          <el-form-item prop="email" label="Електронна пошта">
            <el-input size="large" v-model="signupForm.email" />
            <el-text class="mx-1" type="danger" v-for="error of signupFormRef.signupForm.email.$errors"
              :key="error.$uid">{{ error.$message }}</el-text>
          </el-form-item>
          <el-form-item prop="email" label="Ім'я">
            <el-input size="large" v-model="signupForm.name" />
            <el-text class="mx-1" type="danger" v-for="error of signupFormRef.signupForm.name.$errors" :key="error.$uid">
              {{ error.$message }}</el-text>
          </el-form-item>
          <el-form-item prop="email" label="Прізвище">
            <el-input size="large" v-model="signupForm.surname" />
            <el-text class="mx-1" type="danger" v-for="error of signupFormRef.signupForm.surname.$errors"
              :key="error.$uid">{{ error.$message }}</el-text>
          </el-form-item>
          <el-form-item label="Пароль" prop="pass">
            <el-input type="password" autocomplete="off" show-password size="large" v-model="signupForm.password" />
            <el-text class="mx-1" type="danger" v-for="error of signupFormRef.signupForm.password.$errors"
              :key="error.$uid">{{ error.$message }}</el-text>
          </el-form-item>
          <el-text class="mx-1" type="danger">{{ this.getErrorSignup }}</el-text>
          <el-button size="large" type="info" @click="signupFormSubmit">Зареєструватись</el-button>
        </el-form>
      </div>
    </el-col>
  </el-row>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import useValidate from '@vuelidate/core';
import { required, minLength, maxLength, email } from '@vuelidate/validators';

export default {
  name: "LoginForm",

  data() {
    return {
      loginFormRef: useValidate(),
      signupFormRef: useValidate(),
      loginForm: {
        email: '',
        password: ''
      },
      signupForm: {
        email: '',
        name: '',
        surname: '',
        password: ''
      }
    }
  },

  watch: {
    getIsAuthenticate(value) {
      if (value) {
        this.$router.push({
          name: 'home'
        });
      }
    }
  },

  methods: {
    ...mapActions(['login', 'signup']),

    loginFormSubmit() {
      this.loginFormRef.loginForm.$touch();
      if (this.loginFormRef.loginForm.$invalid) {
        return;
      }

      this.login(this.loginFormData);
    },

    signupFormSubmit() {
      this.signupFormRef.signupForm.$touch();
      if (this.signupFormRef.signupForm.$invalid) {
        return;
      }

      this.signup(this.signupFormData);
    }
  },

  computed: {
    ...mapGetters(['getErrorLogin', 'getErrorSignup', 'getUser', 'getIsAuthenticate']),

    signupFormData() {
      return {
        name: this.signupForm.name,
        surname: this.signupForm.surname,
        email: this.signupForm.email,
        password: this.signupForm.password,
      }
    },

    loginFormData() {
      return {
        email: this.loginForm.email,
        password: this.loginForm.password,
      }
    },
  },

  validations() {
    return {
      loginForm: {
        email: { required, email },
        password: { required, minLength: minLength(8) },
      },
      signupForm: {
        email: { required, email },
        name: { required, minLength: minLength(3), maxLength: maxLength(100) },
        surname: { required, minLength: minLength(3), maxLength: maxLength(100) },
        password: { required, minLength: minLength(8) },
      },
    }
  }
}
</script>

<style>
.form-section {
  padding: 60px 100px;
}
</style>
