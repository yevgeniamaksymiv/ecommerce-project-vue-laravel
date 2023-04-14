<template>
  <el-container>
    <el-row :gutter="20">
      <el-col :xs="24" :sm="12" :md="6" :lg="4" v-for="(product, key) in products" :key="key">
        <el-card :body-style="{ padding: '0px' }" class="container">
          <img :src="product.img_path" class="image" @click="showProduct(product.id)" />
          <div class="top-right"><small>New</small></div>
          <div class="content">
            <span>{{ product.name }}</span>
            <span>{{ product.price }} ₴</span>
            <el-button text bg type="plain" class="button" @click="showProduct(product.id)">КУПИТИ</el-button>
          </div>
        </el-card>
      </el-col>
    </el-row>
  </el-container>
</template>

<script>
import axiosBase from '@/services/axios-config';

export default {
  name: "NewProductsComponent",

  data() {
    return {
      products: null,
    }
  },

  mounted() {
    axiosBase
      .get('api/products/latest')
      .then(({ data }) => {
        this.products = data.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },

  methods: {
    showProduct(id) {
      this.$router.push({
        path: `product/${id}`,
      });
    }
  },
}

</script>

<style scoped>
.el-card.is-always-shadow:hover {
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
  transition: .4s;
}

.el-col {
  margin-bottom: 20px;
}

.container {
  position: relative;
  text-align: center;
}

.top-right {
  position: absolute;
  top: 8px;
  right: 16px;
  color: #fff;
  border: 1px solid #409eff;
  background-color: #409eff;
  opacity: .8;
  border-radius: 50%;
  padding: 8px 5px;
}

.content {
  padding: 10px;
  display: flex;
  flex-direction: column;
}

.content>span:nth-child(2) {
  color: #82858b;
}

span {
  font-size: 14px;
  margin-bottom: 8px;
  text-transform: uppercase;
  display: inline-block;
}

.image {
  width: 100%;
  display: block;
  object-fit: cover;
  object-position: top center;
  /* width: 250px; */
  height: 335px;
}

.button {
  margin: 0;
}
</style>