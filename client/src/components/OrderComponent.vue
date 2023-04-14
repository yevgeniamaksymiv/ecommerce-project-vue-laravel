<template>
  <el-row :gutter="40">
    <el-col :span="14">
      <div class="form-section">
        <h3>Оформлення замовлення</h3>
        <el-form label-position="top" ref="orderFormRef" label-width="120px">
          <el-row :gutter="20">
            <el-col :span="12">
              <el-form-item label="Ім'я">
                <el-input size="large" v-model="orderInfo.name" :value="getUser.name" />
                <!-- <el-text class="mx-1" size="small" type="danger" v-for="error of orderFormRef.orderInfo.name.$errors"
                  :key="error.$uid">
                  {{ error.$message }}</el-text> -->
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="Прізвище">
                <el-input size="large" v-model="orderInfo.surname" :value="getUser.surname" />
                <!-- <el-text class="mx-1" size="small" type="danger" v-for="error of orderFormRef.orderInfo.surname.$errors"
                  :key="error.$uid">{{ error.$message }}</el-text> -->
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="20">
            <el-col :span="12">
              <el-form-item label="Вулиця">
                <el-input size="large" v-model="orderInfo.street" />
                <el-text class="mx-1" size="small" type="danger" v-for="error of orderFormRef.orderInfo.street.$errors"
                  :key="error.$uid">{{ error.$message }}</el-text>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="Номер дому, квартира">
                <el-input size="large" v-model="orderInfo.home" />
                <el-text class="mx-1" size="small" type="danger" v-for="error of orderFormRef.orderInfo.home.$errors"
                  :key="error.$uid">{{
                    error.$message }}</el-text>
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="20">
            <el-col :span="12">
              <el-form-item label="Поштовий індекс">
                <el-input size="large" v-model="orderInfo.postIndex" />
                <el-text class="mx-1" size="small" type="danger" v-for="error of orderFormRef.orderInfo.postIndex.$errors"
                  :key="error.$uid">{{ error.$message }}</el-text>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="Місто">
                <el-input size="large" v-model="orderInfo.city" />
                <el-text class="mx-1" size="small" type="danger" v-for="error of orderFormRef.orderInfo.city.$errors"
                  :key="error.$uid">{{
                    error.$message }}</el-text>
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="20">
            <el-col :span="12">
              <el-select v-model="orderInfo.delivery" clearable class="m-2" placeholder="Спосіб доставки" size="large">
                <el-option v-for="(delivery, key) in this.getDeliveries" :key="key" :value="delivery.id"
                  :label="delivery.name" />
              </el-select>
              <el-text class="mx-1" size="small" type="danger" v-for="error of orderFormRef.orderInfo.delivery.$errors"
                :key="error.$uid">{{
                  error.$message }}</el-text>
            </el-col>
          </el-row>
        </el-form>
      </div>
    </el-col>
    <el-col :span="10" style="background-color: #f3f3f5; padding: 60px 30px;">
      <el-row class="order-info">
        <div>Ціна товарів</div>
        <div>{{ this.getTotalPrice }} UAH</div>
      </el-row>
      <el-row class="order-info">
        <div>Сума доставки</div>
        <div>150 UAH</div>
      </el-row>
      <el-divider />
      <el-row class="order-info">
        <div>Загальна сума <small>із ПДВ</small></div>
        <div>{{ orderAmount }} UAH</div>
      </el-row>
      <el-row>
        <el-button type="primary" size="large" @click="submitOrder">
          Оформити замовлення
        </el-button>
      </el-row>
    </el-col>
  </el-row>
  <el-dialog v-model="dialogVisible" title="Замовлення успішно сформовано">
    <div>Очікуйте інформацію про доставку на свою електронну адресу</div>
    <hr>
    <div style="margin-top: 20px;">Бажаєте завантажити інформацію про замовлення у форматі PDF?</div>
    <template #footer>
      <div class="dialog-footer">
        <el-button type="primary" @click="downLoadPdf">Завантажити PDF</el-button>
        <el-button type="primary" plain @click="closeDialog">Закрити</el-button>
      </div>
    </template>
  </el-dialog>
</template>

<script>
import axiosBase from '@/services/axios-config.js';
import { mapGetters, mapActions, mapMutations } from 'vuex';
import useValidate from '@vuelidate/core';
import { required, minLength, maxLength, numeric } from '@vuelidate/validators';
import { mapValues, keyBy } from 'lodash';
import { h } from 'vue';
import { ElNotification } from 'element-plus';


export default {
  name: 'OrderComponent',
  data() {
    return {
      orderFormRef: useValidate(),
      dialogVisible: false,
      orderInfo: {
        name: null,
        surname: null,
        street: null,
        home: null,
        postIndex: null,
        city: null,
        delivery: null
      }
    }
  },

  computed: {
    ...mapGetters(['getTotalPrice', 'getDeliveries', 'getUser', 'getCart', 'getIsOrderCreated', 'getOrder']),

    deliveryAddress() {
      return `${this.orderInfo.street} ${this.orderInfo.home} ${this.orderInfo.city} ${this.orderInfo.postIndex}`;
    },

    orderAmount() {
      return this.getTotalPrice + 150;
    },

    productsInCart() {
      const products = [];
      this.getCart.forEach(el => {
        return products.push({
          'product_id': el.product.id,
          'count': el.quantity
        });
      });
      return mapValues(
        keyBy(products, 'product_id'),
        ({ count }) => ({ count })
      );
    },

    orderData() {
      return {
        products: this.productsInCart,
        delivery_address: this.deliveryAddress,
        order_amount: this.orderAmount,
        user_id: this.getUser.id,
        delivery_id: this.orderInfo.delivery,
      }
    },

  },

  mounted() {
    this.getDeliveriesAll();
  },

  methods: {
    ...mapActions(['getDeliveriesAll', 'storeOrder']),
    ...mapMutations(['clearCart']),

    submitOrder() {
      this.orderFormRef.orderInfo.$touch();
      if (this.orderFormRef.orderInfo.$invalid) {
        return;
      }

      this.storeOrder(this.orderData);
      if (this.getIsOrderCreated) {
        this.clearCart();
        this.dialogVisible = true;
      }
    },
    
    downLoadPdf() {
      this.dialogVisible = false;
      this.$router.push({
        name: 'home'
      });
      axiosBase
        .post('api/orders/create_pdf', {
          order_id: this.getOrder.order_id
        })
        .catch((error) => {
          console.log(error);
        });

      ElNotification({
        title: 'PDF',
        message: h('i', { style: 'color: teal' }, 'Очікуйте на звіт в форматі PDF'),
        type: 'success',
        offset: 100,
      });
    },

    closeDialog() {
      this.dialogVisible = false;
      this.$router.push({
        name: 'home'
      });
    },
  },

  validations() {
    return {
      orderInfo: {
        // name: { required, minLength: minLength(3) },
        // surname: { required, minLength: minLength(3) },
        street: { required, minLength: minLength(3) },
        home: { required },
        postIndex: { required, numeric, minLength: minLength(5), maxLength: maxLength(5) },
        city: { required, minLength: minLength(3) },
        delivery: { required },
      },
    }
  }

}
</script>

<style scoped>
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

.form-section {
  padding: 0 40px 40px;
}

.el-select {
  width: 100%;
}

div.dialog-footer {
  display: flex;
}
</style>