<template>
    <div>
        <cardTop
        :title="'Documentの追加'"
        :btnTitle="'Document一覧に戻る'"
        :btnLink="'/posts/'">
        </cardTop>

        <form>
          <div class="form-group form-check">
            <select
              v-model="category_id"
              class="form-control m-select">
              <option disabled value="">Categoryを選ぶ</option>
              <template
                v-for="(category, index) in categories">
                <option
                  :value="category.id">
                  {{ category.name }}
                </option>
              </template>
            </select>
            <div class="form-group" style="text-align: left;">
              <!-- <label for="exampleFormControlInput1">Name</label>
              <input v-model="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Document Name"> -->
               <v-text-field
                v-model="name"
                hint="ducument name"
              ></v-text-field>
            </div>
            <div class="form-group">
              <tinyMce api-key="vtusjnetekeyyvky2v0cq1rhddmgwimlni7huhg1doec653f" v-model="content"></tinyMce>
            </div>
          </div>
          <primaryBtn @click="postPost()">submit</primaryBtn>
        </form>
    </div>
</template>

<script>
export default {
  name: 'reservation-create',

  data () {
    return {
      category_id: '',
      name: '',
      content: '',
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
    postPost () {
      this.$store.dispatch('postPost', {
        name: this.name,
        content: this.content,
        category_id: this.category_id,
      })
    }

  },
}
</script>

<style lang="scss" scoped>
</style>