<template>
  <div class="mainApp">
    <AddTodo class="add" v-on:add-todo="addTodo"/>
    <Todos v-bind:todos="todos" v-on:del-todo="deleteTodo" v-on:done="done"/>
  </div>
</template>

<script>
import axios from 'axios';
import Todos from './Todos';
import AddTodo from './AddTodo';
import Header from "./Header";
export default {
    name: 'App',
    components: {
        Todos,
        AddTodo
    },
    data() {
        return {
            todos: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            userId: document.querySelector('meta[name="user"]').getAttribute('content'),
            serverAdress: 'http://192.168.8.161:8000'
        }
    },
    methods: {

        deleteTodo(id) {
            this.todos = this.todos.filter(todo => todo.id !== id);
            axios.post(this.serverAdress + '/karpapi/del', {
                    id,
                    csrf: this.csrf,
                    userId: this.userId
                })
                .then(this.todos = this.todos.filter(todo => todo.id !== id))
                .catch(err => console.log('Error', err.response));
        },
        addTodo(newTodo) {
            const {
                title,
                csrf,
                userId,
                completed
            } = newTodo;
            axios.post(this.serverAdress + '/karpapi/add', {
                    title,
                    completed,
                    csrf,
                    userId
                })
                .then(res => this.todos = [...this.todos, res.data])
                .catch(err => console.log('Error', err.response));
            axios.get(this.serverAdress + '/karpapi/show')
                .then(res => this.todos = res.data)
                .catch(err => alert(err));
        },
        done(id) {
            axios.post(this.serverAdress + '/karpapi/done', {
                    id,
                    csrf: this.csrf,
                    userId: this.userId
                })

                .catch(err => console.log(err.response));

        }
    },
    created() {
        axios.get(this.serverAdress + '/karpapi/show')
            .then(res => this.todos = res.data)
            .catch(err => alert(err));
    }
}
</script>

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }
  body {
    font-family: sans-serif;
    line-height: 1.4;
  }

.add {
    border-bottom: dashed 3px black ;
}

  .btn:hover{
    background: #666;
  }
  @media screen and (min-width: 720px){
      .mainApp {
          margin-left: 12.5vw;
          margin-right: 12.5vw;
      }
  }
</style>
