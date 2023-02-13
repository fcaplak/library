<template>
    <b-row class="rounded shadow">
    <b-table
        class="rounded"
        striped hover
        head-variant="dark"
        :items="items"
        :fields="fields"
        sort-icon-left
        responsive
    >
        <template #cell(price)="data">
            {{ data.value }} €
        </template>
    </b-table>
    </b-row>
</template>

<script>
  import axios from 'axios'
  export default {
    data() {
      return {
        fields: [
          { key: 'name', label: 'Názov knihy'},
          { key: 'isbn', label: 'ISBN'},
          { key: 'price', label: 'Cena', sortable: true },
          { key: 'category', label: 'Kategória' },
          { key: 'author', label: 'Autor'}
        ],
        items: []
      }
    },
    mounted() {
      this.$root.$on("books-table-update", () => { axios
        .get('http://localhost:8000/api/v1/books')
        .then(response => this.items = response.data) })
      axios
        .get('http://localhost:8000/api/v1/books')
        .then(response => this.items = response.data)
    }
  }
</script>
