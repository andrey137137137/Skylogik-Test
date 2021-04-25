// demo data
var treeData = {
  name: 'My Tree',
  price: 777,
  children: [
    { name: 'hello', price: 777 },
    { name: 'wat', price: 777 },
    {
      name: 'child folder',
      price: 777,
      children: [
        {
          name: 'child folder',
          price: 777,
          children: [
            { name: 'hello', price: 777 },
            { name: 'wat', price: 777 },
          ],
        },
        { name: 'hello', price: 777 },
        { name: 'wat', price: 777 },
        {
          name: 'child folder',
          price: 777,
          children: [
            { name: 'hello', price: 777 },
            { name: 'wat', price: 777 },
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
  },
  data: function() {
    return {
      isOpen: false,
    };
  },
  computed: {
    isFolder: function() {
      return this.item.children && this.item.children.length;
    },
  },
  methods: {
    toggle: function() {
      if (this.isFolder) {
        this.isOpen = !this.isOpen;
      }
    },
    makeFolder: function() {
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
  },
  methods: {
    makeFolder: function(item) {
      Vue.set(item, 'children', []);
      this.addItem(item);
    },
    addItem: function(item) {
      item.children.push({
        name: 'new stuff',
      });
    },
  },
});
