<template>
  <div class="common-layout">
    <el-container>
      <el-aside width="200px">
        <el-menu>
          <el-menu-item index="" ref="item" v-for="category in this.getCategoriesById(1)" :key="category.name"
            @click="filterByCategory(category.name)">
            {{ category.name }}
          </el-menu-item>
        </el-menu>
      </el-aside>
      <el-main>
        <el-row :gutter="20">
          <el-col :span="5">
            <el-select v-model="sortValue" class="m-2" placeholder="СОРТУВАТИ ЗА" size="large">
              <el-option label="ЗРОСТАННЯ ЦІНИ" value="asc" />
              <el-option label="ЗНИЖЕННЯ ЦІНИ" value="desc" />
              <el-option label="НАЙНОВІШЕ" value="date" />
            </el-select>
          </el-col>
          <el-col :span="5">
            <el-select v-model="filters.size" clearable class="m-2" placeholder="РОЗМІРИ" size="large">
              <el-option v-for="(size, key) in this.getSizes" :key="key" :value="size" :label="size" />
            </el-select>
          </el-col>
          <el-col :span="5">
            <el-select v-model="filters.color" clearable class="m-2" placeholder="КОЛЬОРИ" size="large">
              <el-option v-for="(color, key) in this.getColors" :key="key" :value="color" :label="color" />
            </el-select>
          </el-col>
          <el-col :span="5">
            <el-select v-model="filters.price" clearable class="m-2" placeholder="ЦІНА" size="large">
              <el-option label="МЕНШЕ 1000 ₴" value="0,1000" />
              <el-option label="1000 - 2000 ₴" value="1000,2000" />
              <el-option label="2000 - 5000 ₴" value="2000,5000" />
              <el-option label="5000 - 10000 ₴" value="5000,10000" />
              <el-option label="БІЛЬШЕ 10000 ₴" value="10000" />
            </el-select>
          </el-col>
          <el-col :span="4" style="margin-top: 12px;">
            <span class="info">{{ this.getProducts.length }} товари</span>
          </el-col>
        </el-row>

        <el-row :gutter="20">
          <el-col :span="6" v-for="(product, key) in this.getProducts" :key="key">
            <el-card :body-style="{ padding: '0px' }">
              <img :src="product.img_path" class="image" />
              <div class="content">
                <span>{{ product.name }}</span>
                <span>{{ product.price }} ₴</span>
                <el-button text bg type="plain" class="button">КУПИТИ</el-button>
              </div>
            </el-card>
          </el-col>
        </el-row>
      </el-main>
    </el-container>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'ClothesComponent',

  data() {
    return {
      sortValue: null,
      filters: {
        size: null,
        price: null,
        color: null
      }

    }
  },

  mounted() {
    this.getCategories();
    this.getAllProducts();
    this.getColorsSizes();
  },

  watch: {
    filters: {
      handler(filters) {
        this.filterProducts(filters);
      },
      deep: true,
    },

    sortValue(val) {
      this.sortBySelectedValue(val);
    }
  },

  methods: {
    ...mapActions(['getCategories', 'getAllProducts', 'getColorsSizes', 'filterProducts', 'sortProducts']),

    sortBySelectedValue(sortValue) {
      if (sortValue === 'date') {
        this.sortProducts({
          params: {
            date: sortValue
          }
        });
      } else {
        this.sortProducts({
          params: {
            price: sortValue
          }
        });
      }
    },

    filterByCategory(categoryName) {
      console.log('category: ', categoryName)
    }
  },

  computed: {
    ...mapGetters(['getCategoriesById', 'getProducts', 'getColors', 'getSizes'])
  }
}
</script>

<style scoped>
ul {
  border-right: none !important;
}

ul li a {
  text-decoration: none;
  font-size: 16px;
  letter-spacing: .5px;
  color: #000;
}

.el-col {
  margin-bottom: 20px;
}

.image {
  display: block;
  object-fit: cover;
  object-position: top center;
  width: 250px;
  height: auto;
}

.info {
  color: #909399;
}

.el-card.is-always-shadow:hover {
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
  transition: .4s;
}

.el-menu-item.is-active {
  color: #1e1f20;
  height: 30px;
}

aside {
  padding: 20px 0;
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

.button {
  margin: 0;
}

</style>