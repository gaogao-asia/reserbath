<template>
   <div>
     <v-card-title>{{ title }}</v-card-title>
     <p class="text-right">
      <template v-if="btnType === 'primary'">
        <primaryBtn>
          <router-link
            :to="btnLink"
            class="pull-right router-link-primary">
            {{ btnTitle }}
          </router-link>
        </primaryBtn>
      </template>
      <template v-if="btnType === 'secondary'">
        <secondaryBtn>
          <router-link
            :to="btnLink"
            class="pull-right router-link-secondary">
            {{ btnTitle }}
          </router-link>
        </secondaryBtn>
      </template>
      </p>
   </div>
</template>
<script>
export default {
  props: {
    title: {required: true, type: String},
    btnType: {required: true, type: String},
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