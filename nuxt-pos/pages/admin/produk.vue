<template>
  <v-data-table :headers="headers" :items="produk" class="elevation-1 ma-5">
    <template v-slot:item.no="{ index }">
      {{ index + 1 }}
    </template>

    <template v-slot:top>
      <v-toolbar flat>
        <v-card-title>
            Produk
        </v-card-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2 text-capitalize" v-bind="attrs" v-on="on">
              Tambah Produk
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.nama" label="Nama"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-autocomplete
                      v-model="editedItem.kategori_id"
                      :items="kategori"
                      label="Kategori"
                      item-text="nama"
                      item-value="id"
                    ></v-autocomplete>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.harga" label="Harga"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field
                      v-model="editedItem.kuantitas"
                      label="Kuantitas"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close"> Cancel </v-btn>
              <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5 align-center justify-center">Hapus produk ini?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Batal</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
      <v-icon small @click="deleteItem(item.id)"> mdi-delete </v-icon>
    </template>
  </v-data-table>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "No.",
        align: "start",
        sortable: false,
        value: "no",
      },
      { text: "Nama", value: "nama" },
      { text: "Kategori", value: "kategori.nama" },
      { text: "Harga", value: "harga" },
      { text: "Kuantitas", value: "kuantitas" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    produk: [],
    editedIndex: -1,
    kategori: [],
    editedItem: {
      nama: "",
      kategori_id: 0,
      harga: 0,
      kuatitas: 0,
    },
    defaultItem: {
      nama: "",
      kategori: 0,
      harga: 0,
      kuatitas: 0,
    },
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Tambah Produk" : "Edit Produk";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.getProduk();
    this.getKategori();
  },

  methods: {
    getProduk() {
      this.$axios
        .get("produk")
        .then((response) => {
          this.produk = response.data.data;
        })
        .catch((error) => {
          this.$swal(
            'Oooh...',
            'Gagal mendapatkan produk!',
            'error'
          )
        });
    },

    getKategori() {
      this.$axios
        .get("kategori")
        .then((response) => {
          this.kategori = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },

    editItem(item) {
      this.editedIndex = item.id;
      this.editedItem = Object.assign({}, item);
      console.log(this.editedItem);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = item;
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.$axios
        .delete(`produk/${this.editedIndex}`)
        .then(() => {
          this.getProduk();
          this.$swal(
            'Yes..',
            'Berhasil menghapus produk!',
            'success'
          )
        })
        .catch((error) => {
          this.$swal(
            'Oooh...',
            'Gagal menghapus produk!',
            'error'
          )
        });
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        console.log(this.editedItem);
        console.log(this.editedIndex);
        // Object.assign(this.produk[this.editedIndex], this.editedItem)
        this.$axios
          .put(`produk/${this.editedIndex}`, this.editedItem)
          .then(() => {
            this.getProduk();
            this.$swal(
            'Yes..',
            'Berhasil mengedit produk!',
            'success'
            )
          })
          .catch((error) => {
            this.$swal(
            'Oooh...',
            'Gagal mangedit produk!',
            'error'
            )
          });
      } else {
        this.$axios
          .post(`produk`, this.editedItem)
          .then(() => {
            this.getProduk();
            this.$swal(
            'Yes..',
            'Berhasil manambahkan produk!',
            'success'
            )
          })
          .catch((error) => {
            this.$swal(
            'Oooh...',
            'Gagal manambahkan produk!',
            'error'
            )
          });
      }
      this.close();
    },
  },
};
</script>
