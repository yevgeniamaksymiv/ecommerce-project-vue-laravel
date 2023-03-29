<template>
  <div ref="overlayMenu" class="overlay">
    <div class="overlay-content" @mouseleave="closeOverlayMenu">
      <el-row>
        <el-col :span="6">
          <el-menu>
            <el-menu-item index="" v-for="category in this.getCategoriesById(1).slice(0, 6)">
              <span> {{ category }} </span>
            </el-menu-item>
          </el-menu>
        </el-col>
        <el-col :span="6">
            <el-menu>
              <el-menu-item index="" v-for="category in this.getCategoriesById(1).slice(6, 12)">
                <span> {{ category }} </span>
              </el-menu-item>
            </el-menu>
          </el-col>
          <el-col :span="6">
              <el-menu>
                <el-menu-item index="" v-for="category in this.getCategoriesById(1).slice(12)">
                  <span> {{ category }} </span>
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
      this.$refs.overlayMenu.style.height = "60%";
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
}
</style>