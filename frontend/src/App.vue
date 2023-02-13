<template>
  <b-container style='width: 65%'>
    <Header />
    <CreateBookForm />
    <BooksTable />
    <Footer />
  </b-container>
</template>

<script>
  import BooksTable from './components/BooksTable.vue'
  import CreateBookForm from './components/CreateBookForm.vue'
  import Header from './components/Header.vue'
  import Footer from './components/Footer.vue'
    export default {
        components: { BooksTable, CreateBookForm, Header, Footer }
    }
</script>
