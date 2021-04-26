<template lang="pug">
form
  .container
    .row
      p (You can double click on an item to turn it into a folder.)

      //- the demo root element
      ul
        TreeItem.item(
          :item='treeData',
          @make-folder='makeFolder',
          @add-item='addItem'
        )
</template>

<script>
import TreeItem from './components/TreeItem.vue';

export default {
  name: 'App',
  components: {
    TreeItem,
  },
  data() {
    return {
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
    addItem(item) {
      item.children.push({
        name: 'new stuff',
      });
    },
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
