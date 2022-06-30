<template>
  <div>
  <v-navigation-drawer
      v-model="drawer"
      :mini-variant="miniVariant"
      :clipped="clipped"
      fixed
      app
    >
      <v-list>
        <v-list-item
          v-for="(item, i) in items"
          :key="i"
          :to="item.to"
          router
          exact
          color="blue lighten-3"
        >
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="item.title" />
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar :clipped-left="clipped" fixed app>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-btn icon @click.stop="miniVariant = !miniVariant">
        <v-icon>mdi-{{ `chevron-${miniVariant ? 'right' : 'left'}` }}</v-icon>
      </v-btn>
      <v-btn icon @click.stop="clipped = !clipped">
        <v-icon>mdi-application</v-icon>
      </v-btn>
      <v-toolbar-title v-text="title" />
      <v-spacer />
      <v-btn icon @click.stop="rightDrawer = !rightDrawer">
        <v-icon>mdi-menu</v-icon>
      </v-btn>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  name: "SideBar",
  data() {
    return {
      clipped: false,
      drawer: false,
      fixed: false,
      items: [
        {
          icon: 'mdi-apps',
          title: 'Welcome',
          to: '/',
        },
        {
          icon: 'mdi-shopping',
          title: 'Produk',
          to: '/admin/produk',
        },
        {
          icon: 'mdi-archive',
          title: 'Kategori',
          to: '/admin/kategori',
        },
        {
          icon: 'mdi-database-plus-outline',
          title: 'POS',
          to: '/admin/pos',
        },
        {
          icon: 'mdi-brightness-percent',
          title: 'Penjualan',
          to: '/admin/penjualan',
        },
        {
          icon: 'mdi-alarm-panel',
          title: 'Jumlah Laba',
          to: '/admin/laba',
        },
      ],
      miniVariant: false,
      right: true,
      rightDrawer: false,
      title: 'Sistem POS sederhana',
    }
  },
}
</script>
