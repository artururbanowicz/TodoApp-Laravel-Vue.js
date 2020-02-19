@extends('layouts.app')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
@section('content')
<div class="container">
    <div id="app">
        <form>
            <div class="form-group">
                <label>Nazwa</label>
                <input type="text" class="form-control" id="name" name="name" required="required" v-model="newTask.name">
            </div>
            <button type="submit" class="btn btn-primary" @click.prevent="createTask()">Dodaj</button>
        </form>
        </br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nazwa</th>
                <th scope="col">Akcje</th>
            </tr>
            </thead>
            <tbody >
            <tr v-for="task in tasks">
                <td>@{{ task.name }}</td>
                <td>
                    <button type="button" id="show-modal" @click="showModal=true; setTask(task.id, task.name)" class="btn btn-primary" title="Edytuj"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-danger" @click.prevent="deleteTask(task)" title="Usuń"><i class="far fa-trash-alt"></i></button>
                </td>

            </tr>
            </tbody>
        </table>

        <modal v-if="showModal" @close="showModal=false">
            <h3 slot="header">Edit Item</h3>
            <div slot="body">
                <input type="hidden" disabled class="form-control" id="task_id" name="id"  required  :value="this.task_id">
                Name: <input type="text" class="form-control" id="task_name" name="name"  required  :value="this.task_name">
            </div>
            <div slot="footer">
                <button class="btn btn-default" @click="showModal = false">Cancel</button>
                <button class="btn btn-info" @click="editTask()">Update</button>
            </div>
        </modal>
    </div>
</div>

<script type="text/x-template" id="modal-template">
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-content">

                    <div class="modal-header">
                        <slot name="header">
                            default header
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">

                        </slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">


                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</script>


@endsection
