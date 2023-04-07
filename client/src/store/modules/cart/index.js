const cartModule = {
  state() {
    return {
      cart: {
        products: [],
      },
    };
  },

  getters: {
    getCart: (state) => state.cart.products,

    getCartQuantity: (state) => {
      return state.cart.products.reduce((acc, curr) => acc + curr.quantity, 0);
    },

    getTotalPrice: (state) => {
      let total = 0;
      state.cart.products.forEach((el) => {
        total += el.product.price * el.quantity;
      });
      return total;
    },
  },

  mutations: {
    setCart(state, { product, quantity }) {
      const isProductInCart = state.cart.products.find((item) => item.product.id === product.id);
      if (isProductInCart) {
        isProductInCart.quantity += quantity;
        return;
      }
      state.cart.products.push({
        product,
        quantity,
      });
    },

    removeProductFromCart(state, id) {
      state.cart.products = state.cart.products.filter((el) => el.product.id !== id);
      return state.cart.products;
    },

    clearCart(state) {
      state.cart.products = [];
    },
  },

  actions: {
    addToCart({ commit }, data) {
      commit('setCart', data);
    },

    removeFromCart({commit}, id) {
      commit('removeProductFromCart', id);
    }
  },
};

export default cartModule;
