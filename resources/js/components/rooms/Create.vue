<template>
    <div>
        <cardTop
        :title="'Roomの追加'"
        :btnTitle="'Room一覧に戻る'"
        :btnType="'secondary'"
        :btnLink="'/rooms/'">
        </cardTop>

        <form>
          <div class="form-group form-check">
            <select
              v-model="room_id"
              class="form-control m-select">
              <option disabled value="">Roomを選ぶ</option>
              <template
                v-for="(room, index) in rooms">
                <option
                  :value="room.id">
                  {{ room.name }}
                </option>
              </template>
            </select>
            <div class="form-group mt-3" style="text-align: left;">
              <image-upload
                @input="onInputChildBgImage"
                :input-id="'bg-image-upload'"
                :accept="'image/*'"
                :extensions="['jpg', 'png', 'webp']"
                :maximum="1"
                :bg-image="{}"
                :product="{}"
              ></image-upload>
            </div>
          </div>
          <primaryBtn @click="postRoom()">submit</primaryBtn>
        </form>
    </div>
</template>

<script>
export default {
  name: 'room-create',

  data () {
    return {
      room_id: '',
      bg_image: '',
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
    }

  },

  methods: {
    fetch () {
      this.$store.dispatch('getRooms')
    },
    postRoom () {
      let formData  = this.setFormData()
      this.$store.dispatch('postRoom', {
        formData
      })
    },
    onInputChildBgImage (file) {
      this.bg_image = file
    },
    setFormData () {
      let formData = new FormData()

      if (this.bg_image) { formData.append('bg_image', this.bg_image[0].file) }
      formData.append('room_id', this.room_id)

      return formData
    },
  },
}
</script>

<style lang="scss" scoped>
</style>