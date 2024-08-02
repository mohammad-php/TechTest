<template>
  <nav class="pagination" aria-label="Page navigation">
    <ul class="pagination__list">
      <li
          v-for="page in pages"
          :key="page"
          :class="['pagination__item', { 'pagination__item--active': page === currentPage }]"
      >
        <button
            @click="changePage(page)"
            class="pagination__link"
            :class="{ 'pagination__link--active': page === currentPage }"
        >
          {{ page }}
        </button>
      </li>
      <li
          class="pagination__item pagination__item--prev"
          :class="{ 'pagination__item--disabled': currentPage === 1 }"
      >
        <button
            @click="changePage(currentPage - 1)"
            class="pagination__link"
            :class="{ 'pagination__link--disabled': currentPage === 1 }"
        >
          Previous
        </button>
      </li>
      <li
          class="pagination__item pagination__item--next"
          :class="{ 'pagination__item--disabled': currentPage === totalPages }"
      >
        <button
            @click="changePage(currentPage + 1)"
            class="pagination__link"
            :class="{ 'pagination__link--disabled': currentPage === totalPages }"
        >
          Next
        </button>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    currentPage: {
      type: Number,
      required: true,
    },
    totalPages: {
      type: Number,
      required: true,
    },
  },
  computed: {
    pages() {
      return Array.from({ length: this.totalPages }, (v, k) => k + 1);
    },
  },
  methods: {
    changePage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.$emit('page-changed', page);
      }
    },
  },
};
</script>

<style scoped lang="scss">
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 20px;

  &__list {
    list-style: none;
    padding: 0;
    display: flex;
    gap: 5px;
  }

  &__item {
    &--disabled .pagination__link {
      cursor: not-allowed;
      opacity: 0.5;
    }

    &--active .pagination__link {
      background-color: $primary-color;
      border-color: $primary-color;
      color: $background-color;
    }

    &--prev,
    &--next {
      display: inline-block;
      margin: 0 5px;
    }
  }

  &__link {
    background-color: $background-color;
    border: 1px solid $border-color;
    padding: 8px 12px;
    border-radius: 4px;
    color: $primary-color;
    cursor: pointer;
    outline: none;

    &:hover:not(&--disabled) {
      background-color: lighten($background-color, 10%);
    }

    &--active {
      background-color: $primary-color;
      border-color: $primary-color;
      color: $background-color;
    }

    &--disabled {
      cursor: not-allowed;
      opacity: 0.5;
    }
  }
}
</style>
