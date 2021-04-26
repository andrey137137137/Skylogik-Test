<template lang="pug">
form
  .container
    .row
      h2 Choose products.

      //- the demo root element
      ul
        TreeItem.item(
          :item='treeData',
          @make-folder='makeFolder',
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
      treeData: {
        id: 1,
        name: 'My Tree',
        price: 777,
        isChecked: false,
        children: [
          {
            id: 2,
            name: 'hello',
            price: 777,
            isChecked: false,
          },
          {
            id: 3,
            name: 'wat',
            price: 777,
            isChecked: false,
          },
          {
            id: 4,
            name: 'child folder',
            price: 777,
            isChecked: false,
            children: [
              {
                id: 5,
                name: 'child folder',
                price: 777,
                isChecked: false,
                children: [
                  {
                    id: 6,
                    name: 'hello',
                    price: 777,
                    isChecked: false,
                  },
                  {
                    id: 7,
                    name: 'wat',
                    price: 777,
                    isChecked: false,
                  },
                ],
              },
              {
                id: 8,
                name: 'hello',
                price: 777,
                isChecked: false,
              },
              {
                id: 9,
                name: 'wat',
                price: 777,
                isChecked: false,
              },
              {
                id: 10,
                name: 'child folder',
                price: 777,
                isChecked: false,
                children: [
                  {
                    id: 11,
                    name: 'hello',
                    price: 777,
                    isChecked: false,
                  },
                  {
                    id: 12,
                    name: 'wat',
                    price: 777,
                    isChecked: false,
                  },
                ],
              },
            ],
          },
        ],
      },
    };
  },
  methods: {
    makeFolder(item) {
      this.$set(item, 'children', []);
      this.addItem(item);
    },
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
    axios
      .get('http://skylogik.test/')
      .then(function (response) {
        // handle success
        console.log(response);
      })
      .catch(function (error) {
        // handle error
        console.log(error);
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
