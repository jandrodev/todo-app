<template>
    <q-dialog :modelValue="openDeleteTaskDialog" @update:modelValue="openDeleteTaskDialog = $event">
        <q-card>
            <q-card-section class="row items-center q-pb-none">
                <div class="text-h6">Eliminar tarea</div>
                <q-space/>
                <q-btn icon="close" flat round dense v-close-popup/>
            </q-card-section>

            <q-card-section>
                ¿Está seguro de eliminar esta tarea?
            </q-card-section>

            <q-card-actions align="right" class="text-primary">
                <q-btn label="Eliminar" @click="deleteTask"/>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>
<script>
import postRequest from '../Api/serverRequest.js';

export default {
    name: 'DeleteTaskDialog',

    emits: ['emitEpdateTaskDeletedList', 'closeDeleteTaskDialog'],

    props: {
        openDeleteTaskDialog: {
            type: Boolean,
            required: true,
            default: false,
        },
        taskForDelete: {
            type: Object,
            required: true,
            default: {
                id: null,
                completed: null,
            },
        },
    },

    methods: {
        deleteTask() {
            postRequest('delete-task', {id: this.taskForDelete.id})
                .then(({data}) => {
                    this.$emit('emitEpdateTaskDeletedList', data)
                    this.$emit('closeDeleteTaskDialog')
                })
                .catch((error) => {
                    console.error(error)
                });
        },
    },
}
</script>
