<template>
  <b-row class="rounded shadow p-3 pt-3 mb-5">
    <b-container>
      <b-form ref="bookForm" @submit="onSubmit">
        <b-row class="p-1 mt-2">
          <b-col>
            <b-form-group label="Názov knihy">
              <b-form-input
                v-model="form.name"
                type="text"
                placeholder="Kniha"
                required
                ></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row class="p-1">
          <b-col>
            <b-form-group label="ISBN">
              <b-form-input
                v-model="form.isbn"
                type="text"
                placeholder="ISBN"
                required
                ></b-form-input>
            </b-form-group>
          </b-col>
          <b-col cols="1">
          </b-col>
          <b-col>
            <b-form-group label="Cena (€)">
              <b-form-input
                v-model="form.price"
                type="number"
                placeholder="Cena"
                step="0.01"
                required
                ></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row class="p-1">
          <b-col>
            <b-form-group label="Kategória">
              <b-form-select v-model="form.category_id" :options="options" required>
                <template #first>
                  <b-form-select-option :value="null" disabled>-- vybrať kategóriu --</b-form-select-option>
                </template>
              </b-form-select>
            </b-form-group>
          </b-col>
          <b-col cols="1">
          </b-col>
          <b-col>
            <b-form-group label="Autor">
              <vue3-simple-typeahead
                id="typeahead"
                placeholder="Autor"
                :items="authors"
                :minInputLength="2"
                @onInput="onInput"
                @onBlur="onBlur"
                required
                ></vue3-simple-typeahead>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row class="pt-3 pb-3 text-right">
          <b-col></b-col>
          <b-col cols="1"></b-col>
          <b-col>
            <b-button block type="submit" variant="success">Pridať knihu do knižnice</b-button>
          </b-col>
        </b-row>
      </b-form>
      <!--      <b-card class="mt-3" header="Form Data Result">
        <pre class="m-0">{{ form }}</pre>
        </b-card>--->
    </b-container>
  </b-row>
</template>
<script>
import axios from "axios"
export default {
  data() {
    return {
      form: {
        name: "",
        isbn: "",
        price: null,
        category_id: null,
        author: "",
      },
      options: [],
      authors: [],
    }
  },
  mounted() {
    document.getElementById("typeahead").className = "form-control"
    axios
      .get("http://localhost:8000/api/v1/categories", {
        headers: { "Content-Type": "application/json" },
      })
      .then(
        (response) =>
          (this.options = response.data.map(({ id: value, name: text }) => ({
            text,
            value,
          })))
      )
      .catch((error) => {
        this.$bvToast.toast("Nepodarilo sa načítať údaje z API: " + error, {
          title: "Chyba!",
          solid: true,
          variant: "danger",
          autoHideDelay: 5000,
        })
      })
  },
  methods: {
    onSubmit(e) {
      e.preventDefault()
      axios
        .post("http://localhost:8000/api/v1/books", this.form, {
          headers: { "Content-Type": "application/json" },
        })
        .then(() => {
          this.$root.$emit("books-table-update")
          this.$bvToast.toast("Kniha bola pridaná do knižnice.", {
            toaster: "b-toaster-top-center",
            title: "Úspech!",
            solid: true,
            variant: "success",
            autoHideDelay: 5000,
          })
          this.$refs.bookForm.reset()
        })
        .catch((error) => {
          this.$bvToast.toast(error.response.data.message, {
            toaster: "b-toaster-top-center",
            title: "Chyba!",
            solid: true,
            variant: "danger",
            autoHideDelay: 7000
          })
        })
    },
    onInput(event) {
      this.form.author = event.input
      axios
        .get("http://localhost:8000/api/v1/authors/?name=" + event.input, {
          headers: { "Content-Type": "application/json" },
        })
        .then(
          (response) =>
            (this.authors = response.data.map((value) => value.name))
        )
    },
    onBlur(event) {
      this.form.author = event.input
    },
  },
}
</script>
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
}
</style>
