<template>
   <div>
     <v-card-title>{{ title }}</v-card-title>
     <p class="text-right">
        <primaryBtn>
          <router-link
            :to="btnLink"
            class="pull-right">
            {{ btnTitle }}
          </router-link>
        </primaryBtn>
      </p>
   </div>
</template>
<script>
export default {
  props: {
    title: {required: true, type: String},
    btnTitle: {required: true, type: String},
    btnLink: {required: true, type: String},
  },
  data (){
    return {

    }
  },
  created () {
  },

  methods: {
    
  }
}
</script>
<style lang="scss" scoped>

</style>