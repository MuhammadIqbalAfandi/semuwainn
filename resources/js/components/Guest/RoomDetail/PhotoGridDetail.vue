<script>
export default {
  props: {
    photoGrid: Object,
  },
  data() {
    return {
      images: [],
    }
  },
  computed: {
    photoGridCol() {
      if (this.photoGrid.images.length >= 5) {
        this.images = this.photoGrid.images.filter((item, index) => {
          if (index > 0 && index <= 4) {
            return item
          }
        })
        return 'photo-grid--col-4'
      } else if (this.photoGrid.images.length >= 3) {
        this.images = this.photoGrid.images.filter((item, index) => {
          if (index > 0 && index <= 2) {
            return item
          }
        })
        return 'photo-grid--col-2'
      }
    },
  },
}
</script>

<template>
  <div class="photo">
    <div :class="photoGridCol" class="photo-grid">
      <template v-if="images.length">
        <div class="photo-grid__main">
          <img :src="photoGrid.images[0]" alt="Main image" />
        </div>

        <div v-for="(image, index) in images" :key="index" class="photo-grid__item">
          <img :src="image" alt="Item image" />
        </div>
      </template>

      <div v-else class="photo-grid__main">
        <img v-if="photoGrid.images.length >= 1" :src="photoGrid.images[0]" alt="Main image" />
        <img v-else :src="photoGrid.defaultImage" alt="Main image" />
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
