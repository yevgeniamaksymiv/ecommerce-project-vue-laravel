<template>
  <el-row :gutter="40">
    <el-col :span="12" class="card">
      <el-card :body-style="{ padding: '0px' }">
        <img :src="this.getProduct.img_path" class="image" />
        <div style="padding: 14px">
          <el-collapse accordion>
            <el-collapse-item title="Опис">
              <div style="text-align: left; word-wrap: break-word;">
                {{ this.getProduct.description }}
              </div>
            </el-collapse-item>
            <el-collapse-item title="Догляд">
              <div style="text-align: left;"></div>
            </el-collapse-item>
            <el-collapse-item title="Доставка і повернення">
              <div style="text-align: left;"></div>
            </el-collapse-item>
          </el-collapse>
        </div>
      </el-card>
    </el-col>
    <el-col :span="12">
      <div class="product-info">
        <div>{{ this.getProduct.name }}</div>
        <div class="price">{{ this.getProduct.price }} UAH</div>
        <div>
          <span>Колір - </span><span>{{ this.getProduct.color }}</span>
        </div>
        <div class="dot-container">
          <span class="dot"></span>
        </div>
        <div>
          <span>Розмір</span>
        </div>
        <div>
          <el-select v-model="size" clearable class="m-2" placeholder="ОБЕРІТЬ РОЗМІР" size="large">
            <el-option :value="this.getProduct.size" :label="this.getProduct.size" />
          </el-select>
        </div>
        <div>
          <el-button type="primary" size="large" @click="addProductToCart">
            <el-icon color="ffffff" :size="20">
              <ShoppingBag />
            </el-icon>
            Додати у кошик
          </el-button>
          <el-dialog v-model="dialogVisible" title="Товар було додано до кошика" width="50%">
            <div style="margin: 0 0 20px 0">
              <el-icon color="#089a08" :size="30">
                <CircleCheck />
              </el-icon>
            </div>
            <el-row :gutter="20">
              <el-col :span="5">
                <img :src="this.getProduct.img_path" class="image-modal" />
              </el-col>
              <el-col :span="12">
                <div class="modal-product-info">{{ this.getProduct.name }}</div>
                <div class="modal-product-info">Розмір: {{ this.getProduct.size }}</div>
                <div class="modal-product-info">{{ this.getProduct.price }} UAH</div>
              </el-col>
            </el-row>
            <template #footer>
              <span class="dialog-footer">
                <el-button @click="dialogVisible = false" size="large">
                  Повернутись до покупок
                </el-button>
                <el-button type="primary" @click="goToCart" size="large">
                  Перейти у кошик
                </el-button>
              </span>
            </template>
          </el-dialog>
        </div>
      </div>
    </el-col>
  </el-row>
</template>

<script>
import { mapGetters, mapActions, mapMutations } from 'vuex';

export default {
  name: 'ProductComponent',
  data() {
    return {
      colorHex: {
        'білий': '#ffffff',
        'жовтий': '#f7f716',
        'зелений': '#0ea60e',
        'коричневий': '#783f04',
        'синій': '#1717fa',
        'сірий': '#a2a0a0',
        'червоний': '#ff0000',
        'чорний': '#000000',
      },
      size: null,
      dialogVisible: false,
    }
  },

  mounted() {
    this.getProductById(this.$route.params.id);
  },

  methods: {
    ...mapActions(['getProductById', 'addToCart']),
    ...mapMutations(['clearCart']),

    addProductToCart() {
      this.dialogVisible = true;
      this.addToCart({
        product: this.getProduct,
        quantity: 1
      });
    },

    goToCart() {
      this.dialogVisible = false;
      this.$router.push({
        name: 'cart',
      });
    }
  },

  computed: {
    ...mapGetters(['getProduct', 'getColors']),

    color() {
      return this.colorHex[this.getProduct.color];
    }
  },
}

</script>

<style scoped>
.card {
  display: flex;
  justify-content: center;
}

.el-card {
  width: 400px;
  height: auto;
}

.image {
  width: 100%;
  display: block;
  object-fit: cover;
  object-position: top center;
  /* width: 250px; */
  /* height: 335px; */
}

.image-modal {
  width: 75px;
  height: 100px;
}

.modal-product-info {
  padding: 0 0 10px 0;
}

.product-info {
  display: grid;
  row-gap: 15px;
  margin: 40px;
  text-align: left;
}

.price {
  letter-spacing: 0.6px;
  font-size: 24px;
  line-height: 34px;
  font-weight: 600;
  color: rgb(51, 51, 51);
}

span:first-child {
  color: #909399;
}

.dot-container {
  height: 25px;
  width: 25px;
  border: .5px solid #909399;
  border-radius: 50%;
  padding: 1px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.dot {
  margin: 0;
  height: 19px;
  width: 19px;
  background-color: v-bind(color);
  border-radius: 50%;
  display: block;
}

.el-button {
  width: 227px;
  display: inline-block;
}
</style>