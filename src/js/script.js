// demo data
var treeData = {
  id: 1,
  name: 'My Tree',
  price: 777,
  children: [
    {
      id: 2,
      name: 'hello',
      price: 777,
    },
    {
      id: 3,
      name: 'wat',
      price: 777,
    },
    {
      id: 4,
      name: 'child folder',
      price: 777,
      children: [
        {
          id: 5,
          name: 'child folder',
          price: 777,
          children: [
            {
              id: 6,
              name: 'hello',
              price: 777,
            },
            {
              id: 7,
              name: 'wat',
              price: 777,
            },
          ],
        },
        {
          id: 8,
          name: 'hello',
          price: 777,
        },
        {
          id: 9,
          name: 'wat',
          price: 777,
        },
        {
          id: 10,
          name: 'child folder',
          price: 777,
          children: [
            {
              id: 11,
              name: 'hello',
              price: 777,
            },
            {
              id: 12,
              name: 'wat',
              price: 777,
            },
          ],
        },
      ],
    },
  ],
};

// define the tree-item component
Vue.component('tree-item', {
  template: '#item-template',
  props: {
    item: Object,
    names: Array,
  },
  data: function () {
    return {
      isOpen: false,
      result: [],
    };
  },
  computed: {
    isFolder: function () {
      return this.item.children && this.item.children.length;
    },
  },
  methods: {
    toggle: function () {
      if (this.isFolder) {
        this.isOpen = !this.isOpen;
      }
    },
    makeFolder: function () {
      if (!this.isFolder) {
        this.$emit('make-folder', this.item);
        this.isOpen = true;
      }
    },
  },
});

// boot up the demo
var demo = new Vue({
  el: '#demo',
  data: {
    treeData: treeData,
    names: [],
  },
  computed: {
    ids: function () {
      return this.names;
    },
  },
  methods: {
    makeFolder: function (item) {
      Vue.set(item, 'children', []);
      this.addItem(item);
    },
    addItem: function (item) {
      item.children.push({
        name: 'new stuff',
      });
    },
  },
});
