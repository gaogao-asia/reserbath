<template>
    <div>
        <cardTop
        :title="post.name"
        :btnTitle="'このDocumentを編集する'"
        :btnLink="`/posts/${post.id}/edit`"
        btnType="secondary">
        </cardTop>

        <ul class="list-unstyled">

          <li class="media">
            <div class="media-body">
                 <div v-html="post.content"></div>
            </div>
          </li>
        </ul>
         <p class="text-left">
            <secondaryBtn>
              <router-link
              to="/posts" class="router-link-secondary">Document一覧に戻る</router-link>
            </secondaryBtn>
        </p>
    </div>
</template>

<script>
export default {
  name: 'post-show',

  data () {
    return {
      compiledContent: ''
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
    },
  },

  methods: {
    fetch () {
      this.$store.dispatch('getPost', {postId: this.$route.params.id})
    },
  },
}
</script>
