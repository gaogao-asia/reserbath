import {getLocalUser} from './helpers/auth'
// import {getLocalUserFactoryId} from './helpers/auth'

const user = getLocalUser()
// // const factoryId = getLocalUserFactoryId(user)

export default {
  state: {
    currentUser: user,
    reservations: [],
    reservation: [],
    baseTime: [],
    timeOptions: [],
  },

  getters: {
    currentUser (state) {
      return state.currentUser
    },
    reservations (state) {
      return state.reservations
    },
    reservation (state) {
      return state.reservation
    },
    baseTime (state) {
      return state.baseTime
    },
    timeOptions (state) {
      return state.timeOptions
    },
  },

  mutations: {
    updateReservations (state, payload) {
      state.reservations = payload
    },
    updateReservation (state, payload) {
      state.reservation = payload
    },
    updateBaseTime (state, payload) {
      state.baseTime = payload
    },
    updateTimeOptions (state, payload) {
      state.timeOptions = payload
    },
    // logout (state) {
    //   localStorage.removeItem('user')
    //   state.isLoggedIn = false
    //   state.currentUser = null
    // }
  },

  actions: {
    getReservations ({ commit }) {
      axios
        .get('/api/reservations', {})
        .then((response) => {
          commit('updateReservations', response.data.reservations || [])
        })
    },
    getReservation ({ commit }, { reservationId }) {
      axios
        .get(`/api/reservations/${reservationId}`, {})
        .then((response) => {
          commit('updateReservation', response.data.reservation || [])
        })
    },
    createReservation ({ commit }, ) {
      axios
        .get(`/api/reservations/create`, {})
        .then((response) => {
          commit('updateBaseTime', response.data.baseTime || [])
          commit('updateTimeOptions', response.data.timeOptions || [])
        })
    },
    postReservation ({ commit }, { currentUser, reserve_time, base_time}) {
      console.log(currentUser)
      axios
        .post(`/api/reservations`,{
          user_id: currentUser.id,
          reserve_time: reserve_time,
          base_time: base_time,
        })
        .then((response) => {
          commit('updateReservations', response.data.reservations || [])
          window.location.href = `/`
        })
        .catch((err) => {
          alert(err)
        })
    },
     putReservation ({ commit }, { reservationId, currentUser, reserve_time, base_time}) {
      axios
        .put(`/api/reservations/${reservationId}`,{
          user_id: currentUser.id,
          reserve_time: reserve_time,
          base_time: base_time,
        })
        .then((response) => {
          commit('updateReservation', response.data.reservation || [])
          window.location.href = `/reservations/${reservationId}`
        })
        .catch((err) => {
          alert(err)
        })
    },
    // login ({ commit }) {
    //   axios
    //     .get('/auth/login/facebook', {})
    //     .then((response) => {

    //     })
    // },

    // logout ({ commit }) {
    //   axios
    //     .post('/logout', {})
    //     .then((response) => {
    //       window.location.href = '/'z
    //       // window.location.href = $route
    //     })
    // }
  },
}