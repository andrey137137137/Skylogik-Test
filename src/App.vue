<template lang="pug">
form
  .container
    .row
      h2 {{ areProducts ? "Choose" : "There are no" }} products

      div(v-if='areProducts')
        ul
          TreeItem.item(
            v-for='product in products',
            :key='product.id',
            :item='product',
            @check-item='checkItem'
          )

        h4 Total Price: {{ totalPrice }}
        h4 Selected Products Ids: {{ selectedProducts }}
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
  },
  methods: {
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
    axios
      .get('http://skylogik.test/api/')
      .then(res => {
        $vm.products = res.data;
        console.log(res);
      })
      .catch(err => {
        console.log(err);
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
