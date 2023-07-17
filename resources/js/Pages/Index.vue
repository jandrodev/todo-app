<template>
    <q-layout view="lHh Lpr lFf" class="bg-white">
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
                <q-item-label header>Essential Links</q-item-label>
                <q-item clickable target="_blank" rel="noopener" href="https://quasar.dev">
                    <q-item-section avatar>
                        <q-icon name="school"/>
                    </q-item-section>
                    <q-item-section>
                        <q-item-label>Docs</q-item-label>
                        <q-item-label caption>https://quasar.dev</q-item-label>
                    </q-item-section>
                </q-item>
                <q-item clickable target="_blank" rel="noopener" href="https://github.quasar.dev">
                    <q-item-section avatar>
                        <q-icon name="code"/>
                    </q-item-section>
                    <q-item-section>
                        <q-item-label>GitHub</q-item-label>
                        <q-item-label caption>github.com/quasarframework</q-item-label>
                    </q-item-section>
                </q-item>
                <q-item clickable target="_blank" rel="noopener" href="http://chat.quasar.dev">
                    <q-item-section avatar>
                        <q-icon name="chat"/>
                    </q-item-section>
                    <q-item-section>
                        <q-item-label>Discord Chat Channel</q-item-label>
                        <q-item-label caption>https://chat.quasar.dev</q-item-label>
                    </q-item-section>
                </q-item>
                <q-item clickable target="_blank" rel="noopener" href="https://forum.quasar.dev">
                    <q-item-section avatar>
                        <q-icon name="record_voice_over"/>
                    </q-item-section>
                    <q-item-section>
                        <q-item-label>Forum</q-item-label>
                        <q-item-label caption>https://forum.quasar.dev</q-item-label>
                    </q-item-section>
                </q-item>
                <q-item clickable target="_blank" rel="noopener" href="https://twitter.quasar.dev">
                    <q-item-section avatar>
                        <q-icon name="rss_feed"/>
                    </q-item-section>
                    <q-item-section>
                        <q-item-label>Twitter</q-item-label>
                        <q-item-label caption>@quasarframework</q-item-label>
                    </q-item-section>
                </q-item>
                <q-item clickable target="_blank" rel="noopener" href="https://facebook.quasar.dev">
                    <q-item-section avatar>
                        <q-icon name="public"/>
                    </q-item-section>
                    <q-item-section>
                        <q-item-label>Facebook</q-item-label>
                        <q-item-label caption>@QuasarFramework</q-item-label>
                    </q-item-section>
                </q-item>
            </q-list>
        </q-drawer>

        <q-page-container>
            <q-page class="q-pa-md">

                <p class="text-h6">Tareas por completar</p>

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


                <q-item v-for="taskNonCompleted in tasksNonCompletedList" :key="taskNonCompleted.id">
                    <q-item-section avatar>
                        <q-checkbox
                            :id="taskNonCompleted.id"
                            v-model="taskNonCompleted.completed"
                            color="primary"
                        />
                    </q-item-section>
                    <q-item-section class="text-body1 text-wrap"
                                    :style="taskNonCompleted.completed?{'textDecoration':'line-through'}:{}">

                        <q-item-label>{{ taskNonCompleted.content }}</q-item-label>
                        <q-item-label caption class="text-grey-8">
                            <span v-for="category in taskNonCompleted.categories">
                                    {{ category.name }} /
                                </span>
                        </q-item-label>
                    </q-item-section>
                    <q-item-section side>
                        <q-btn @click="openDeleteTaskConfirmationDialog(taskNonCompleted.id)" icon="delete" round
                               flat></q-btn>
                    </q-item-section>
                </q-item>

                <q-dialog v-model="openDeleteTaskDialog">
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
                            <q-btn label="Eliminar" @click="deleteTask(taskForDeleteId)"/>
                        </q-card-actions>
                    </q-card>
                </q-dialog>

                <q-separator vertical inset/>

            </q-page>
        </q-page-container>
    </q-layout>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        categories: {
            type: Array,
            required: true,
            default: [],
        },
        tasksNonCompleted: {
            type: Array,
            required: true,
            default: [],
        },
        tasksCompleted: {
            type: Object,
            required: true,
            default: {},
        }
    },

    data: () => ({
        leftDrawerOpen: false,
        createTaskForm: null,
        newTaskContent: '',
        newTaskCategories: null,
        openAddTaskDialog: false,
        tasksNonCompletedList: [],
        openDeleteTaskDialog: false,
        deleteTaskConfirmation: false,
        taskForDeleteId: null,
    }),

    mounted() {
        this.tasksNonCompletedList = this.tasksNonCompleted
    },

    methods: {
        toggleLeftDrawer() {
            this.leftDrawerOpen.value = !this.leftDrawerOpen.value
        },
        createTask() {
            this.$refs.createTaskForm.validate().then(success => {
                if (success) {
                    const headers = {
                        'Accept': 'application/json'
                    }

                    const data = {
                        content: this.newTaskContent,
                        categories: this.newTaskCategories,
                        completed: false
                    }

                    axios.post('/create-task', data, {headers: headers})
                        .then(({data}) => {
                            this.tasksNonCompletedList.push(data)
                            this.openAddTaskDialog = false
                            this.newTaskContent = ''
                            this.newTaskCategories = null
                        })
                        .catch((error) => {
                            console.log(error)
                        });
                }
            })
        },
        openDeleteTaskConfirmationDialog(taskId) {
            this.openDeleteTaskDialog = true
            this.taskForDeleteId = taskId
        },
        deleteTask(taskId) {
            const headers = {
                'Accept': 'application/json'
            }

            axios.post('/delete-task', {id: taskId}, {headers: headers})
                .then(({data}) => {
                    this.tasksNonCompletedList = this.tasksNonCompletedList.filter(object => {
                        return object.id !== taskId
                    })

                    this.deleteTaskConfirmation = false
                    this.openDeleteTaskDialog = false
                })
                .catch((error) => {
                    console.log(error)
                });
        }
    }
}
</script>
