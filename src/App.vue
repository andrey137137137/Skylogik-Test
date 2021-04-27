<template lang="pug">
.container
  .row
    h2 {{ title }}

    form(v-if='areProducts', @submit.prevent='onSubmit')
      ul
        TreeItem.item(
          v-for='product in products',
          :key='product.id',
          :item='product',
          @check-item='checkItem'
        )

      h4 Total Price: {{ totalPrice }}
      h4 Selected Products Ids: {{ selectedProducts }}

      input.btn.btn-primary(
        :disabled='isSubmitDisabled',
        type='submit',
        value='Submit'
      )
</template>

<script>
import axios from 'axios';
import TreeItem from './components/TreeItem.vue';

export default {
  name: 'App',
  components: {
    TreeItem,
  },
  data() {
    return {
      selectedProducts: [],
      totalPrice: 0,
      products: {},
    };
  },
  computed: {
    areProducts() {
      for (const key in this.products) {
        if (Object.hasOwnProperty.call(this.products, key)) {
          return true;
        }
      }

      return false;
    },
    title() {
      return (this.areProducts ? 'Choose' : 'There are no') + ' products';
    },
    isSubmitDisabled() {
      return !this.totalPrice;
    },
  },
  methods: {
    onSubmit() {
      // const $vm = this;
      const { selectedProducts, totalPrice } = this;
      // const request = axios.create({
      //   headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      // });
      axios.post('/post.php', { selectedProducts, totalPrice }).then(res => {
        console.log('POSTED');
        console.log(res);
      });
    },
    checkItem(item) {
      const { id, price, isChecked } = item;
      const index = this.selectedProducts.indexOf(id);

      item.isChecked = !isChecked;

      if (item.isChecked) {
        this.totalPrice += price;

        if (index === -1) {
          this.selectedProducts.push(id);
        }
      } else {
        this.totalPrice -= price;

        if (index >= 0) {
          this.selectedProducts.splice(index, 1);
        }
      }
    },
  },
  created() {
    const $vm = this;
    axios.get('/').then(res => {
      $vm.products = res.data;
      console.log('GETTED');
      console.log(res);
    });
  },
};
</script>

<style>
body {
  font-family: Menlo, Consolas, monospace;
  color: #444;
}
.item {
  cursor: pointer;
}
.bold {
  font-weight: bold;
}
ul {
  padding-left: 1em;
  line-height: 1.5em;
  list-style-type: dot;
}
</style>
