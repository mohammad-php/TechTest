<template>
  <div>
    <div v-if="loading" class="article-list__loading text-center">
      Loading...
    </div>
    <div v-else-if="error" class="article-list__error text-center">
      Error loading articles.
    </div>
    <div v-else>
      <h1 class="article-list__heading">Articles</h1>
      <div class="article-list__container">
        <div v-for="article in articles" :key="article.id" class="article-list__item">
          <div class="article-card box-shadow">
            <div class="article-card__body">
              <img
                  v-if="article.image_url"
                  :src="article.image_url"
                  alt="Article Image"
                  class="article-card__image"
              />
              <h5 class="article-card__title">{{ article.title }}</h5>
              <p class="article-card__content">{{ article.content }}</p>
              <p class="article-card__meta">
                <small>Published on: {{ new Date(article.created_at).toLocaleDateString() }}</small>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div v-if="articles" class="pagination-container flex-center">
        <pagination
            :currentPage="currentPage"
            :totalPages="lastPage"
            @page-changed="fetchArticles"
        />
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Pagination from '../Pagination.vue';

export default {
  components: {
    Pagination,
  },
  data() {
    return {
      articles: [],
      currentPage: 1,
      perPage: 10,
      lastPage: 1,
      total: 0,
      loading: true,
      error: false,
    };
  },
  created() {
    this.fetchArticles(this.currentPage);
  },
  methods: {
    async fetchArticles(page) {
      this.loading = true;
      this.error = false;
      this.currentPage = page;

      try {
        const response = await axios.get('/api/articles', {
          params: { page, per_page: this.perPage },
        });
        this.articles = response.data.data;
        this.currentPage = response.data.current_page;
        this.lastPage = response.data.last_page;
        this.total = response.data.total;
      } catch (error) {
        console.error('Error fetching articles:', error);
        this.error = true;
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped lang="scss">
.article-list {
  &__heading {
    font-size: 2rem;
    margin-bottom: 20px;
    text-align: center;
  }

  &__loading,
  &__error {
    text-align: center;
    margin: 20px 0;
  }

  &__container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin-top: 20px;
  }

  &__item {
    flex: 1 1 100%;
    max-width: 100%;
    display: flex;

    @media (min-width: 576px) {
      flex: 1 1 48%;
      max-width: 48%;
    }

    @media (min-width: 768px) {
      flex: 1 1 30%;
      max-width: 30%;
    }
  }
}

.article-card {
  background-color: $background-color;
  border: 1px solid $border-color;
  border-radius: 8px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  width: 100%;
  padding: 1rem;

  &__body {
    padding: 15px;
  }

  &__title {
    font-size: $font-size-large;
    margin-bottom: 10px;
    color: $text-color;
  }

  &__content {
    font-size: $font-size-base;
    color: $secondary-color;
    margin-bottom: 15px;
  }

  &__meta {
    font-size: $font-size-small;
    color: $meta-color;
  }

  &__image {
    max-width: 100%;
    height: auto;
    margin-top: 10px;
    border-radius: 4px;
  }
}

.pagination-container {
  width: 100%;
  margin-top: 20px;
}
</style>
