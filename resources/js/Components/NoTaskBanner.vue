<template>
    <q-banner v-if="taskList.length < 1" rounded :class="$q.dark.isActive ? 'bg-grey-9' : 'bg-grey-2'">
        No hay tareas para mostrar
        <template v-slot:action>
            <q-btn flat label="Retry"/>
        </template>
    </q-banner>
</template>
<script>
export default {
    name: 'NoTaskBanner',

    props: {
        taskList: {
            type: Array,
            required: true,
            default: [],
        }
    }
}
</script>
