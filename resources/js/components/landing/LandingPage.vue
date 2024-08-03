<template>
  <div class="landing-page">
    <h1 class="landing-page__header">Welcome to TechTest</h1>
    <p class="landing-page__description">Choose a section to explore:</p>
    <ul class="landing-page__nav-list">
      <li class="landing-page__nav-list__item">
        <router-link class="landing-page__nav-list__item__link" to="/articles">Articles</router-link>
      </li>
      <li class="landing-page__nav-list__item">
        <router-link class="landing-page__nav-list__item__link" to="/fibonacci">Fibonacci</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'LandingPage',
};
</script>

<style scoped lang="scss">
//@import '../sass/landing.scss';
</style>
