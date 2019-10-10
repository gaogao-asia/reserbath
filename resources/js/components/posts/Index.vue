<template>
    <div>
      <cardTop
      :title="'House Document一覧'"
      :btnTitle="'新規Document追加'"
      :btnLink="'/posts/create'"
      :btnType="'primary'">
      </cardTop>

      <b-tabs content-class="mt-3">
        <template v-for="category in categories">
            <b-tab :title="category.name" active>
              <template v-for="post in category.posts">
                <p>
                  <router-link
                  :to="`/posts/${post.id}`">{{ post.name }}</router-link>
                </p>
              </template>
            </b-tab>
        </template>
      </b-tabs>
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
