import Vue from 'vue'
import Vuex from 'vuex'
import authentication from '../api/authentication';
import authLocalStorage from '../utils/authLocalStorage'

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    auth: {
      state: {
        tokenAuthentication: authLocalStorage.getToken()
      },

      getters: {
        tokenAuthentication: state => state.tokenAuthentication
      },

      mutations: {
        SET_TOKEN(state, tokenAuthentication) {
          state.tokenAuthentication = tokenAuthentication;
        }
      },

      actions: {
        async login({ commit }, userData) {
          await authentication.createSession();

          const { data } = await authentication.login(userData);
          const token = data.data;

          commit('SET_TOKEN', token)

          authLocalStorage.setToken(token);
        },

        async logout({ commit }) {
          await authentication.logout();

          commit('SET_TOKEN', null);

          authLocalStorage.removeToken();
        }
      }
    }
  }
});
