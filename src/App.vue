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
          //- @make-folder='makeFolder',

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
      // products: {
      //   id: 1,
      //   name: 'My Tree',
      //   price: 777,
      //   isChecked: false,
      //   children: [
      //     {
      //       id: 2,
      //       name: 'hello',
      //       price: 777,
      //       isChecked: false,
      //     },
      //     {
      //       id: 3,
      //       name: 'wat',
      //       price: 777,
      //       isChecked: false,
      //     },
      //     {
      //       id: 4,
      //       name: 'child folder',
      //       price: 777,
      //       isChecked: false,
      //       children: [
      //         {
      //           id: 5,
      //           name: 'child folder',
      //           price: 777,
      //           isChecked: false,
      //           children: [
      //             {
      //               id: 6,
      //               name: 'hello',
      //               price: 777,
      //               isChecked: false,
      //             },
      //             {
      //               id: 7,
      //               name: 'wat',
      //               price: 777,
      //               isChecked: false,
      //             },
      //           ],
      //         },
      //         {
      //           id: 8,
      //           name: 'hello',
      //           price: 777,
      //           isChecked: false,
      //         },
      //         {
      //           id: 9,
      //           name: 'wat',
      //           price: 777,
      //           isChecked: false,
      //         },
      //         {
      //           id: 10,
      //           name: 'child folder',
      //           price: 777,
      //           isChecked: false,
      //           children: [
      //             {
      //               id: 11,
      //               name: 'hello',
      //               price: 777,
      //               isChecked: false,
      //             },
      //             {
      //               id: 12,
      //               name: 'wat',
      //               price: 777,
      //               isChecked: false,
      //             },
      //           ],
      //         },
      //       ],
      //     },
      //   ],
      // },
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
    // makeFolder(item) {
    //   this.$set(item, 'children', []);
    //   this.addItem(item);
    // },
    checkItem(item) {
      // item.children.push({
      //   name: 'new stuff',
      // });

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
