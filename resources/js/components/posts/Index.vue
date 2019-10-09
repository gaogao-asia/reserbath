<!-- <template>
    <div>
      <cardTop
      :title="'House Document一覧'"
      :btnTitle="'新規Document追加'"
      :btnLink="'/posts/create'">
      </cardTop>

      <ul class="list-unstyled">
        <li class="media" v-for="category in categories">
          <div class="media-body">
            <h5 class="mt-0 mb-1">{{ category.name }}</h5>
            <template class="media" v-for="post in category.posts">
              <p>
                <router-link
                :to="`/posts/${post.id}`"
                class="">{{ post.name }}</router-link>
              </p>
            </template>
          </div>
        </li>
      </ul>
    </div>
</template> -->
<template>
  <div>
    <b-tabs content-class="mt-3">
      <b-tab title="First" active><p>I'm the first tab</p></b-tab>
      <b-tab title="Second"><p>I'm the second tab</p></b-tab>
      <b-tab title="Disabled" disabled><p>I'm a disabled tab!</p></b-tab>
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
