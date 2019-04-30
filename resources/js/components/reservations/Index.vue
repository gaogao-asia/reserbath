<template>
    <div>
        <div>
            <h3>予約一覧</h3>
            <p class="text-right">
                <router-link
                    to="/reservations/create"
                    class="pull-right btn btn-primary btn-sm active">新規予約追加</router-link>
            </p>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">予約者氏名</th>
                <th scope="col">予約開始時刻</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="reservation in reservations">
                    <th scope="row">
                        <router-link :to="`/reservations/${reservation.id}`" class="">
                            {{ reservation.id }}
                        </router-link>
                    </th>
                    <td>
                        {{ reservation.user.name }}
                    </td>
                    <td>{{ reservation.reserve_time }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
  name: 'reservation-index',

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

    reservations() {
      return this.$store.getters.reservations
    }

  },

  methods: {
    fetch () {
      this.$store.dispatch('getReservations')
    },

  },
}
</script>