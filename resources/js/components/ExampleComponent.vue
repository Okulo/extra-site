<template>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Список объявлений</div>
                    <div class="card-body">
                        <div v-for="data in forms" class="list-group" id="list-tab" role="tablist">
                            <span class="list-group-item list-group-item-action"  @click="show(data.id)" >
                               {{data.name}}
                            </span>
                        </div>

                        <div v-if="formId" style="margin-top: 15px; border: #e9ecef 1px solid; padding: 10px;" >
                            <h4>{{boardFields.name}}</h4>
                                <div>
                                    <img :src="boardFields.photo" >
                                </div>
                                <br>
                                <h5>Цена: {{boardFields.price}}</h5>
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
                formId: '',
                boardFields: [],
                formCreatedAt: '',
                serializedForm: ''
            }
        },
        methods : {
            show(id){
                axios.get('/home/getBoard',{
                    params: {
                        id: id,
                    },
                })
                    .then(response => {
                        this.formId = response.data.id;
                        this.boardFields = response.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            getBoards(){
                axios.get('/home/getBoards',{
                   // _token: 'SbsI80JW1CL3RNqODHzhA77pgfbUgK6tlPVGxkKA'
                })
                    .then(response => {
                        this.forms = response.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
        },
        mounted() {
            this.getBoards();
        }
    }
</script>
