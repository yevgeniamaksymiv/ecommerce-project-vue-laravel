import axiosBase from '@/axios-config';

const categoryModule = {
  state() {
    return {
      categories: [],
    };
  },

  getters: {
    getCategories: (state) => state.categories,
    
    getCategoriesById: (state) => (id) => {
      return state.categories.filter((el) => el.parent_id === id);
    },
  },

  mutations: {
    setCategories(state, data) {
      state.categories = data;
    },
  },

  actions: {
    getCategories({ commit }) {
      axiosBase
        .get('api/categories')
        .then((response) => {
          commit('setCategories', response.data.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};

export default categoryModule;
