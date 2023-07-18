<template>
    <q-header elevated>
        <q-toolbar>
            <q-btn
                flat
                dense
                round
                @click="toggleLeftDrawer"
                aria-label="Menu"
                icon="menu"
            />

            <q-toolbar-title>
                Todo App
            </q-toolbar-title>
        </q-toolbar>
    </q-header>

    <q-drawer
        v-model="leftDrawerOpen"
        show-if-above
        bordered
        class="bg-grey-2"
    >
        <q-list>
            <q-item-label header>Enlaces de interés</q-item-label>
            <q-item clickable target="_blank" rel="noopener" href="https://www.netberry.es">
                <q-item-section avatar>
                    <q-icon name="code"/>
                </q-item-section>
                <q-item-section>
                    <q-item-label>Netberry Solutions</q-item-label>
                    <q-item-label caption>https://www.netberry.es</q-item-label>
                </q-item-section>
            </q-item>
            <q-item clickable target="_blank" rel="noopener"
                    href="https://www.netberry.es/entradaticket-software-ticketing">
                <q-item-section avatar>
                    <q-icon name="theaters"/>
                </q-item-section>
                <q-item-section>
                    <q-item-label>Software ticketing</q-item-label>
                    <q-item-label caption>/entradaticket-software-ticketing/</q-item-label>
                </q-item-section>
            </q-item>
            <q-item clickable target="_blank" rel="noopener" href="https://www.netberry.es/blog">
                <q-item-section avatar>
                    <q-icon name="menu_book"/>
                </q-item-section>
                <q-item-section>
                    <q-item-label>Blog</q-item-label>
                    <q-item-label caption>/blog/</q-item-label>
                </q-item-section>
            </q-item>
        </q-list>
    </q-drawer>
</template>
<script>
export default {
    name: 'MainMenu',

    data: () => ({
        leftDrawerOpen: false,
    }),

    methods: {
        toggleLeftDrawer() {
            this.leftDrawerOpen = !this.leftDrawerOpen
        },
    },
}
</script>
