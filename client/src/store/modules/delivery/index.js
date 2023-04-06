import axiosBase from '@/axios-config';

const deliveryModule = {
  state() {
    return {
      deliveries: [],
    };
  },

  getters: {
    getDeliveries: (state) => state.deliveries,
  },

  mutations: {
    setDeliveries(state, data) {
      state.deliveries = data;
    },
  },

  actions: {
    getDeliveriesAll({ commit }) {
      axiosBase
        .get('api/deliveries')
        .then(({ data }) => {
          commit('setDeliveries', data.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};

export default deliveryModule;
