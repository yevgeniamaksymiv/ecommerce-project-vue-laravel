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
        <el-menu-item index="2">
          <router-link to="/">Новинки</router-link>
        </el-menu-item>
        <el-menu-item index="3">
          <router-link to="/clothes"><ClothesOverlayMenu /></router-link>
        </el-menu-item>
        <el-menu-item index="4">
          <router-link to="/">Аксесуари</router-link>
        </el-menu-item>
      </el-menu>
    </el-col>

    <el-col :span="6">
      <template v-if="this.getUser.name">
        <CabinetPopover />
      </template>
      <template v-else>
        <LoginPopover />
      </template>
      <el-button index="4" type="info" link class="ml-2" @click="goToCart">
        <el-icon color="#909399" :size="20">
          <ShoppingBag />
        </el-icon>
        Кошик {{ this.getCartQuantity ? `(${getCartQuantity})` : '' }}</el-button>
    </el-col>
  </el-row>
</template>

<script>
import { mapGetters } from 'vuex';
import LoginPopover from '@/components/Popovers/LoginPopover.vue';
import CabinetPopover from '@/components/Popovers/CabinetPopover.vue';
import ClothesOverlayMenu from '@/components/Popovers/ClothesOverlayMenu.vue';

export default {
  name: "HeaderComponent",
  components: {
    LoginPopover,
    CabinetPopover,
    ClothesOverlayMenu
  },

  methods: {
    goToCart() {
      this.$router.push({
        name: 'cart',
      });
    }
  },

  computed: {
    ...mapGetters(['getUser', 'getCartQuantity'])
  }
}


</script>

<style scoped>
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