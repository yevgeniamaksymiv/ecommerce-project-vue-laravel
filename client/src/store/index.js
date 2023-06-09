import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';
import userModule from './modules/user';
import categoryModule from './modules/category';
import productModule from './modules/product';
import cartModule from './modules/cart';
import deliveryModule from './modules/delivery';
import orderModule from './modules/order';

const store = createStore({
  modules: {
    userModule,
    categoryModule,
    productModule,
    cartModule,
    deliveryModule,
    orderModule,
  },
  plugins: [createPersistedState()],
});

export default store;