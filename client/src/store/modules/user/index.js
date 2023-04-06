import axiosBase from '@/axios-config';

const userModule = {
  // namespaced: true,
  state() {
    return {
      user: {
        name: null,
        surname: null,
        token: null,
      },
      isAuthenticate: false,
      errorLogin: null,
      errorSignup: null,
    };
  },
  getters: {
    getUser: (state) => state.user,
    getIsAuthenticate: (state) => state.isAuthenticate,
    getErrorLogin: (state) => state.errorLogin,
    getErrorSignup: (state) => state.errorSignup,
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    setIsAuthenticate(state, bool) {
      state.isAuthenticate = bool;
    },
    setErrorLogin(state, msg) {
      state.errorLogin = msg;
    },
    setErrorSignup(state, msg) {
      state.errorSignup = msg;
    },
  },
  actions: {
    login({ commit }, payload) {
      axiosBase
        .post('/api/users/login', payload)
        .then((response) => {
          commit('setUser', response.data);
          commit('setIsAuthenticate', true);
          commit('setErrorLogin', null);
          commit('setErrorSignup', null);
        })
        .catch((error) => {
          commit('setErrorLogin', error.response.data['message']);
        });
    },

    signup({ commit }, payload) {
      axiosBase
        .post('/api/users/register', payload)
        .then((response) => {
          commit('setUser', response.data);
          commit('setIsAuthenticate', true);
          commit('setErrorLogin', null);
          commit('setErrorSignup', null);
        })
        .catch((error) => {
          commit('setErrorSignup', error.response.data['message']);
        });
    },

    logout({ commit }) {
      axiosBase
        .get('/api/users/logout')
        .then((response) => {
          if (response.status === 200) {
            commit('setUser', { name: null, token: null });
            commit('setIsAuthenticate', false);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};

export default userModule;
