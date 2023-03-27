<template>
  <el-row :gutter="40">
    <el-col :span="6">
      <h1>Logo</h1>
    </el-col>
    <el-col :span="12">
      <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" :ellipsis="false"
        @select="handleSelect">
        <el-menu-item index="1">
          <router-link to="/">Головна</router-link>
        </el-menu-item>
        <el-menu-item index="1">
          <router-link to="/">Новинки</router-link>
        </el-menu-item>
        <el-sub-menu index="2">
          <template #title>
            <router-link to="/">Одяг</router-link>
          </template>
          <el-menu-item index="2-1">item one</el-menu-item>
          <el-menu-item index="2-2">item two</el-menu-item>
          <el-menu-item index="2-3">item three</el-menu-item>
          <el-sub-menu index="2-4">
            <template #title>item four</template>
            <el-menu-item index="2-4-1">item one</el-menu-item>
            <el-menu-item index="2-4-2">item two</el-menu-item>
            <el-menu-item index="2-4-3">item three</el-menu-item>
          </el-sub-menu>
        </el-sub-menu>
        <el-menu-item index="1">
          <router-link to="/">Аксесуари</router-link>
        </el-menu-item>
      </el-menu>
    </el-col>
    <el-col :span="6">
      <el-popover placement="top-start" :width="340" trigger="hover">
        <div style="padding: 15px;">
          <h3>Ви зареєстровані?</h3>
          <el-button size="large" @click="login">Увійти</el-button>
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

      <el-button index="4" type="info" link class="ml-2">
        <el-icon color="#909399" :size="20">
          <ShoppingBag />
        </el-icon>
        Кошик</el-button>
    </el-col>
  </el-row>
</template>

<script>

export default {
  name: "HeaderComponent",
  
  methods: {
    login() {
      this.$router.push({
        name: 'login'
      })
    }
  }
}


</script>

<style scoped>
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

ul {
  align-items: center;
  justify-content: center;
  border-bottom: none;
}

ul li a {
  text-decoration: none;
  font-size: 16px;
  letter-spacing: .5px;
}
</style>