<template lang="pug">
li
  .form-check(:class='{ bold: isFolder }', @click='toggle')
    input.form-check-input(
      :id='item.id',
      type='checkbox',
      :value='item.isChecked',
      @change='$emit("check-item", item)'
    )
    label.form-check-label(:for='item.id') {{ item.name }}: {{ item.price }}
    span(v-if='isFolder') [{{ isOpen ? "-" : "+" }}]

  ul(v-show='isOpen', v-if='isFolder')
    TreeItem.item(
      v-for='(child, index) in item.children',
      :key='index',
      :item='child',
      @check-item='$emit("check-item", $event)'
    )
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
  },
};
</script>
