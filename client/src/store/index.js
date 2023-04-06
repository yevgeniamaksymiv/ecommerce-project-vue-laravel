import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';
import userModule from './modules/user';
import categoryModule from './modules/category';
import productModule from './modules/product';
import cartModule from './modules/cart';

const store = createStore({
  modules: {
    userModule,
    categoryModule,
    productModule,
    cartModule,
  },
  plugins: [createPersistedState()],
});

export default store;