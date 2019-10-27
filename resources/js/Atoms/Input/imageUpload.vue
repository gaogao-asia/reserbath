<template>
  <div class="c-image-upload">
    <div
      v-if="file.length"
      class="c-image-upload__wrap">
      <img :src="file[0].blob">
      <div
        class="m-btn text-center"
        btn-type="file-remove"
        @click.prevent="removeFile(file)">
          <span>削除</span>
      </div>
    </div>

    <div
      v-if="Object.keys(uploadedImage).length"
      class="c-image-upload__wrap">
      <img
        v-if="uploadedImage.url"
        :src="uploadedImage.url">

      <div
        class="m-btn text-center"
        btn-type="file-remove"
        @click="removeUploadedFile()">
          <span>削除</span>
      </div>
    </div>


    <div
      v-if="isOpen"
      class="c-image-upload__input"
      @click="selectFiles()">
      <p>ドラッグアンドドロップ またはクリックしてファイルをアップロード</p>
      <file-upload
        :input-id="inputId"
        :multiple="true"
        :maximum="maximum"
        :drop="true"
        :accept="accept"
        :extensions="extensions"
        v-model="file"
        @input-filter="inputFilter"
        @input="updatetValue"
        ref="upload">
      </file-upload>
    </div>
  </div>
</template>
<script>
import FileUpload from 'vue-upload-component'
export default {
  components: {
    FileUpload,
  },
  props: {
    inputId: {required: true, type: String},
    accept: {required: true, type: String},
    extensions: {required: true, type: Array},
    maximum: {required: true, type: Number},
    bgImage: {required: true},
    product: {required: true, type: Object},
  },
  data (){
    return {
      file: [],
      uploadedImage: [],
      isOpen: false
    }
  },
  created () {
    this.uploadedImage = this.bgImage
    if (Object.keys(this.uploadedImage).length) {
      this.isOpen = false
    } else {
      this.isOpen = true
    }
  },

  methods: {
    selectFiles (){
      const input = document.querySelector(`#${this.inputId}`);
      input.click()
    },
    inputFilter(newFile, oldFile, prevent) {
      if (newFile && !oldFile) {

        if (!/\.(gif|jpe?g|png|webp)$/i.test(newFile.name)) {
        }
        // Create the 'blob' field for thumbnail preview
        newFile.blob = ''
        let URL = window.URL || window.webkitURL
        if (URL && URL.createObjectURL) {
          newFile.blob = URL.createObjectURL(newFile.file)
        }

        this.isOpen = false

      }
    },
    updatetValue (value) {
      this.commitFile(this.file)
    },
    removeFile (file) {
      // this.$refs.upload.remove(file)
      this.file = []
      this.commitFile(this.file)
      this.isOpen = true
    },
    removeUploadedFile () {
      // this.removeUploadedFileFromDB()
      this.uploadedImage = {}
      this.commitFile([])
      this.isOpen = true
    },
    // removeUploadedFileFromDB () {
    //   this.$axios
    //     .post('/', {
    //       bgImage: this.uploadedImage,
    //       product: this.product
    //     })
    //     .then(() => {
    //     })
    //     .catch((err) => {
    //     })
    // },
    commitFile (file) {
      this.$emit('input', file)
    },

  }
}
</script>
<style lang="scss" scoped>
.c-image-upload {

  img {
    width: 314px;
    height: 214px;
    object-fit: cover;
  }

  .m-btn {
    width: 314px;
    margin-top: 16px;
  }

  &__wrap {
    // display: flex;
  }

  &__input {
    width: 100%;
    position: relative;
    min-height: 162px;
    background: #f5f5f5;
    border: 1px dashed #ccc;
    text-align: center;
    padding: 40px;
    font-size: 14px;
    line-height: 1.5;

    &:hover {
       opacity: .8;
    }
  }
}
@media screen and (max-width: 640px) {
  .c-image-upload {
    margin: 0 auto;
    width: 90%;
  }
}

</style>