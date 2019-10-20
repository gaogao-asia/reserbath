<template>
    <div>
      <cardTop
      :title="'お部屋一覧'"
      :btnTitle="'新規Document追加'"
      :btnLink="'/posts/create'"
      :btnType="'primary'">
      </cardTop>

      <div class="container-fluid">
        <div class="row">
          <template v-for="room in rooms">
            <div class="col-6">
              <router-link
              :to="`/rooms/${room.id}`">
                <v-card
                  class="mx-auto"
                >
                  <v-img
                    class="white--text align-end"
                    height="200px"
                    :src="room.room_files[0].file.url"
                  >
                    <v-card-actions>
                      <v-list-item class="grow">

                        <v-list-item-content>
                          <v-list-item-title>{{ room.name }}</v-list-item-title>
                        </v-list-item-content>

                        <v-row
                          align="right"
                          justify="end"
                          class="v-row"
                        >
                          <v-icon>favorite</v-icon>
                            <span class="subheading mr-2">{{ getTotalScore(room.room_scores) }}</span>
                        </v-row>
                      </v-list-item>
                    </v-card-actions>
                  </v-img>
                </v-card>
              </router-link>
            </div>
          </template>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  name: 'room-index',

  data () {
    return {
      likes: 0,
    }
  },

  created() {
    this.fetch()
  },

  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    },

    rooms() {
      return this.$store.getters.rooms
    },

  },

  methods: {
    fetch () {
      this.$store.dispatch('getRooms')
    },

    getTotalScore(room_scores) {
      let totalScore = 0;
      room_scores.map(score => totalScore += score.score)
      return totalScore
    }

  },
}
</script>
<style lang="scss" scoped>
.v-card__actions {
  padding-top: 145px;
  .v-list-item__title {
    color: #fff;
    font-size: 1rem;
  }

  .v-row {
    flex: none;
    .v-icon {
      color: #F44336 !important;
    }
    span {
      color: #fff;
      font-weight: bolder;
    }
  }
}
</style>