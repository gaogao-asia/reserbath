<template>
    <div>
        <div>
            <h3>Documentの追加</h3>
            <p class="text-right">
              <router-link
                to="/posts"
                class="pull-right btn btn-secondary btn-sm active">Document一覧に戻る</router-link>
            </p>
        </div>

        <form>
          <div class="form-group form-check">
            <label for="exampleFormControlInput1">Category</label>
            <select
              v-model="category_id"
              class="form-control">
              <option disabled value="">Please select one</option>
              <template
                v-for="(category, index) in categories">
                <option
                  :value="category.id">
                  {{ category.name }}
                </option>
              </template>
            </select>
            <div class="form-group">
              <label for="exampleFormControlInput1">Name</label>
              <input v-model="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Document Name">
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Example textarea</label>
              <textarea v-model="content" class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
            </div>
          </div>
          <button
            type="button"
            class="btn btn-primary"
            @click="putPost()">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
  name: 'post-edit',

  data () {
    return {
      id: 0,
      name: '',
      content: '',
      category_id: '',
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
    },
    post() {
      let post
      post             = this.$store.getters.post
      this.id          = post.id
      this.name        = post.name
      this.content     = post.content
      this.category_id = post.category.id
      return post
    }

  },

  methods: {
    fetch () {
      this.$store.dispatch('getCategories')
      this.$store.dispatch('getPost', {postId: this.$route.params.id})
    },
    putPost () {
      this.$store.dispatch('putPost', {
        id: this.id,
        name: this.name,
        content: this.content,
        category_id: this.category_id,
      })
    }

  },
}
</script>