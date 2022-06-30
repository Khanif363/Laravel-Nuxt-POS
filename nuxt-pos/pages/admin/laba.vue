<template>
  <v-card
    class="mx-auto ma-5"
    max-width="344"
    outlined
  >
    <v-list-item three-line>
      <v-list-item-content>
        <div class="mb-4 text-capitalize">
          Total Laba:
        </div>
        <v-list-item-title class="text-h5 mb-1">
          Rp{{ untung }}
        </v-list-item-title>
      </v-list-item-content>

      <v-img
        :aspect-ratio="16/9"
        :width="40"
        rounded
        floating
        src="https://img.freepik.com/free-vector/gold-coin-sticker-money-vector-finance-clipart-flat-design_53876-136823.jpg?t=st=1656339801~exp=1656340401~hmac=e9fa805a714a90651d33f22680f3a549debf6873e5108e4c2d1c9979ffa06f2a&w=740"
      ></v-img>
    </v-list-item>
  </v-card>
</template>
<script>
  export default {
    data () {
      return {
        untung: ''
      }
    },
    created() {
      this.laba()
    },
    methods: {
      laba() {
        this.$axios.get('laba')
        .then(response => {
          this.untung = response.data.data
        })
        .catch(error => {
          console.log(error.response.data)
        })
      },
    },
  }
</script>

