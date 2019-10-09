<template>
   <v-btn
    :rounded="rounded"
    :small="small"
    :colors="colors"
    @click="onClick">
    <slot />
  </v-btn>
</template>
<script>
export default {
  props: {
  },
  data (){
    return {
      rounded: true,
      small: true,
      colors: "42A5F5"
    }
  },
  created () {
  },

  methods: {
    onClick() {
      this.$emit("click");
    }
  }
}
</script>
<style lang="scss" scoped>

</style>