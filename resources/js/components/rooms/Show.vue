<template>
  <div>
      <div>
          <p class="text-right">
              <primaryBtn>
                <router-link
                to="/reservations/create" class="router-link-primary">新規予約追加</router-link>
              </primaryBtn>
          </p>
      </div>

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
      <!-- <v-icon>thumb_up_alt</v-icon>
      <v-icon>thumb_down_alt</v-icon> -->
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
    }
  },

  created() {
    this.fetch()
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