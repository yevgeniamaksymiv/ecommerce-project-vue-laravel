import axiosBase from '@/axios-config';

const productModule = {
  state() {
    return {
      products: [],
    };
  },

  getters: {
    getProducts: (state) => state.products,
    getColors: (state) => {
      state.products.map((el) => (el = el.color));
    },
    getSizes: (state) => {
      state.products.map((el) => (el = el.size));
    },
  },

  mutations: {
    setProducts(state, data) {
      state.products = data;
    },
  },

  actions: {
    getAllProducts({ commit }) {
      axiosBase
        .get('api/products')
        .then((response) => {
          console.log(response.data.data);
          commit('setProducts', response.data.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};

export default productModule;