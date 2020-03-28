<template>
    <div>
        <form @submit="addTodo">
            <input type="text" class="form-control" name="title" v-model="title" placeholder="Dodaj zadanie...">
            <input type="hidden" name="_token" :value="csrf">
            <input type="submit" value="Dodaj" class="btn btn-dark">
        </form>
    </div>
</template>
<script>
export default {
    name: "AddTodo",
    data() {
        return {
            title: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            userId: document.querySelector('meta[name="user"]').getAttribute('content')
        }
    },
    methods: {
        addTodo(e){
            e.preventDefault();
            const newTodo = {
                title: this.title,
                completed: false,
                csrf: this.csrf,
                userId: this.userId
            }
            this.$emit('add-todo', newTodo);
            this.title = '';
        }
    }
}
</script>

<style scoped>
    * {
        margin: 10px;
    }
    form {
        display: flex;
    }
    input[type="text"] {
        flex: 10;
        padding: 5px;
    }
    input[type="submit"] {
        flex: 2;
    }
</style>
