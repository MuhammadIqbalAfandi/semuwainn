<script>
export default {
  props: {
    photoGrid: Object,
  },
  data() {
    return {
      thumbnails: [],
    }
  },
  computed: {
    photoGridCol() {
      if (this.photoGrid.thumbnails.length >= 5) {
        this.thumbnails = this.photoGrid.thumbnails.filter((_, i) => i <= 3)
        return 'photo-grid--col-4'
      } else if (this.photoGrid.thumbnails.length >= 3) {
        this.thumbnails = this.photoGrid.thumbnails.filter((_, i) => i <= 1)
        return 'photo-grid--col-2'
      }
    },
    existThumbnail() {
      return this.photoGrid.thumbnails.length >= 1
    },
    mainThumbnail() {
      return this.thumbnails[0].url
    },
  },
}
</script>

<template>
  <div class="photo">
    <div :class="photoGridCol" class="photo-grid">
      <div class="photo-grid__main">
        <img v-if="existThumbnail" :src="mainThumbnail" alt="Thumbnail image" />
        <img v-else :src="photoGrid.defaultImage" alt="Thumbnail image" />
      </div>

      <div v-for="(thumbnail, index) in thumbnails" :key="index" class="photo-grid__item">
        <img :src="thumbnail.url" alt="Thumbnail image" />
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.photo {
  position: relative;
  overflow: hidden;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;

  &-grid {
    display: grid;
    grid-auto-rows: 221px 221px;
    gap: 4px;

    &--col-4 {
      grid-template-columns: repeat(4, 1fr);
    }

    &--col-2 {
      grid-template-columns: repeat(3, 1fr);
    }

    &__main {
      grid-column: span 2;
      grid-row: span 2;
      max-height: 446px;
    }

    &__item {
      max-height: 221px;
      min-height: 221px;
    }

    &__main,
    &__item {
      img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    }
  }
}

@media screen and (max-width: 960px) {
  .photo-grid {
    grid-auto-rows: 109px 109px;
    gap: 0;
  }
}
</style>
