<template>
  <el-carousel :interval="4000" arrow="always">
      <el-carousel-item v-for="(item, index) in items" :key="index">
        <img :src="item.src" alt="carousel image">
      </el-carousel-item>
    </el-carousel>
</template>

<script>
export default {
  name: "HomeComponent",

  data() {
    return {
      items: [
        { src: 'assets/carousel/mens-clothes-1.jpg' },
        { src: 'assets/carousel/mens-clothes-2.jpg' },
        { src: 'assets/carousel/mens-clothes-3.jpg' }
      ]
    }
  }
}
</script>

<style scoped></style>