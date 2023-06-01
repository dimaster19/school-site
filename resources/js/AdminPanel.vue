
<template>
    <!--  делаем стандартную сетку бутстрап, получаем список сущностей и через форыч создаем кнопки модалки -->
    <div class="row">
        <div  v-for="table in this.tables" class="col-lg-6 col-md-12 mt-3">
            <div style="height: 250px;">
                <button v-on:click="modalClick($event.target)" :id="table" data-bs-toggle="modal" data-bs-target="#dbModal"
                style="width:100%; height: 100%; background-color: transparent;">{{ table }}</button>
            </div>
        </div>   
    </div>
    

    <div class="modal fade" id="dbModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="dbModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dbModalLabel">{{ this.data_id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">

                    <div v-if="this.data_id != 'slider'" class="item-bottom mt-3">
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
                                <form>

                                    <div v-for="data in this.modal_data" class="mb-3">
                                        <div
                                            v-if="data !== 'email_verified_at' && data !== 'id' && data !== 'created_at' && data !== 'updated_at' && data !== 'remember_token'">
                                            <label class="form-label">{{ data }}</label>
                                            <input type="text" class="form-control db-create" :id="data">
                                        </div>
                                    </div>
                                    <button type="button" v-on:click="actionClick($event.target)" id="create"
                                        class="btn btn-primary mt-3">Отправить</button>

                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-update" role="tabpanel" aria-labelledby="pills-update-tab">
                                <form action="">
                                    <div class="mb-3">
                                        <label class="form-label">Введите ID</label>
                                        <input type="text" class="form-control" v-model="update_id">
                                        <button type="button" v-on:click="updateIdClick"
                                            class="btn btn-primary mt-3">Получить</button>
                                    </div>
                                </form>
                                <form>

                                    <div v-for="data in this.modal_data" class="mb-3">
                                        <div
                                            v-if="data !== 'email_verified_at' && data !== 'id' && data !== 'created_at' && data !== 'updated_at' && data !== 'remember_token'">
                                            <label class="form-label">{{ data }}</label>
                                            <input type="text" class="form-control db-update" :id="data">
                                        </div>
                                    </div>
                                    <button type="button" v-on:click="actionClick($event.target)" id="update"
                                        class="btn btn-primary mt-3">Отправить</button>

                                </form>

                            </div>
                            <div class="tab-pane fade" id="pills-remove" role="tabpanel" aria-labelledby="pills-remove-tab">
                                <label class="form-label">Удаляемый ID</label>
                                <input type="text" class="form-control db-remove">
                                <button type="button" v-on:click="actionClick($event.target)" id="remove"
                                    class="btn btn-primary mt-3">Отправить</button>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>





    <div class="modal fade" id="sliderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="sliderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sliderModalLabel">Слайдер (Карусель)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body p-5" style="min-height: 200px;">

                    <!-- <input type="file" id="carouselimgs" multiple="multiple"><br><br>
                        <button type="button" v-on:click="carouselClick" class="btn btn-primary mt-3">Отправить</button> -->
                    <h3>Только файлы расширения:'jpeg', 'jpg', 'png', размер: 1920x550 </h3>
                    <DropZone url="http://127.0.0.1:8000/carousel" :uploadOnDrop="true" method="POST" :headers="csrfHeader"
                        :acceptedFiles="['jpeg', 'jpg', 'png']" />
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Загрузка картинок</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <DropZone url="http://127.0.0.1:8000/filesupload" :uploadOnDrop="true" method="POST"
                        :headers="csrfHeader" />
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
            data_id: null,
            modal_data: null,
            tab_data: null,
            tab_links: null,
            tab_name: null,
            tab_columns: null,
            update_id: null,
            update_data: null,
            input_data: null,
            input_header: null,
            files: null,
            csrfHeader: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
            }
        };
    },

    methods: {
        modalClick: function (e) {
            this.data_id = e.id;
            if (this.data_id != 'slider') {
                axios
                    .get('http://127.0.0.1:8000/getdbdata', {
                        params: {
                            id: this.data_id
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
            axios
                .get('http://127.0.0.1:8000/updatedata', {
                    params: {
                        id: this.update_id,
                        db: this.data_id
                    }
                })
                .then(response => {
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
        },
        actionClick: function (e) {



            if (e.id == 'create') {
                let temp = new Array
                let temp2 = new Array
                let list = document.getElementsByClassName('db-create')
                let i = 0;
                let flag = false; // true если есть пустые значения
                Array.from(list).forEach(function (el) {
                    if (el.value == '') flag = true
                    temp[i] = el.value;
                    temp2[i] = el.id
                    i++
                });

                this.input_data = temp
                this.input_header = temp2
                if (flag == false) {
                    axios.post('http://127.0.0.1:8000/adminaction', {

                        action: e.id,
                        input_data: this.input_data,
                        input_header: this.input_header,
                        db: this.data_id


                    })
                        .then(response => {
                            alert('Успешно')

                        })
                        .catch(error => {
                            console.log(error);
                        })
                }
                else alert('Заполните все поля')

            }
            else if (e.id == 'update') {
                let temp = new Array
                let temp2 = new Array
                let list = document.getElementsByClassName('db-update')
                let i = 0;
                let flag = false; // true если есть пустые значения
                Array.from(list).forEach(function (el) {
                    if (el.value == '') flag = true
                    temp[i] = el.value;
                    temp2[i] = el.id
                    i++
                });

                this.input_data = temp
                this.input_header = temp2
                if (flag == false) {
                    axios.post('http://127.0.0.1:8000/adminaction', {

                        action: e.id,
                        input_data: this.input_data,
                        input_header: this.input_header,
                        db: this.data_id,
                        update_id: this.update_id

                    })
                        .then(response => {
                            alert('Успешно')

                        })
                        .catch(error => {
                            console.log(error);
                        })
                }
                else alert('Заполните все поля')

            }
            else if (e.id == 'remove') {

                let id = document.getElementsByClassName('db-remove')[0].value

                if (id != '') {
                    axios.post('http://127.0.0.1:8000/adminaction', {

                        action: e.id,
                        db: this.data_id,
                        remove_id: id

                    })
                        .then(response => {
                            alert('Успешно')

                        })
                        .catch(error => {
                            console.log(error);
                        })
                }
                else alert('Заполните все поля')
            }
        },

        carouselClick: function () {
            let allowedExtension = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/bmp'];
            let type = document.getElementById('carouselimgs').files;
            console.log(document.getElementById('carouselimgs').files);
            let notimage = false;

            var formData = new FormData();
            var i = 1
            Array.from(type).forEach(function (el) {
                if (allowedExtension.indexOf(el.type) > -1) {
                    console.log(el.type)
                    formData.append("image" + i, el);
                    i++
                } else {
                    notimage = true
                }
            });


            console.log(formData)


            if (notimage == false) {
                axios.post('/carousel',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function () {
                    console.log('SUCCESS!!');
                })
                    .catch(error => {
                        console.log(error);
                    })
            } else {
                alert('Используйте только картинки')
            }


        }


    }
}
</script>