<template>
   <v-btn
    :rounded="rounded"
    :small="small"
    :color="color"
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
      color: "primary"
    }
  },
  created () {
    console.log(1)
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
  background-color: #1867c0 !important;
  border-color: #1867c0 !important;
}
</style>