<template>
    <div>
      <cardTop
      :title="'お部屋一覧'"
      :btnTitle="'お部屋の写真を追加'"
      :btnLink="'/rooms/create'"
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
                    :src="getImage(room.room_files)"
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
    },
    getImage(room_files) {
      if (room_files[0]) {
        return room_files[0].file.url
      }

      return 'https://sphere-app-production.s3-ap-northeast-1.amazonaws.com/sphere/img/photo/1571046297_EF86A256-7740-4A51-85B4-5C43A01C806D.jpeg'
    }

  },
}
</script>
<style lang="scss" scoped>
a {
  text-decoration: none;
}

img {
  &:hover {
    opacity: .8;
  }
}

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