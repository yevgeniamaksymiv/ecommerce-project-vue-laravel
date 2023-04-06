<template>
  <el-row :gutter="40">
    <el-col :span="14" style="text-align: start;">
      <div class="cart-content">
        <span style="font-size: 26px;">Кошик</span>
        <small class="quantity-info">кількість товару: {{ this.getCartQuantity }}</small>
      </div>
      <div class="cart-content">
        <el-icon style="top: 3px; color: #014db5;">
          <Warning />
        </el-icon>
        <small style="color: #014db5;">Не відкладайте купування. Додавання товарів у кошик не є бронюванням</small>
      </div>
      <div class="cart-content">
        <el-row v-for="(item, key) in this.getCart" :key="key">
          <el-col :span="7">
            <img :src="item.product['img_path']" class="image-cart" />
          </el-col>
          <el-col :span="10" class="product-info">
            <div class="cart-product-info">{{ item.product['name'] }}</div>
            <div class="cart-product-info">розмір: {{ item.product['size'] }}</div>
            <div class="cart-product-info">колір: {{ item.product['color'] }}</div>
            <div class="cart-product-info">
              <el-icon style="top: 3px; color: #EB7F00;">
                <Warning />
              </el-icon>
              <small style="color: #EB7F00;">Останні моделі</small>
            </div>
            <div>
              <el-select v-model="item.quantity" class="m-2" size="large">
                <el-option v-for="quantity in item.product['quantity']" :key="quantity" :value="quantity"
                  :label="quantity" />
              </el-select>
            </div>
          </el-col>
          <el-col :span="5" class="delete-price">
            <div>
              <button class="icon-delete" @click="removeProduct(item.product['id'])">
                <el-icon :size="20" color="#373636">
                  <Delete />
                </el-icon>
              </button>
            </div>
            <div>
              <span>{{ item.quantity * item.product['price'] }} UAH</span>
            </div>
          </el-col>
          <el-divider />
        </el-row>
      </div>
    </el-col>
    <el-col :span="10" style="background-color: #f3f3f5; padding: 60px 30px;">
      <el-row class="order-info">
        <div>Ціна товарів</div>
        <div>{{ this.getTotalPrice }} UAH</div>
      </el-row>
      <el-row class="order-info">
        <div>Сума доставки</div>
        <div>від 0 UAH</div>
      </el-row>
      <el-divider />
      <el-row class="order-info">
        <div>Загальна сума <small>із ПДВ</small></div>
        <div>{{ this.getTotalPrice }} UAH</div>
      </el-row>
      <el-row>
        <el-button type="primary" size="large" @click="createOrder">
          Перейти до оформлення
        </el-button>
      </el-row>
    </el-col>
  </el-row>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
  name: 'CartComponent',

  data() {
    return {
    }
  },

  methods: {
    ...mapActions(['removeProductFromCart']),

    removeProduct(id) {
      this.removeFromCart(id);
    },

    createOrder(){
      this.$router.push({
        name: 'order',
      });
      // return this.getIsAuthenticate === true 
      //   ?  this.$router.push({
      //     name: 'order',
      //   })
      //   : this.$router.push({
      //     name: 'login',
      //   })
    },
  },

  computed: {
    ...mapGetters(['getCart', 'getCartQuantity', 'getTotalPrice', 'getIsAuthenticate']),
  },
}

</script>

<style scoped>
.cart-content {
  padding: 0 0 30px 20px;
}

.quantity-info {
  font-weight: 500;
  letter-spacing: 0.7px;
  padding: 8px 10px;
  margin: 20px;
  font-size: 16px;
  background-color: #f3f3f5;
}

.image-cart {
  width: 120px;
  height: 160px;
}

.cart-product-info {
  padding: 0 0 10px 0;
}

.cart-product-info:nth-child(2),
.cart-product-info:nth-child(3) {
  color: #909399;
  font-size: 14px;
}

.el-select {
  width: 120px;
}

.icon-delete {
  height: 35px;
  width: 35px;
  background: transparent;
  border: none !important;
  border-radius: 50%;
}

.icon-delete:hover {
  background-color: #f3f3f5;
}

.product-info {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
}

.delete-price {
  text-align: end;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.order-info {
  text-transform: uppercase;
  font-size: 14px;
  margin-bottom: 20px;
  display: flex;
  justify-content: space-between;
}

.el-button {
  text-transform: uppercase;
  width: 100%;
  margin-right: 0;
}
</style>

