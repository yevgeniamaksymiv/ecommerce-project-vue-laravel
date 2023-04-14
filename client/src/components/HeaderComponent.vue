<template>
  <el-row :gutter="40" class="header-row">
    <el-col :span="4" class="header-items">
      <h1>Logo</h1>
    </el-col>
    <el-col :span="12" class="header-items">
      <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" :ellipsis="false"
        @select="handleSelect">
        <el-menu-item index="1">
          <router-link to="/">Головна</router-link>
        </el-menu-item>
        <el-menu-item index="2">
          <router-link to="/latest">Новинки</router-link>
        </el-menu-item>
        <el-menu-item index="3">
          <router-link to="/clothes">
            <ProductsOverlayMenu title="Одяг" categoryId="1" />
          </router-link>
        </el-menu-item>
        <el-menu-item index="4">
          <router-link to="/accessories">
            <ProductsOverlayMenu title="Аксесуари" categoryId="2" />
          </router-link>
        </el-menu-item>
      </el-menu>
    </el-col>
    <el-col :span="1" v-if="pdfUrl" style="padding-top: 25px;">
      <el-link type="primary" :href="`http://localhost:85/${pdfUrl}`" target="_blank">
        PDF
        <el-icon color="#409eff" :size="20">
          <Download />
        </el-icon>
      </el-link>
    </el-col>
    <el-col :span="7" class="buttons-right">
      <el-row>
        <el-input v-model="inputSearch" class="w-50 m-2 search" placeholder="Пошук товару" :prefix-icon="searchIcon" />
      </el-row>
      <el-row>
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
      </el-row>
    </el-col>
  </el-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import LoginPopover from '@/components/Popovers/LoginPopover.vue';
import CabinetPopover from '@/components/Popovers/CabinetPopover.vue';
import ProductsOverlayMenu from '@/components/Popovers/ProductsOverlayMenu.vue';
import { Search } from '@element-plus/icons-vue';
import emitter from 'tiny-emitter/instance';

export default {
  name: "HeaderComponent",
  components: {
    LoginPopover,
    CabinetPopover,
    ProductsOverlayMenu
  },

  data() {
    return {
      searchIcon: Search,
      inputSearch: null,
      pdfUrl: null,
      channel: null,
    }
  },

  beforeMount() {
    emitter.on('pdf-url-updated', url => {
      this.pdfUrl = url;
    })
  },

  beforeUnmount() {
    emitter.off('pdf-url-updated');
  },

  watch: {
    inputSearch(val) {
      this.searchProducts(val);
      this.$router.push({
        name: 'clothes',
      });
    },
  },

  methods: {
    ...mapActions(['searchProducts']),

    goToCart() {
      this.$router.push({
        name: 'cart',
      });
    }
  },

  computed: {
    ...mapGetters(['getUser', 'getCartQuantity', 'getPdfPath'])
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

.el-row.header-row {
  padding-top: 20px;
}

.el-col.buttons-right {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.el-input.search {
  width: 200px;
}

.el-col.header-items {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>