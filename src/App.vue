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

      h4(style='padding-top: 30px', v-show='formMessage') {{ formMessage }}
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
      products: {},
      selectedProducts: [],
      totalPrice: 0,
      formMessage: '',
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
      const $vm = this;
      const { selectedProducts, totalPrice } = this;
      axios.post('/post.php', { selectedProducts, totalPrice }).then(res => {
        $vm.formMessage = res.data;
      });
    },
    checkItem(item) {
      const { id, price, isChecked } = item;
      const index = this.selectedProducts.indexOf(id);

      this.formMessage = '';

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
