<template>
  <ProductsComponent categoryId="2" :activeIdx="activeIdx"/>
</template>

<script>
import ProductsComponent from './ProductsComponent.vue';
import emitter from 'tiny-emitter/instance';

export default {
  name: 'AccessoriesComponent',

  components: {
    ProductsComponent,
  },

  data() {
    return {
      activeIdx: null,
    }
  },

  beforeMount() {
    emitter.on('active-category-idx', idx => {
      this.activeIdx = idx;
    })
  },

  beforeUnmount() {
    emitter.off('active-category-idx');
  },
}
</script>