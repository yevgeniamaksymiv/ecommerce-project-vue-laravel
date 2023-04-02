import axiosBase from '@/axios-config';

const productModule = {
  state() {
    return {
      products: [],
      colorsSizes: [],
    };
  },

  getters: {
    getProducts: (state) => state.products,
    getColors: (state) => state.colorsSizes.colors.sort(),
    getSizes: (state) => state.colorsSizes.sizes.sort(),
  },

  mutations: {
    setProducts(state, data) {
      state.products = data;
    },
    setColorsSizes(state, data) {
      state.colorsSizes = data;
    },
  },

  actions: {
    getAllProducts({ commit }) {
      axiosBase.get('api/products').then((response) => {
        commit('setProducts', response.data.data);
      });
      // .catch((error) => {
      //   console.log(error);
      // });
    },

    sortProducts({ commit }, params) {
      axiosBase
        .get('api/products/sort', params)
        .then((response) => {
          commit('setProducts', response.data.data);
        })
        // .catch((error) => {
        //   console.log(error);
        // });
    },

    filterProducts({ commit }, filters) {
      axiosBase
        .post('api/products/filter', filters)
        .then((response) => {
          console.log(response.data);
          commit('setProducts', response.data.data);
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