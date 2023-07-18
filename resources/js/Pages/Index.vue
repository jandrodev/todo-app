<template>
    <q-layout view="lHh Lpr lFf" class="bg-white">
        <MainMenu/>

        <q-page-container>
            <q-page class="q-pa-md">
                <div class="q-pt-xs">
                    <p class="text-h6">Tareas por completar</p>
                    <TasksList
                        :task-list="tasksNonCompletedList"
                        @updateTaskList="updateTaskList"
                        @openDeleteTaskConfirmationDialog="openDeleteTaskConfirmationDialog"
                    />
                </div>

                <div class="q-pt-xl">
                    <p class="text-h6">Tareas completadas</p>
                    <TasksList
                        :task-list="tasksCompletedList"
                        @updateTaskList="updateTaskList"
                        @openDeleteTaskConfirmationDialog="openDeleteTaskConfirmationDialog"
                    />
                </div>

                <CreateTaskDialog :categories="categories" @addTaskToNonCompletedList="addTaskToNonCompletedList"/>

                <DeleteTaskDialog
                    :open-delete-task-dialog="openDeleteTaskDialog"
                    :task-for-delete="taskForDelete"
                    @emitEpdateTaskDeletedList="updateTaskDeletedList"
                    @closeDeleteTaskDialog="closeDeleteTaskDialog"
                />
            </q-page>
        </q-page-container>
    </q-layout>
</template>

<script>
import MainMenu from '../Partials/MainMenu.vue';
import CreateTaskDialog from '../Dialogs/CreateTaskDialog.vue';
import TasksList from './TasksList.vue';
import DeleteTaskDialog from '../Dialogs/DeleteTaskDialog.vue';

export default {
    components: {DeleteTaskDialog, TasksList, CreateTaskDialog, MainMenu},

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
            type: Array,
            required: true,
            default: [],
        }
    },

    data: () => ({
        tasksNonCompletedList: [],
        tasksCompletedList: [],
        openDeleteTaskDialog: false,
        deleteTaskConfirmation: false,
        taskForDelete: {},
    }),

    mounted() {
        this.tasksNonCompletedList = this.tasksNonCompleted
        this.tasksCompletedList = this.tasksCompleted
    },

    methods: {
        addTaskToNonCompletedList(taskData) {
            this.tasksNonCompletedList.push(taskData)
        },
        updateTaskList(taskData) {
            if (taskData.completed) {
                this.tasksNonCompletedList = this.tasksNonCompletedList.filter(object => {
                    return object.id !== taskData.id
                })
                this.tasksCompletedList.push(taskData)
            } else {
                this.tasksCompletedList = this.tasksCompletedList.filter(object => {
                    return object.id !== taskData.id
                })
                this.tasksNonCompletedList.push(taskData)
            }
        },
        updateTaskDeletedList(taskData) {
            if (taskData.completed) {
                this.tasksCompletedList = this.tasksCompletedList.filter(object => {
                    return object.id !== taskData.id
                })
            } else {
                this.tasksNonCompletedList = this.tasksNonCompletedList.filter(object => {
                    return object.id !== taskData.id
                })
            }
        },
        openDeleteTaskConfirmationDialog(taskId, taskCompleted) {
            this.openDeleteTaskDialog = true
            this.taskForDelete = {id: taskId, completed: taskCompleted}
        },
        closeDeleteTaskDialog() {
            this.deleteTaskConfirmation = false
            this.openDeleteTaskDialog = false
        },
    },
}
</script>
