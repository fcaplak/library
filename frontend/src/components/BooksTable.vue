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
    <b-skeleton-table v-show="tableSkeleton"
      :rows="10"
      :columns="5"
      :table-props="{ striped: true }"
      :hideHeader=true
    ></b-skeleton-table>
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
          { key: 'author', label: 'Autor' }
        ],
        items: [],
        tableSkeleton : true
      }
    },
  mounted() {
      this.$root.$on("books-table-update", () => { axios
        .get(import.meta.env.VITE_API_URL + "books")
        .then(response => this.items = response.data) })
      axios
        .get(import.meta.env.VITE_API_URL + "books")
        .then(response => this.items = response.data)
        .finally(() => {
          this.tableSkeleton = false
        })
    }
  }
</script>
