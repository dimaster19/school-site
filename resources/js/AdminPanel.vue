
<template>
    <div class="row">
        <div v-for="table in this.tables" class="col-lg-4 col-md-6 col-sm-12 mt-3">
            <div style="height: 250px;">
                <button class="fs-3 btn btn-warning" v-on:click="modalClick($event.target)" :id="table" data-bs-toggle="modal"
                    data-bs-target="#dbModal" style="width:100%; height: 100%;">{{
                        table }}</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
            <div style="height: 150px; ">
                <button class="fs-3 btn btn-warning"  id="files" data-bs-toggle="modal" data-bs-target="#filesModal"
                    style="width:100%; height: 100%;">Загрузить файл</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dbModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="dbModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dbModalLabel">{{ this.table_name }}</h5>
                    <button type="button" class="btn-close" v-on:click="closeModal()" data-bs-dismiss="modal"
                        aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">

                    <div v-if="this.table_name != 'slider'" class="item-bottom mt-3">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-add-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-add" type="button" role="tab" aria-controls="pills-add"
                                    aria-selected="true">Добавить</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-update-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-update" type="button" role="tab" aria-controls="pills-update"
                                    aria-selected="false">Изменить</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-remove-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-remove" type="button" role="tab" aria-controls="pills-remove"
                                    aria-selected="false">Удалить</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-add" role="tabpanel"
                                aria-labelledby="pills-add-tab">
                                <form class="needs-validation" validate>

                                    <div v-for="data in this.modal_data" class="mb-3">
                                        <div v-if="data !== 'id' && data !== 'created_at' && data !== 'updated_at' && data !== 'remember_token'  && data !== 'text'">
                                            <label class="form-label">{{ data }}</label>
                                            <input type="text" class="form-control db-create" value="" :id="data" required>
                                        </div>
                                        <div v-if ="data == 'text'">
                                            <label class="form-label">{{ data }}</label>
                                            <textarea class="form-control db-create" value="" :id="data" />
                                        </div>
                                    </div>
                                    <button type="button" v-on:click="createClick()" id="create"
                                        class="btn btn-primary mt-3">Отправить</button>

                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-update" role="tabpanel" aria-labelledby="pills-update-tab">
                                <form class="needs-validation" validate>
                                    <div class="mb-3">
                                        <label class="form-label">Введите ID</label>
                                        <input type="text" class="form-control" v-model="update_id" required>
                                        <button type="button" v-on:click="updateIdClick"
                                            class="btn btn-primary mt-3">Получить</button>
                                    </div>
                                </form>
                                <form class="needs-validation" validate>
                                    <fieldset id="update_fieldset" disabled>
                                        <div v-for="data in this.modal_data" class="mb-3">
                                            <div v-if="data !== 'id' && data !== 'created_at' && data !== 'updated_at' && data !== 'remember_token' && data !== 'text'">
                                                <label class="form-label">{{ data }}</label>
                                                <input type="text" class="form-control db-update" value="" :id="data" required>
                                            </div>
                                            <div v-if ="data == 'text'">
                                            <label class="form-label">{{ data }}</label>
                                            <textarea class="form-control db-update" value="" :id="data" />
                                        </div>
                                        </div>
                                        <button type="button" v-on:click="updateClick()" id="update"
                                            class="btn btn-primary mt-3">Отправить</button>
                                    </fieldset>
                                </form>

                            </div>
                            <div class="tab-pane fade" id="pills-remove" role="tabpanel" aria-labelledby="pills-remove-tab">
                                <label class="form-label">Удаляемый ID</label>
                                <input type="text" class="form-control db-remove" value="" required>
                                <button type="button" v-on:click="removeClick()" id="remove"
                                    class="btn btn-primary mt-3">Отправить</button>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="filesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="filesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filesModalLabel">Загрузка файлов</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body p-5" style="min-height: 200px;">

                    <label class="form-label">Файл</label>
                    <input type="file" class="form-control" id="file" ref="file"
                        v-on:change="handleFileUpload($event.target)" multiple />
                    <div class="my-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="news_img"
                                value="/imgs/news" checked>
                            <label class="form-check-label" for="inlineRadio1">Картинка для новостей</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="carousel_img"
                                value="/imgs/carousel">
                            <label class="form-check-label" for="inlineRadio2">Картинка для карусели</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="worker_img"
                                value="/imgs/workers">
                            <label class="form-check-label" for="inlineRadio3">Фото сотрудника</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="worker_img"
                                value="/files">
                            <label class="form-check-label" for="inlineRadio3">Файл</label>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3" type="button" v-on:click="submitFile()">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="js">
import axios from 'axios';

export default {
    props: ['tables'],
    components: {
    },
    data() {
        return {
            table_name: null,
            modal_data: null,
            update_id: null,
            update_data: null,
            files: null

        };
    },

    methods: {
        modalClick: function (e) {
            this.table_name = e.id;
            if (this.table_name != 'slider') {
                axios
                    .get(import.meta.env.VITE_BASE_URL + '/get-db-columns', {
                        params: {
                            table_name: this.table_name
                        }
                    })
                    .then(response => {
                        this.modal_data = response.data
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }

        },
        updateIdClick: function () {
            if (this.update_id !== null && this.update_id !== "" ) {
                axios
                .get(import.meta.env.VITE_BASE_URL + '/row', {
                    params: {
                        id: this.update_id,
                        db: this.table_name
                    }
                })
                .then(response => {
                    document.getElementById('update_fieldset').disabled = false
                    this.update_data = response.data
                    let temp = this.update_data
                    let list = document.getElementsByClassName('db-update')
                    Array.from(list).forEach(function (el) {
                        el.value = temp[el.id] // в el.id содержится название атрибута
                    });
                })
                .catch(error => {
                    console.log(error);
                })
            }
            else {
                alert('Заполните все поля')
            }
           
        },

        createClick: function () {
            if (this.checkInputValue('db-create') === true) {
                let list = document.getElementsByClassName('db-create')
                let row_data = new Object()
                Array.from(list).forEach(function (el) {
                    row_data[el.id] = el.value
                });

                axios.post(import.meta.env.VITE_BASE_URL + '/row', {


                    data: row_data,
                    db: this.table_name


                })
                    .then(response => {
                        alert('Запись успешно создана')

                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
            else {
                alert('Заполните все поля')
            }


        },

        updateClick: function () {
            if (this.checkInputValue('db-update') === true) {
            let list = document.getElementsByClassName('db-update')
            let row_data = new Object()
            console.log(list.length);
            Array.from(list).forEach(function (el) {
                row_data[el.id] = el.value
            });


            axios.put(import.meta.env.VITE_BASE_URL + '/row', {

                id: this.update_id,
                data: row_data,
                db: this.table_name


            })
                .then(response => {
                    alert('Запись успешно обновлена')

                })
                .catch(error => {
                    console.log(error);
                });
            }
            else {
                alert('Заполните все поля')
            }
        },

        removeClick: function (e) {
            if (this.checkInputValue('db-remove') === true) {

            let id = document.getElementsByClassName('db-remove')[0].value
            axios.delete(import.meta.env.VITE_BASE_URL + '/row', {

                db: this.table_name,
                id: id

            })
                .then(response => {
                    alert('Успешно')

                })
                .catch(error => {
                    console.log(error);
                });
            }
            else {
                alert('Заполните все поля')
            }
        },

        closeModal: function () {

            document.getElementById('update_fieldset').disabled = true
        },

        handleFileUpload: function (e) {
            this.files = e.files
        },

        submitFile: function () {

            let checked = document.querySelector('input[name="inlineRadioOptions"]:checked').value;

            let formData = new FormData();
            for (var i = 0; i < this.files.length; i++) {
                let file = this.files[i];
                formData.append('files[' + i + ']', file);
            }
            formData.append('path', checked)
            axios.post(import.meta.env.VITE_BASE_URL + '/upload-files',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },

                },

            ).then(function () {
                alert('Файлы загружены');
            })
                .catch(error => {
                    console.log(error);
                });
        },

        checkInputValue: function (class_name) {
            let inputs = document.getElementsByClassName(class_name)
            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].value === "") {
                    return false
                }
            }
            return true
        }
    }
}
</script>