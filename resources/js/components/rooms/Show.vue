<template>
  <div>
      <!-- <div>
          <p class="text-right">
              <primaryBtn>
                <router-link
                to="/reservations/create" class="router-link-primary">新規予約追加</router-link>
              </primaryBtn>
          </p>
      </div> -->

      <!-- slideshow -->
      <div class="row">
        <swiper :options="swiperOption" class="swiper-box">
          <template v-for="room_file in room.room_files">
            <swiper-slide>
              <img :src="room_file.file.url" class="swiper-img">
            </swiper-slide>
          </template>
          <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div>
          <div class="swiper-button-next swiper-button-white" slot="button-next"></div>
        </swiper>
      </div>

      <div class="mt-2 mb-2">
        <div class="row">
          <div class="col-12">
            <div class="text-right">
              <!-- https://vuetifyjs.com/ja/components/progress-linear -->
              <!-- <v-container>
                <div class="w-25 text-right" style="float: right;">
                  <div class="text-right mb-2">
                    <v-icon>thumb_up_alt</v-icon>1
                    <v-icon>thumb_down_alt</v-icon>0
                  </div>
                  <v-progress-linear
                    v-model="percent"
                    background-opacity=".3"
                    background-color="#1867c0"
                    color="#1867c0"
                    height="5"
                    :reactive="reactive"
                    :disabled="disabled"
                  >
                  </v-progress-linear>
                </div>
              </v-container> -->
            </div>

            <v-card-title>{{ room.name }}</v-card-title>
            <v-card-text>{{ room.content }}</v-card-text>
          </div>
        </div>
      </div>

      <p class="text-left">
        <secondaryBtn>
          <router-link
          to="/rooms" class="router-link-secondary">お部屋一覧に戻る</router-link>
        </secondaryBtn>
      </p>
  </div>
</template>

<script>

export default {
  name: 'room-show',

  data () {
    return {
      swiperOption: {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        mousewheel: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
          clickable: true
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true
        }
      },
      percent: 0,
      reactive: false,
      disabled: true,
    }
  },

  created() {
    this.fetch()
    this.percent = 10
  },

  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    },

    room() {
      return this.$store.getters.room
    }

  },

  methods: {
    fetch () {
      this.$store.dispatch('getRoom', {roomId: this.$route.params.id})
    },

  },
}
</script>
<style lang="scss" scoped>
  .swiper-img {
    width: 100%;
    height: 320px;
    object-fit: cover;
  }
</style>