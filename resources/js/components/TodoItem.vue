<template>
    <div class="todo-item" v-bind:class="{'is-complete':todo.completed}">
        <p>
            <input type="checkbox" class="mycheck" v-bind="{'checked':todo.completed}" v-on:change="markComplete" @change="$emit('done', todo.id)">
            {{todo.title}}
            <button @click="$emit('del-todo', todo.id)" class=" del btn btn-danger">X</button>
        </p>
    </div>
</template>

<script>
export default {
    name:"Element",
    props: [
        "todo"
    ],
    methods: {
        markComplete() {
            this.todo.completed = !this.todo.completed;

        }
    },
}
</script>
<style scoped>
    .mycheck {
        width: 55px;
    }
    .todo-item {
        background: white;
        padding: 10px;
        border-bottom: 1px #ccc dotted;
    }
    .is-complete {
        text-decoration: line-through;
    }
    .del {
        border: none;
        padding: 5px 9px;
        border-radius: 50%;
        cursor: pointer;
        float: right;
    }

</style>
