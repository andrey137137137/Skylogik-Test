<template lang="pug">
li
  .form-check(:class='{ bold: isFolder }', @click='toggle')
    input.form-check-input(
      :id='item.id',
      type='checkbox',
      :value='item.isChecked',
      @change='$emit("check-item", item)'
    )
    //- @dblclick='makeFolder'
    //- v-model='item.isChecked'
    label.form-check-label(:for='item.id') {{ item.name }}: {{ item.price }}
    span(v-if='isFolder') [{{ isOpen ? "-" : "+" }}]

  ul(v-show='isOpen', v-if='isFolder')
    TreeItem.item(
      v-for='(child, index) in item.children',
      :key='index',
      :item='child',
      @check-item='$emit("check-item", $event)'
    )
    //- @make-folder='$emit("make-folder", $event)',
    //- li.add(@click='$emit("add-item", item)') +
</template>

<script>
export default {
  name: 'TreeItem',
  props: {
    item: Object,
  },
  data: function () {
    return {
      isOpen: false,
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
    // makeFolder: function () {
    //   if (!this.isFolder) {
    //     this.$emit('make-folder', this.item);
    //     this.isOpen = true;
    //   }
    // },
  },
};
</script>
