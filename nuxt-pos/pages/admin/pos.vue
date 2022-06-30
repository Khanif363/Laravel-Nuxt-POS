<template>
<div class="ma-5">
  <v-container>
    <v-row>
      <v-col
        cols="12"
        sm="12"
        md="6"
      >
        <v-card
          class="pa-2 "
        >
        <v-text-field
          append-icon="mdi-magnify"
          label="Cari Produk"
          v-model="keyword"
        ></v-text-field>
        <v-row>
          <v-col v-for="item in filterProduk? filterProduk : produk">
            <v-card
              class="mx-auto"
              max-width="180"
              @click="tambahPOS(item)"
            >
              <v-img
                src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
                height="120px"
              ></v-img>

              <v-card-title>
                {{ item.nama }}
              </v-card-title>
              <v-card-subtitle>
                {{ item.harga }}
              </v-card-subtitle>
            </v-card>
            </v-col>
        </v-row>

        </v-card>
      </v-col>
      <v-col
        cols="12"
        md="6"
        sm="12"
      >
        <v-card
          class="pa-2"
        >
          <v-card-title>
            Chart
          </v-card-title>

          <v-data-table
            :headers="headers"
            :items="pos"
            class="elevation-1"
          >
    <template v-slot:item.actions="{ item }">

      <!-- <v-chip-group> -->
    <v-btn
      color="secondary"
      fab
      x-small
      dark
      class="ma-1"
      @click="kurangKuatitas(item)">
      <v-icon
        small
      >
        mdi-minus-thick
      </v-icon>
      </v-btn>

      <v-btn
      color="primary"
      fab
      x-small
      dark
      class="ma-1"
      @click="tambahKuatitas(item)">
      <v-icon
        small
      >
        mdi-plus-thick
      </v-icon>
      </v-btn>

      <v-btn
      color="red"
      fab
      x-small
      dark
      class="ma-1"
      @click="hapusPOS(item)">
      <v-icon
        small
      >
        mdi-close-thick
      </v-icon>
      </v-btn>
      <!-- </v-chip-group> -->
    </template>
  </v-data-table>
  <v-btn
  color="success"
  @click="bayar()"
  class="mt-2 text-capitalize">Bayar</v-btn>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
  </div>
</template>


<script>
  export default {
    data: () => ({
      produk: [],
      keyword: '',
      pos: [],
      headers: [
        {
          text: 'Nama',
          align: 'start',
          sortable: false,
          value: 'nama',
        },
        { text: 'Kuantitas', value: 'kuantitas' },
        { text: 'Harga', value: 'harga' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
    }),

    created () {
      this.getProduk()
    },

    computed: {
      filterProduk() {
      return this.produk.filter(
        item => item.nama.toLowerCase().includes(this.keyword.toLowerCase())
      )},
    },

    methods: {
      getProduk() {
        this.$axios.get('produk')
        .then(response => {
          this.produk = response.data.filter
          // console.log(this.produk)
        })
        .catch(error => {
          console.log(error.response.data)
        })
      },

      tambahPOS(item) {
        const daftarPOs = this.pos.find(produk => produk.nama === item.nama)
        if (daftarPOs) {
        daftarPOs.kuantitas++
        daftarPOs.harga = daftarPOs.harga * daftarPOs.kuantitas
        } else {
          this.pos.push({ ...item, kuantitas: 1 })
        }
      },
      tambahKuatitas(item) {
        const daftarPOs = this.pos.find(produk => produk.id === item.id)
        daftarPOs.kuantitas++
      },
      kurangKuatitas(item) {
        const daftarPOs = this.pos.find(produk => produk.id === item.id)
        if (daftarPOs.kuantitas > 1) {
          daftarPOs.kuantitas--
        } else {
          this.pos = this.pos.filter(produk => produk.id !== item.id)
        }
      },
      hapusPOS(item) {
        this.pos = this.pos.filter(produk => produk.id !== item.id)
      },
      bayar() {
        this.$axios.post('pos', this.pos)
        .then(response => {
          this.produk = response.data.data
          this.getProduk()
          this.$swal(
            'Yes..',
            'Berhasil melakukan transaksi produk!',
            'success'
          )
        })
        .catch(error => {
          this.$swal(
            'Oooh...',
            'Gagal melakukan transaksi produk!',
            'error'
          )
        })
      }
    },
  }
</script>
