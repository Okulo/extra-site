<template>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Список форм</div>
                    <div class="card-body">
                        <div v-for="data in forms" class="list-group" id="list-tab" role="tablist">
                            <span class="list-group-item list-group-item-action"  @click="makeForm(data.uid)" >
                                UID# {{data.uid}} - {{data.name}}
                            </span>
                        </div>

                        <div v-if="formUid" style="margin-top: 15px; border: #e9ecef 1px solid; padding: 10px;" >
                            <h4>{{formName}}</h4>
                            <form @submit="onSubmit" class="add-form" id="add-form">
                                <div  v-for="field in formFields" class="form-control">
                                    <input class="col-md-4"  :type='field.type' :name='field.name' :placeholder='field.description'>
                                </div>
                                <br>
                                <input type="submit" value="Отправить" class="btn btn-sm btn-outline-success" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        data (){
            return {
                forms: [],
                formName: '',
                formUid: '',
                formFields: [],
                formCreatedAt: '',
                serializedForm: ''
            }
        },
        methods : {
            makeForm(uid){
                axios.get('https://alakol-parus.kz/extra-api/public/home/getFullForm',{
                        params: {
                            uid: uid,
                        },
                    })
                    .then(response => {
                        this.formName = response.data.name;
                        this.formUid = response.data.uid;
                        this.formCreatedAt = response.data.created_at;
                       // this.formFields = response.data.fields;
                        this.formFields = JSON.parse(response.data.fields);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            getForms(){
                axios.get('https://alakol-parus.kz/extra-api/public/home/getForms',{
                   // _token: 'SbsI80JW1CL3RNqODHzhA77pgfbUgK6tlPVGxkKA'
                })
                    .then(response => {
                        this.forms = response.data;
                        console.log(response.data);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },

            onSubmit(e){
                e.preventDefault()
                this.serializedForm = $('#add-form').serialize();

                axios.get('https://alakol-parus.kz/extra-api/public/home/saveData',{
                    params: {
                        uid: this.formUid,
                        name: this.formName,
                        data: this.serializedForm
                    },
                })
                    .then(response => {
                        if(response.data.created_at){
                            alert('Форма успешно отправлена');
                            location.reload();
                        }
                       // console.log(response);
                    })
                    .catch(err => {
                        console.log(err);
                    });

            },
            saveForm(){
                console.log('saved!');
                this.formUid = Math.floor(Math.random() * Date.now());

                axios.post('/home/saveForm', {
                    formUid: this.formUid,
                    formName: this.formName,
                    formData: this.formData
                })
                    .then(response => {
                        if(response.data.created_at){
                            alert('форма успешно сохранена!');
                            location.reload();
                        }
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        mounted() {
            this.getForms();
        }
    }
</script>
