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
    posts: [],
    post: [],
    categories: [],
    rooms: [],
    room: [],
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
    posts (state) {
      return state.posts
    },
    post (state) {
      return state.post
    },
    categories (state) {
      return state.categories
    },
    baseTime (state) {
      return state.baseTime
    },
    timeOptions (state) {
      return state.timeOptions
    },
    rooms (state) {
      return state.rooms
    },
    room (state) {
      return state.room
    },
  },

  mutations: {
    updateReservations (state, payload) {
      state.reservations = payload
    },
    updateReservation (state, payload) {
      state.reservation = payload
    },
    updatePosts (state, payload) {
      state.posts = payload
    },
    updatePost (state, payload) {
      state.post = payload
    },
    updateCategories (state, payload) {
      state.categories = payload
    },
    updateBaseTime (state, payload) {
      state.baseTime = payload
    },
    updateTimeOptions (state, payload) {
      state.timeOptions = payload
    },
    updateRooms (state, payload) {
      state.rooms = payload
    },

    updateRoom (state, payload) {
      state.room = payload
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
    getPosts ({ commit }) {
      axios
        .get('/api/posts', {})
        .then((response) => {
          commit('updatePosts', response.data.posts || [])
        })
    },
    getPost ({ commit }, { postId }) {
      axios
        .get(`/api/posts/${postId}`, {})
        .then((response) => {
          commit('updatePost', response.data.post || [])
        })
    },
    postPost ({ commit }, { name, content, category_id }) {
      axios
        .post(`/api/posts`,{
          name: name,
          content: content,
          category_id: category_id,
        })
        .then((response) => {
          commit('updatePost', response.data.post || [])
          window.location.href = `/posts`
        })
        .catch((err) => {
          alert(err)
        })
    },
    putPost ({ commit }, { id, name, content, category_id}) {
      axios
        .put(`/api/posts/${id}`,{
          name: name,
          content: content,
          category_id: category_id,
        })
        .then((response) => {
          commit('updatePost', response.data.updatePost || [])
          window.location.href = `/posts/${id}`
        })
        .catch((err) => {
          alert(err)
        })
    },
    getCategories ({ commit }) {
      axios
        .get('/api/categories', {})
        .then((response) => {
          commit('updateCategories', response.data.categories || [])
        })
    },
    getRooms ({ commit }) {
      axios
        .get('/api/rooms', {})
        .then((response) => {
          commit('updateRooms', response.data.rooms || [])
        })
    },
    getRoom ({ commit }, { roomId }) {
      axios
        .get(`/api/rooms/${roomId}`, {})
        .then((response) => {
          commit('updateRoom', response.data.room || [])
        })
    },
    postRoom ({ commit }, { formData }) {
      let config = {
          headers: {
              'content-type': 'multipart/form-data'
          }
      }
      axios
        .post(`/api/rooms`, formData, config)
        .then((response) => {
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