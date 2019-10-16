<template>
  <div>
      <div>
          <v-card-title v-if="reservation.user">{{ reservation.user.name }}さんの予約</v-card-title>
          <p class="text-right">
              <primaryBtn>
                <router-link
                to="/reservations/create" class="router-link-primary">新規予約追加</router-link>
              </primaryBtn>
          </p>
      </div>

      <table class="table">
          <thead>
          <tr>
              <th scope="col">ID</th>
              <th scope="col">予約者氏名</th>
              <th scope="col">予約開始時刻</th>
              <th scope="col">編集</th>
          </tr>
          </thead>
          <tbody>
              <tr>
                  <th scope="row">
                    {{ reservation.id }}
                  </th>
                  <td v-if="reservation.user">
                      {{ reservation.user.name }}
                  </td>
                  <td>{{ reservation.reserve_time }}</td>
                  <td>
                    <router-link
                      :to="`/reservations/${reservation.id}/edit`"
                      class="btn btn-danger btn-sm active">予約を編集する</router-link>
                  </td>
              </tr>
          </tbody>
      </table>
      <p class="text-left">
        <secondaryBtn>
          <router-link
          to="/" class="router-link-secondary">予約一覧に戻る</router-link>
        </secondaryBtn>
      </p>
  </div>
</template>

<script>
export default {
  name: 'reservation-show',

  data () {
    return {
    }
  },

  created() {
    this.fetch()
  },

  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    },

    reservation() {
      return this.$store.getters.reservation
    }

  },

  methods: {
    fetch () {
      this.$store.dispatch('getReservation', {reservationId: this.$route.params.id})
    },

  },
}
</script>