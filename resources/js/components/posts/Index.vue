<template>
    <div>
        <div>
            <h3>House Document一覧</h3>
            <p class="text-right">
                <router-link
                  to="/posts/create"
                  class="pull-right btn btn-primary btn-sm active">新規Document追加</router-link>
            </p>
        </div>

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
