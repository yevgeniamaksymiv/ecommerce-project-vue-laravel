<template>
  <div class="common-layout">
    <el-container>
      <el-aside width="200px">
        <el-menu :default-active="activeIndex">
          <el-menu-item :index="category.id" v-for="(category) in this.getCategoriesById(1)" :key="category.id"
            :value="category.id" @click="filterByCategory(category.id)"
            :class="{ 'is-active': activeIndex === category.id }">
            {{ category.name }}
          </el-menu-item>
        </el-menu>
      </el-aside>
      <el-main>
        <el-row :gutter="20">
          <el-col :xs="24" :sm="12" :md="5" :lg="5">
            <el-select v-model="sortValue" class="m-2" placeholder="СОРТУВАТИ ЗА" size="large">
              <el-option label="ЗРОСТАННЯ ЦІНИ" value="asc" />
              <el-option label="ЗНИЖЕННЯ ЦІНИ" value="desc" />
              <el-option label="НАЙНОВІШЕ" value="created_at" />
            </el-select>
          </el-col>
          <el-col :xs="24" :sm="12" :md="5" :lg="5">
            <el-select v-model="filtersSortData.filters.size" clearable class="m-2" placeholder="РОЗМІРИ" size="large">
              <el-option v-for="(size, key) in this.getSizes" :key="key" :value="size" :label="size" />
            </el-select>
          </el-col>
          <el-col :xs="24" :sm="12" :md="5" :lg="5">
            <el-select v-model="filtersSortData.filters.color" clearable class="m-2" placeholder="КОЛЬОРИ" size="large">
              <el-option v-for="(color, key) in this.getColors" :key="key" :value="color" :label="color" />
            </el-select>
          </el-col>
          <el-col :xs="24" :sm="12" :md="5" :lg="5">
            <el-select v-model="filtersSortData.filters.price" clearable class="m-2" placeholder="ЦІНА" size="large">
              <el-option label="МЕНШЕ 1000 ₴" value="0,1000" />
              <el-option label="1000 - 2000 ₴" value="1000,2000" />
              <el-option label="2000 - 5000 ₴" value="2000,5000" />
              <el-option label="5000 - 10000 ₴" value="5000,10000" />
            </el-select>
          </el-col>
          <el-col :xs="24" :sm="12" :md="4" :lg="4" style="margin-top: 12px;">
            <span class="info">{{ this.getTotal }} товари</span>
          </el-col>
        </el-row>

        <el-row :gutter="20">
          <el-col :xs="24" :sm="12" :md="8" :lg="6" v-for="(product, key) in this.getProducts" :key="key">
            <el-card :body-style="{ padding: '0px' }">
              <img :src="product.img_path" class="image" @click="showProduct(product.id)" />
              <div class="content">
                <span>{{ product.name }}</span>
                <span>{{ product.price }} ₴</span>
                <el-button text bg type="plain" class="button" @click="showProduct(product.id)">КУПИТИ</el-button>
              </div>
            </el-card>
          </el-col>
        </el-row>
        <el-pagination v-model:current-page="currentPage" @current-change="handleCurrentPageChange" background
          layout="prev, pager, next" :total="totalProducts" class="pagination" />
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
      filtersSortData: {
        filters: {
          size: null,
          price: null,
          color: null,
          category_id: null
        },
        sorters: {
          direction: 'asc',
          field: null,
        }
      },
      sortValue: null,
      currentPage: 1,
      activeIndex: null,
    }
  },

  mounted() {
    this.getCategoriesAll();
    this.getAllProducts();
    this.getColorsSizes();
    this.activeIndex = this.$route.query.activeIndex;
  },

  watch: {
    filtersSortData: {
      handler(filters) {
        this.filterProducts(filters);
      },
      immediate: true,
      deep: true,
    },

    'filtersSortData.filters': {
      handler() {
        this.currentPage = 1;
      },
      deep: true,
    },

    activeIndex(val) {
        this.filterByCategory(val);
    },

    sortValue(val) {
      this.sortBySelectedValue(val);
    },

    currentPage(page) {
      this.filtersSortData['page'] = page;
    }
  },

  methods: {
    ...mapActions(['getCategoriesAll', 'getAllProducts', 'getColorsSizes', 'filterProducts']),

    sortBySelectedValue(sortValue) {
      let direction = 'asc';
      let field = null;
      if (sortValue === 'created_at') {
        direction = 'desc';
        field = 'created_at';
      } else {
        field = 'price';
        direction = sortValue;
      }
      this.filtersSortData.sorters = {
        direction,
        field,
      }
    },

    filterByCategory(categoryId) {
        this.filtersSortData.filters.category_id = categoryId;
    },

    handleCurrentPageChange() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },

    showProduct(id) {
      this.$router.push({
        path: `product/${id}`,
      });
    }
  },

  computed: {
    ...mapGetters(['getCategoriesById', 'getProducts', 'getColors', 'getSizes', 'getTotal']),

    totalProducts() {
      return Math.ceil(this.getTotal / 2);
    }
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
  width: 100%;
  display: block;
  object-fit: cover;
  object-position: top center;
  /* width: 250px; */
  height: 335px;
}

.info {
  color: #909399;
}

.el-card.is-always-shadow:hover {
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
  transition: .4s;
}

.el-menu-item.is-active {
  height: 30px;
  background-color: #ecf5ff;
}

.el-menu-item {
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

.pagination {
  display: flex;
  justify-content: center;
}
</style>