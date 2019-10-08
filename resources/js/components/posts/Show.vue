<template>
    <div>
        <div>
            <h3>{{ post.name }}</h3>
            <p class="text-right">
                <router-link
                  :to="`/posts/${post.id}/edit`"
                  class="pull-right btn btn-primary btn-sm active">このDocumentを編集する</router-link>
            </p>
        </div>

        <ul class="list-unstyled">

          <li class="media">
            <div class="media-body">
                <p>
                  {{ post.content }}
                </p>
            </div>
          </li>
        </ul>
         <p class="text-left">
          <router-link
            to="/posts"
            class="pull-right btn btn-secondary btn-sm active">Document一覧に戻る</router-link>
        </p>
    </div>
</template>

<script>
export default {
  name: 'post-show',

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

    post() {
      return this.$store.getters.post
    }

  },

  methods: {
    fetch () {
      this.$store.dispatch('getPost', {postId: this.$route.params.id})
    },

  },
}
</script>
