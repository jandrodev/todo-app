<template>
    <q-page-sticky position="bottom-right" :offset="[18, 18]">
        <q-btn @click="openAddTaskDialog = true" fab icon="add" color="accent"/>
    </q-page-sticky>

    <q-dialog v-model="openAddTaskDialog">
        <q-card style="width: 700px; max-width: 80vw;">
            <q-form
                ref="createTaskForm"
                @submit="createTask"
                class="q-gutter-md"
            >
                <q-card-section class="row items-center q-pb-none">
                    <div class="text-h6">Añadir tarea</div>
                    <q-space/>
                    <q-btn icon="close" flat round dense v-close-popup/>
                </q-card-section>

                <q-card-section>
                    <div class="q-pa-md">
                        <q-input
                            v-model="newTaskContent"
                            label="Contenido"
                            filled
                            type="textarea"
                            lazy-rules
                            :rules="[ val => val && val.length > 0 || 'El contenido es obligatorio']"
                        />
                    </div>

                    <div class="q-pa-md">
                        <q-select
                            filled
                            v-model="newTaskCategories"
                            multiple
                            clearable
                            :options="categories"
                            option-value="id"
                            option-label="name"
                            label="Categorías"
                            emit-value
                            map-options
                        />
                    </div>

                    <div class="q-pa-md">
                        <q-btn label="Crear" type="submit" color="primary"/>
                    </div>
                </q-card-section>
            </q-form>
        </q-card>
    </q-dialog>
</template>
<script>
import postRequest from '../Api/serverRequest.js';

export default {
    name: 'CreateTaskDialog',

    emits: ['addTaskToNonCompletedList'],

    props: {
        categories: {
            type: Array,
            required: true,
            default: [],
        },
    },

    data: () => ({
        newTaskContent: '',
        newTaskCategories: null,
        openAddTaskDialog: false,
    }),

    methods: {
        createTask() {
            this.$refs.createTaskForm.validate().then(success => {
                if (success) {
                    postRequest('create-task', {
                        content: this.newTaskContent,
                        categories: this.newTaskCategories,
                        completed: false
                    })
                        .then(({data}) => {
                            this.$emit('addTaskToNonCompletedList', data);
                            this.openAddTaskDialog = false
                            this.newTaskContent = ''
                            this.newTaskCategories = null
                        })
                        .catch((error) => {
                            console.error(error)
                        });
                }
            })
        },
    },
}
</script>
