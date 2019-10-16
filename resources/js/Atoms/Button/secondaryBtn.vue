<template>
   <v-btn
    :rounded="rounded"
    :small="small"
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
.v-btn {
  background-color: #f5f5f5 !important;
  border-color: #f5f5f5 !important;
}
</style>