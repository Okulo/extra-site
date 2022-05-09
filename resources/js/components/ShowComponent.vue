<template>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Данные форм</div>
                    <div class="card-body">
                        <div v-for="data in forms" class="list-group" id="list-tab" role="tablist">
                            <span class="list-group-item list-group-item-action"  @click="getFormDetail(data.form_id)" >
                                 {{data.form_name}}
                            </span>
                        </div>
                        <div v-if="fullData.length > 0" style="margin-top: 15px; border: #e9ecef 1px solid; padding: 10px;" >
                            <h5>Полные данные</h5>
                                <div  v-for="field in fullData" class="form-control">
                                    {{field.name}} - {{field.value}}
                                </div>
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
                formName: [],
                formUid: '',
                formFields: [],
                fullData: [],
            }
        },
        methods : {
            getFormsData(){
                axios.get('http://127.0.0.1:8000/home/getFormData',{
                   // _token: 'SbsI80JW1CL3RNqODHzhA77pgfbUgK6tlPVGxkKA'
                })
                    .then(response => {
                        response.data.forEach(elem =>{
                            this.forms.push({
                                form_name: elem.form_name,
                                form_data: JSON.parse(elem.form_data),
                                created_at: elem.created_at,
                                form_id: elem.form_id
                            });
                        });


                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            getFormDetail(id){
                this.fullData = [];
                this.forms.forEach(elem=>{
                    if(elem.form_id == id){

                        var formFieldArray = elem.form_data.split("&");
                        $.each(formFieldArray, function(i, pair){
                            var nameValue = pair.split("=");
                            var name = decodeURIComponent(nameValue[0]);
                            var value = decodeURIComponent(nameValue[1]);
                        });

                        formFieldArray.forEach(elem =>{
                            var nameValue = elem.split("=");
                            var name = decodeURIComponent(nameValue[0]);
                            var value = decodeURIComponent(nameValue[1]);
                            this.fullData.push({
                               name: name,
                               value: value,
                            });
                        });

                    }

                });
            }
        },
        mounted() {
            this.getFormsData();
        }
    }
</script>
