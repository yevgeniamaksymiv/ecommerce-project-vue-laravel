<template>
  <div ref="overlayMenu" class="overlay" @mouseleave="closeOverlayMenu">
    <div class="overlay-content">
      <el-row>
        <el-col :span="4" v-for="category in this.getCategoriesById(1)"
                :key="category.name">
          <el-menu>
            <el-menu-item index=""> 
            {{ category.name }} 
            </el-menu-item>
          </el-menu>
        </el-col>
      </el-row>
    </div>
  </div>
  <span @mouseover="openOverlayMenu">Одяг</span>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'ClothesOverlayMenu',

  mounted() {
    this.getCategories();
  },

  methods: {
    ...mapActions(['getCategories']),

    openOverlayMenu() {
      this.$refs.overlayMenu.style.height = "40%";
    },
    closeOverlayMenu() {
      this.$refs.overlayMenu.style.height = "0";
    }
  },

  computed: {
    ...mapGetters(['getCategoriesById'])
  }
}
</script>

<style scoped>
ul {
  border-right: none!important;
}
.overlay {
  height: 0;
  width: 100%;
  position: fixed;
  z-index: 1;
  top: 60px;
  left: 0;
  background-color: #fff;
  overflow-x: hidden;
  transition: 0.5s;
  box-shadow:  0 20px 20px -20px rgba(0, 0, 0, 0.8);
}

.overlay-content {
  padding: 50px 200px;
}
</style>