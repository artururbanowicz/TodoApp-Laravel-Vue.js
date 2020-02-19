require('./bootstrap');

window.Vue = require('vue');
Vue.component('modal', {
    template: '#modal-template',
})
const app = new Vue({
    el: '#app',
    data: {
        newTask: {'name': ''},
        tasks: [],
        showModal: false
    },
    mounted: function mounted(){
        this.getTasks();
    },
    methods: {
        getTasks: function getTasks(){
            var _this = this;
            axios.get('/getTasks').then(function(response){
                _this.tasks = response.data;
            })
        },
        createTask: function createTask(){
            var input = this.newTask;
            var _this = this;
            axios.post('/storeTask', input).then(function(response){
                _this.newTask = {'name': ''};
                _this.getTasks();
            });
        },
        deleteTask: function deleteTask(task){
            var _this = this;
            axios.post('/deleteTask/' + task.id).then(function (response){
                _this.getTasks();
            })
        },
        setTask(task_id, task_name) {
            this.task_id = task_id;
            this.task_name = task_name;
        },
        editTask: function editTask(){
            var _this = this;
            var task_id = document.getElementById('task_id');
            var task_name = document.getElementById('task_name');

            axios.post('/editTask/' + task_id.value, {val1: task_name.value}).then(function (response){
                _this.getTasks();
                _this.showModal = false;
            })
        }
    }
});
