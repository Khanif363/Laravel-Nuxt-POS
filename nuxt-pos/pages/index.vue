<template>
  <v-row
  class="mx-auto ma-5 align-center justify-center">
    <v-col
    cols="4">
    <v-card
      class="mx-auto"
      max-width="240"
      outlined
      elevation="2"
    >
    <v-img
        max-height="130"
        src="/produk.jpg">
    </v-img>
      <v-list-item three-line>
        <v-list-item-content>
          <div class="text-capitalize mb-2">
            Total Produk
          </div>
          <v-list-item-title class="text-h5 mb-1">
            {{ produk }}
          </v-list-item-title>
          <v-list-item-subtitle>Produk</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-card-actions>
        <v-btn
          rounded
          color="blue lighten-3"
          to="/admin/produk"
          class="text-capitalize"
        >
          Lihat
        </v-btn>
      </v-card-actions>
    </v-card>
    </v-col>
    <v-col
    cols="4">
    <v-card
      class="mx-auto"
      max-width="240"
      outlined
      elevation="2"
    >
    <v-img
        max-height="130"
        src="/penjualan.jpg">
    </v-img>
      <v-list-item three-line>
        <v-list-item-content>
          <div class="text-capitalize mb-2">
            Total Penjualan
          </div>
          <v-list-item-title class="text-h5 mb-1">
            {{ pos }}
          </v-list-item-title>
          <v-list-item-subtitle>Penjualan</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-card-actions>
        <v-btn
          rounded
          color="blue lighten-3"
          to="/admin/penjualan"
          class="text-capitalize"
        >
          Lihat
        </v-btn>
      </v-card-actions>
    </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'IndexPage',
  data() {
    return {
      produk: 0,
      pos: 0
    }
  },
  created() {
    this.getProduk()
    this.getPos()
  },
  methods: {
    getProduk() {
        this.$axios.get('produk')
        .then(response => {
          this.produk = response.data.total_produk
        })
        .catch(error => {
          console.log(error.response.data)
        })
    },
    getPos() {
      this.$axios.get('pos')
        .then(response => {
          this.pos = response.data.total_pos
        })
        .catch(error => {
          console.log(error.response.data)
        })
    }
  }
}
</script>
