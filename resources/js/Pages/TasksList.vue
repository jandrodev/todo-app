<template>
    <NoTaskBanner :task-list="taskList"/>

    <q-item v-for="task in taskList" :key="task.id">
        <q-item-section avatar>
            <q-checkbox v-model="task.completed"
                        @click="markTaskAsCompleted(task.id, task.completed)"/>
        </q-item-section>
        <q-item-section class="text-body1 text-wrap"
                        :style="task.completed ? {'textDecoration':'line-through'} : {}">

            <q-item-label>{{ task.content }}</q-item-label>
            <q-item-label caption class="text-grey-8">
                            <span v-for="category in task.categories">
                                    {{ category.name }} /
                                </span>
            </q-item-label>
        </q-item-section>
        <q-item-section side>
            <q-btn
                @click="emitOpenDeleteTaskConfirmationDialog(task.id, task.completed)"
                icon="delete"
                round
                flat
            ></q-btn>
        </q-item-section>
    </q-item>
</template>
<script>
import postRequest from '../Api/serverRequest.js';
import NoTaskBanner from '../Components/NoTaskBanner.vue';

export default {
    name: 'TasksList',
    components: {NoTaskBanner},

    emits: ['updateTaskList', 'openDeleteTaskConfirmationDialog'],

    props: {
        taskList: {
            type: Array,
            required: true,
            default: [],
        },
    },

    methods: {
        markTaskAsCompleted(taskId, taskCompleted) {
            postRequest('complete-task', {id: taskId, completed: taskCompleted})
                .then(({data}) => {
                    this.$emit('updateTaskList', data)
                })
                .catch((error) => {
                    console.error(error)
                });
        },
        emitOpenDeleteTaskConfirmationDialog(taskId, taskCompleted) {
            this.$emit('openDeleteTaskConfirmationDialog', taskId, taskCompleted)
        },
    },
}
</script>
