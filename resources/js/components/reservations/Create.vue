<template>
    <div>
        <div>
            <h3>予約の追加</h3>
            <p class="text-right">
              <router-link
                to="/"
                class="pull-right btn btn-secondary btn-sm active">予約一覧に戻る</router-link>
            </p>
        </div>

        <form>
          <div class="form-group form-check">
            <label> (予約枠は30分です)</label>
            <select
              v-model="reserve_time"
              class="form-control">
              <option disabled value="">Please select one</option>
              <template
                v-for="(timeOption, index) in timeOptions">
                <option
                  :value="index">
                  {{ timeOption }}
                </option>
              </template>
            </select>
          </div>
          <button
            type="submit"
            class="btn btn-primary"
            @click="postReservation()">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
  name: 'reservation-create',

  data () {
    return {
      reserve_time: '',
    }
  },

  created() {
    this.fetch()
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
    }

  },

  methods: {
    fetch () {
      this.$store.dispatch('createReservation')
    },
    postReservation () {
      this.$store.dispatch('postReservation', {
        currentUser: this.currentUser,
        reserve_time: this.reserve_time,
        base_time: this.baseTime,
      })
    }

  },
}
</script>