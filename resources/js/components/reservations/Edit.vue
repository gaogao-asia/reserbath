<template>
    <div>
        <cardTop
        :title="'予約の編集'"
        :btnTitle="'予約一覧に戻る'"
        :btnType="'secondary'"
        :btnLink="'/'">
        </cardTop>

        <form>
          <div class="form-group form-check">
            <label> (予約枠は30分です)</label>
            <select
              v-model="reserve_time"
              class="form-control">
              <template
                v-for="timeOption in timeOptions">
                <option
                  :value="timeOption">
                  {{ timeOption }}
                </option>
              </template>
            </select>
          </div>
          <primaryBtn @click="putReservation()">submit</primaryBtn>
        </form>
    </div>
</template>

<script>
export default {
  name: 'reservation-edit',

  data () {
    return {
      reserve_time: ''
    }
  },

  created() {
    this.fetch()
    this.reserve_time = this.reservation.reserve_time
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    },
    baseTime() {
      return this.$store.getters.baseTime
    },
    timeOptions() {
      return this.$store.getters.timeOptions
    },
    reservation() {
      return this.$store.getters.reservation
    }

  },

  methods: {
    fetch () {
      this.$store.dispatch('createReservation')
      this.$store.dispatch('getReservation', {reservationId: this.$route.params.id})
    },
    putReservation () {
      this.$store.dispatch('putReservation', {
        reservationId: this.$route.params.id,
        currentUser: this.currentUser,
        reserve_time: this.reserve_time,
        base_time: this.baseTime,
      })
    }

  },
}
</script>