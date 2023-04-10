<template>
  <div class="container">
    <span class="text-muted">&copy; Your Website 2023</span>
  </div>
</template>

<script>
export default {
  name: "FooterComponent"
}
</script>

<style scoped>
.container {
  max-width: 960px;
  margin-right: auto;
  margin-left: auto;
  padding-right: 15px;
  padding-left: 15px;
}

.text-muted {
  color: #888;
}
</style>