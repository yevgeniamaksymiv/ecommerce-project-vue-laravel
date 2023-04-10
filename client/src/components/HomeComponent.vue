<template>
  <el-carousel :interval="4000" arrow="always">
      <el-carousel-item v-for="(item, index) in items" :key="index">
        <img width="800" height="460" :src="item.src" alt="carousel image" @click="goToPage">
      </el-carousel-item>
    </el-carousel>
</template>

<script>
export default {
  name: "HomeComponent",

  data() {
    return {
      items: [
        { src: require('@/assets/carousel/mens-clothes-1.jpg') },
        { src: require('@/assets/carousel/mens-clothes-2.jpg') },
        { src: require('@/assets/carousel/mens-clothes-3.jpg') },
        { src: require('@/assets/carousel/mens-clothes-4.jpg') },
      ]
    }
  },

  methods: {
    goToPage() {
      this.$router.push({
        name: 'clothes'
      });
    }
  },
}
</script>

<style scoped>
::v-deep .el-carousel__container {
  height: 460px !important;
}

img {
  cursor: pointer;
}
</style>

