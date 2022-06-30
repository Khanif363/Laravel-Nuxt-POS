<template>
  <v-data-table
    :headers="headers"
    :items="kategori"
    class="elevation-1 ma-5"
    >

    <template v-slot:item.no="{ index }">
        {{ index + 1 }}
    </template>

    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-card-title>
            Kategori
        </v-card-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="primary"
              dark
              class="mb-2 text-capitalize"
              v-bind="attrs"
              v-on="on"
            >
              Tambah Kategori
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="12"
                    md="12"
                  >
                    <v-text-field
                      v-model="editedItem.nama"
                      label="Nama"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5 align-center justify-center">Hapus kategori ini?</v-card-title>
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
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item.id)"
      >
        mdi-delete
      </v-icon>
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
          text: 'No.',
          align: 'start',
          sortable: false,
          value: 'no',
        },
        { text: 'Nama', value: 'nama' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      kategori: [],
      editedIndex: -1,
      editedItem: {
        nama: '',
      },
      defaultItem: {
        nama: '',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Tambah Kategori' : 'Edit Kategori'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    created () {
      this.getKategori()
    },

    methods: {

      getKategori() {
        this.$axios.get('kategori')
        .then(response => {
          this.kategori = response.data.data
        })
        .catch(error => {
          this.$swal(
            'Oooh...',
            'Gagal mendapatkan kategori!',
            'error'
          )
        })
      },

      editItem (item) {
        this.editedIndex = item.id
        this.editedItem = Object.assign({}, item)
        console.log(this.editedItem)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = item
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.$axios.delete(`kategori/${this.editedIndex}`)
        .then(() => {
          this.getKategori()
          this.$swal(
            'Yes..',
            'Berhasil menghapus kategori!',
            'success'
          )
        })
        .catch(error => {
          this.$swal(
            'Oooh...',
            'Gagal menghapus kategori!',
            'error'
          )
        })
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          console.log(this.editedItem)
          console.log(this.editedIndex)
          this.$axios.put(`kategori/${this.editedIndex}`, this.editedItem)
          .then(() => {
          this.getKategori()
          this.$swal(
            'Yes..',
            'Berhasil mengedit kategori!',
            'success'
          )
          })
          .catch(error => {
            this.$swal(
            'Oooh...',
            'Gagal mengedit kategori!',
            'error'
          )
          })
        } else {
          this.$axios.post(`kategori`, this.editedItem)
          .then(() => {
          this.getKategori()
          this.$swal(
            'Yes..',
            'Berhasil manambahkan kategori!',
            'success'
          )
          })
          .catch(error => {
            this.$swal(
            'Oooh...',
            'Gagal manambahkan kategori!',
            'error'
          )
          })
        }
        this.close()
      },
    },
  }
</script>
