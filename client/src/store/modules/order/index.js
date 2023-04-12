import axiosBase from '@/services/axios-config';

const orderModule = {
  state() {
    return {
      orders: [],
      order: null,
      isOrderCreated: false,
      pdfPath: null,
    };
  },

  getters: {
    getOrders: (state) => state.orders,
    getOrder: (state) => state.order,
    getIsOrderCreated: (state) => state.isOrderCreated,
    getPdfPath: (state) => state.pdfPath,
  },

  mutations: {
    setOrders(state, data) {
      state.orders = data;
    },
    setOrder(state, data) {
      state.order = data;
    },
    setIsOrderCreated(state, bool) {
      state.isOrderCreated = bool;
    },
    setPdfPath(state, val) {
      state.pdfPath = val;
    },
  },

  actions: {
    storeOrder({ commit }, payload) {
      axiosBase
        .post('api/orders/store', payload)
        .then(({ data }) => {
          if (data) {
            commit('setOrder', data.data);
            commit('setIsOrderCreated', true);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    storePdfPath({commit}, value) {
      commit('setPdfPath', value);
    }
  },
};

export default orderModule;
