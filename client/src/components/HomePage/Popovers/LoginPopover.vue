<template>
  <el-popover placement="top-start" :width="340" trigger="hover">
    <div style="padding: 15px;">
      <h3>Ви зареєстровані?</h3>
      <el-button size="large" @click="login">Увійти</el-button>
      <el-divider />
      <h3>Вперше на сайті?</h3>
      <span>Після швидкої реєстрації ви отримаєте доступ до багатьох функцій і додаткових переваг.</span>
      <el-button size="large" type="info" @click="login">Зареєструватись</el-button>
    </div>
    <template #reference>
      <el-button index="3" type="info" link @click="login">
        <el-icon color="#909399" :size="20">
          <User />
        </el-icon>
        Акаунт</el-button>
    </template>
  </el-popover>
</template>

<script>
export default {
  name: 'LoginPopover',

  methods: {
    login() {
      this.$router.push({
        name: 'login'
      })
    }
  },
}
</script>

<style>
.el-icon {
  margin-right: 5px;
}

.el-button {
  margin: 16px 10px 0 0;
  font-size: 16px;
  letter-spacing: .5px;
}

h3 {
  font-size: 18px;
  letter-spacing: .5px;
}
</style>