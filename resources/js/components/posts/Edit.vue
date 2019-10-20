<template>
    <div>
        <cardTop
        :title="'Documentの編集'"
        :btnTitle="'Document一覧に戻る'"
        :btnLink="'/posts/'">
        </cardTop>

        <form>
          <div class="form-group form-check">
            <select
              v-model="category_id"
              class="form-control m-select">
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
              <v-text-field
                v-model="name"
                hint="Document Name"
              ></v-text-field>
            </div>
            <div class="form-group">
              <tinyMce api-key="vtusjnetekeyyvky2v0cq1rhddmgwimlni7huhg1doec653f" v-model="content"></tinyMce>
            </div>
          </div>
          <primaryBtn @click="putPost()">submit</primaryBtn>
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
    this.fetchCategories()
    this.fetchPost()
    this.setPost()
  },

  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    },
    categories() {
      return this.$store.getters.categories
    },
    post() {
      return this.$store.getters.post
    }
  },

  methods: {
     setPost() {
      let post
      post             = this.$store.getters.post

      this.id          = post.id
      this.name        = post.name
      this.content     = post.content
      this.category_id = post.category.id
    },
    fetchCategories () {
      this.$store.dispatch('getCategories')
    },
    fetchPost () {
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