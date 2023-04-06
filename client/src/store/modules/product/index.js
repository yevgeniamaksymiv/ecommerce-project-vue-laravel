import axiosBase from '@/axios-config';

const productModule = {
  state() {
    return {
      products: [],
      product: [],
      colorsSizes: [],
      total: null,
    };
  },

  getters: {
    getProducts: (state) => state.products,
    getProduct: (state) => state.product,
    getColors: (state) => state.colorsSizes.colors,
    getSizes: (state) => state.colorsSizes.sizes,
    getTotal: (state) => state.total,
  },

  mutations: {
    setProducts(state, data) {
      state.products = data;
    },
    setProduct(state, data) {
      state.product = data;
    },
    setColorsSizes(state, data) {
      state.colorsSizes = data;
    },
    setTotal(state, val) {
      state.total = val;
    },
  },

  actions: {
    getAllProducts({ commit }, page = 1) {
      axiosBase.get(`api/products?page=${page}`)
      .then(({ data }) => {
        commit('setProducts', data.data);
        commit('setTotal', data.meta.total);
      })
      .catch((error) => {
        console.log(error);
      });
    },

    getProductById({ commit }, id) {
      axiosBase
        .get(`api/products/${id}`)
        .then(({ data }) => {
          commit('setProduct', data.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    filterProducts({ commit }, filters) {
      axiosBase
        .post('api/products/filter', filters)
        .then(({ data }) => {
          commit('setProducts', data.data);
          commit('setTotal', data.meta.total);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    getColorsSizes({ commit }) {
      axiosBase
        .get('api/products/colors_sizes')
        .then((response) => {
          commit('setColorsSizes', response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};

export default productModule;
