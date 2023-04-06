<template>
  <el-row :gutter="40">
    <el-col :span="14">
      <div class="form-section">
        <h3>Оформлення замовлення</h3>
        <el-form label-position="top" ref="orderFormRef" label-width="120px">
          <el-row :gutter="20">
            <el-col :span="12">
              <el-form-item label="Ім'я">
                <el-input size="large" v-model="orderData.name" />
                <el-text class="mx-1" type="danger" v-for="error of orderFormRef.orderData.name.$errors"
                  :key="error.$uid">
                  {{ error.$message }}</el-text>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="Прізвище">
                <el-input size="large" v-model="orderData.surname" />
                <el-text class="mx-1" type="danger" v-for="error of orderFormRef.orderData.surname.$errors"
                  :key="error.$uid">{{ error.$message }}</el-text>
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="20">
            <el-col :span="12">
              <el-form-item label="Вулиця">
                <el-input size="large" v-model="orderData.street" />
                <el-text class="mx-1" type="danger" v-for="error of orderFormRef.orderData.street.$errors"
                  :key="error.$uid">{{ error.$message }}</el-text>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="Номер дому, квартира">
                <el-input size="large" v-model="orderData.home" />
                <el-text class="mx-1" type="danger" v-for="error of orderFormRef.orderData.home.$errors"
                  :key="error.$uid">{{
                    error.$message }}</el-text>
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="20">
            <el-col :span="12">
              <el-form-item label="Поштовий індекс">
                <el-input size="large" v-model="orderData.postIndex" />
                <el-text class="mx-1" type="danger" v-for="error of orderFormRef.orderData.postIndex.$errors"
                  :key="error.$uid">{{ error.$message }}</el-text>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="Місто">
                <el-input size="large" v-model="orderData.city" />
                <el-text class="mx-1" type="danger" v-for="error of orderFormRef.orderData.city.$errors"
                  :key="error.$uid">{{
                    error.$message }}</el-text>
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="20">
            <el-col :span="12">
              <el-select v-model="orderData.delivery" clearable class="m-2" placeholder="Спосіб доставки" size="large">
                <el-option v-for="(delivery, key) in this.getDeliveries" :key="key" :value="delivery.id"
                  :label="delivery.name" />
              </el-select>
            </el-col>
          </el-row>
          <el-text class="mx-1" type="danger">{{ this.getErrorOrder }}</el-text>
          <el-button size="large" plain type="primary" @click="saveOrderData">Зберегти</el-button>
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
        <div>UAH</div>
      </el-row>
      <el-divider />
      <el-row class="order-info">
        <div>Загальна сума <small>із ПДВ</small></div>
        <div>{{ this.getTotalPrice }} UAH</div>
      </el-row>
      <el-row>
        <el-button type="primary" size="large" @click="submitOrder">
          Оформити замовлення
        </el-button>
      </el-row>
    </el-col>
  </el-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import useValidate from '@vuelidate/core';
import { required, minLength, maxLength, numeric } from '@vuelidate/validators';


export default {
  name: 'OrderComponent',
  data() {
    return {
      orderFormRef: useValidate(),
      orderData: {
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
    ...mapGetters(['getTotalPrice', 'getDeliveries', 'getUser']),
  },

  mounted() {
    this.getDeliveriesAll();
  },

  methods: {
    ...mapActions(['getDeliveriesAll']),

    saveOrderData() {
      this.orderFormRef.orderData.$touch();
      if (this.orderFormRef.orderData.$invalid) {
        return;
      }
    },

    submitOrder() {

    },
  },

  validations() {
    return {
      orderData: {
        name: { required, minLength: minLength(3) },
        surname: { required, minLength: minLength(3) },
        street: { required, minLength: minLength(3) },
        home: { required, minLength: minLength(3) },
        postIndex: { required, numeric, minLength: minLength(5), maxLength: maxLength(5) },
        city: { required, minLength: minLength(3) },
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
</style>