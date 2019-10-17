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
          <div class="col-6">
            <v-card
              class="mx-auto"
            >
              <v-img
                class="white--text align-end"
                height="200px"
                src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
              >
                <!-- <v-card-title>Top 10 Australian beaches</v-card-title>
                <v-card-sub-title>Top</v-card-sub-title> -->
                <v-card-actions>
                <v-list-item class="grow">

                  <v-list-item-content>
                    <v-list-item-title>Evan You</v-list-item-title>
                  </v-list-item-content>

                  <v-row
                    align="center"
                    justify="end"
                  >
                    <v-icon class="">mdi-heart</v-icon>
                    <span class="subheading mr-2">256</span>
                  </v-row>
                </v-list-item>
              </v-card-actions>
              </v-img>
            </v-card>
          </div>
          <div class="col-6">
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  name: 'post-index',

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

    categories() {
      return this.$store.getters.categories
    }

  },

  methods: {
    fetch () {
      this.$store.dispatch('getCategories')
    },

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
}
</style>