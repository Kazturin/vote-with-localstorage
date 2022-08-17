import { createStore } from "vuex";
import axiosClient from "../axios";

const store = createStore({
  state: {
    user: {
      data: null,
      ip: null,
      token: sessionStorage.getItem("TOKEN"),
    },
    dashboard: {
      loading: false,
      data: {}
    },
    surveys: {
      loading: false,
      links: [],
      data: []
    },
    categories: [],
    surveysPublic: {
      loading: false,
      links: [],
      data: []
    },
    currentSurvey: {
      data: null,
      loading: false,
    },
    questionTypes: ["text", "select", "radio", "checkbox", "textarea"],
    notification: {
      show: false,
      type: 'success',
      message: 'ghfhfg'
    }
  },
  getters: {
      getPublicSurveys: (state)=> (categoryId) => {
          return state.surveysPublic.data.filter(item=>{
              return item.category_id === 2
          })
      }
  },
  actions: {

    register({commit}, user) {
      return axiosClient.post('/register', user)
        .then((response) => {
          commit('setUser', response.data.user);
          commit('setToken', response.data.token);
          return response;
        })
          .catch(error => {
              console.log('error catch')
             throw error
            //  return error;
          })
    },
    login({commit}, user) {
      return axiosClient.post('/login', user)
        .then(({data}) => {
          commit('setUser', data.user);
          commit('setToken', data.token);
          return data;
        })
    },
    forgotPassword({commit},user){
          return axiosClient.post('forgot-password',user)
              .then(({data}) => {
                  return data
              })
      },
    resetPassword({commit},user){
        return axiosClient.post('reset-password',user)
            .then(({data}) => {
                return data
            })
    },
    logout({commit}) {
      return axiosClient.post('/logout')
        .then(response => {
          commit('logout')
          return response;
        })
    },
    getUser({commit}) {
      return axiosClient.get('/user')
      .then(res => {
        commit('setUser', res.data)
      })
    },
    getIp({commit}){
          return fetch('https://jsonip.com', { mode: 'cors' })
              .then((resp) => resp.json())
              .then((res) => {
                  commit('setIp', res.ip);
                  return res.ip;
              });
    },
    getDashboardData({commit}) {
      commit('dashboardLoading', true)
      return axiosClient.get(`/dashboard`)
      .then((res) => {
        commit('dashboardLoading', false)
        commit('setDashboardData', res.data)
        return res;
      })
      .catch(error => {
        commit('dashboardLoading', false)
        return error;
      })

    },
    getSurveys({ commit }, {url = null} = {}) {
      commit('setSurveysLoading', true)
      url = url || "/survey";
      return axiosClient.get(url).then((res) => {
        commit('setSurveysLoading', false);
        commit("setSurveys", res.data);
        return res;
      });
    },
    getSurveysPublic({ commit }, {url = null} = {}) {
      commit('setPublicSurveysLoading', true)
      url = url || "/surveys-public";
      return axiosClient.get(url).then((res) => {
        commit('setPublicSurveysLoading', false)
        commit("setSurveysPublic", res.data);
        return res;
      });
    },
    getSurveysByCategoryId({ commit }, category_id) {
          commit('setSurveysLoading', true)
          return axiosClient.get(`/surveys-public/${category_id}`).then((res) => {
              commit('setSurveysLoading', false)
              commit("setSurveysPublic", res.data);
              return res;
          });
      },
    getSurvey({ commit }, id) {
      commit("setCurrentSurveyLoading", true);
      return axiosClient
        .get(`/survey/${id}`)
        .then((res) => {
          commit("setCurrentSurvey", res.data);
          commit("setCurrentSurveyLoading", false);
          return res;
        })
        .catch((err) => {
          commit("setCurrentSurveyLoading", false);
          throw err;
        });
    },
    getSurveyBySlug({ commit }, slug) {
      commit("setCurrentSurveyLoading", true);
      return axiosClient
        .get(`/survey-by-slug/${slug}`)
        .then((res) => {
          commit("setCurrentSurvey", res.data);
          commit("setCurrentSurveyLoading", false);
          return res;
        })
        .catch((err) => {
          commit("setCurrentSurveyLoading", false);
          throw err;
        });
    },
    saveSurvey({ commit, dispatch }, survey) {

      delete survey.image_url;

      return  axiosClient.post("/survey", survey).then((res) => {
          commit('setCurrentSurvey', res.data)
          return res;
        });


    },
    deleteSurvey({ dispatch }, id) {
      return axiosClient.delete(`/survey/${id}`).then((res) => {
       // dispatch('getSurveys')
        return res;
      });
    },
    saveSurveyAnswer({commit}, {surveyId, answers}) {
      return axiosClient.post(`/survey/${surveyId}/answer`, {answers});
    },
    sendVote({},payload){
        console.log(payload);
      return axiosClient.post(`/vote/${payload.id}`);
    },
    getCategories({commit}){
      return axiosClient.get('/categories-api').then((res) => {
          commit('setCategories', res.data)
          return res;
      });
    }
  },
  mutations: {
    logout: (state) => {
      state.user.token = null;
      state.user.data = null;
      sessionStorage.removeItem("TOKEN");
    },

    setUser: (state, user) => {
      state.user.data = user;
    },
    setIp: (state,ip) => {
      state.user.ip = ip;
    },
    setToken: (state, token) => {
      state.user.token = token;
      sessionStorage.setItem('TOKEN', token);
    },
    dashboardLoading: (state, loading) => {
      state.dashboard.loading = loading;
    },
    setDashboardData: (state, data) => {
      state.dashboard.data = data
    },
    setSurveysLoading: (state, loading) => {
      state.surveys.loading = loading;
    },
    setPublicSurveysLoading: (state, loading) => {
      state.surveysPublic.loading = loading;
    },
    setSurveys: (state, surveys) => {
      state.surveys.links = surveys.meta.links;
      state.surveys.data = surveys.data;
    },
    setSurveysPublic: (state, surveys) => {
      state.surveysPublic.links = surveys.meta.links;
      state.surveysPublic.data = surveys.data;
    },
    setCurrentSurveyLoading: (state, loading) => {
      state.currentSurvey.loading = loading;
    },
    setCurrentSurvey: (state, survey) => {
      state.currentSurvey.data = survey.data;
    },
    setCategories:(state,categories) => {
      state.categories = categories
    },
    notify: (state, {message, type}) => {
      state.notification.show = true;
      state.notification.type = type;
      state.notification.message = message;
      setTimeout(() => {
        state.notification.show = false;
      }, 3000)
    },
  },
  modules: {},
});

export default store;
