<template>
  <v-card class="ma-5">
    <v-card-title>
      Penjualan
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="penjualan"
      :search="search"
    >
    <template v-slot:item.no="{ index }">
        {{ index + 1 }}
    </template>
    </v-data-table>
  </v-card>
</template>
<script>
  export default {
    data () {
      return {
        search: '',
        penjualan: [],
        headers: [
          {
            text: 'No.',
            align: 'start',
            sortable: false,
            value: 'no',
          },
          { text: 'Nama', value: 'produk.nama' },
          { text: 'Kuantitas', value: 'kuantitas' },
          { text: 'Harga', value: 'harga' },
          { text: 'Tanggal', value: 'created_at'}
        ],
      }
    },
    created() {
      this.getPenjualan()
    },
    methods: {
      getPenjualan() {
        this.$axios.get('pos')
        .then(response => {
          this.penjualan = response.data.data
        })
        .catch(error => {
          console.log(error.response.data)
        })
      },
    },
  }
</script>
