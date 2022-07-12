<template>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Создать объявление</div>
                    <div class="card-body">
                        <form @submit="onSubmit" class="add-form">
                            <div class="form-control">
                                <input class="col-md-4" type="text" v-model="name" name="name" placeholder="Название" /><br><br>
                                <input class="col-md-4" type="text" v-model="photo"  name="photo" placeholder="Ссылка на фото" /><br><br>
                                <input class="col-md-4" type="number" v-model="price" name="price" placeholder="Цена" /><br> <br>
                                <input type="submit" value="Добавить" class="btn btn-sm btn-outline-success" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        data (){
            return {
                photo: '',
                name: '',
                price: '',
            }
        },
        methods : {
            onSubmit(e){
                if(!this.name || !this.photo || !this.price){
                    alert('Введите все данные')
                    return
                }

                console.log('save');
                this.formUid = Math.floor(Math.random() * Date.now());

                axios.post('/home/saveForm', {
                    name: this.name,
                    price: this.price,
                    photo: this.photo
                })
                    .then(response => {

                        console.log(response);
                        if(response.data.created_at){
                            alert('Даныне успшено добавлены!');
                            location.reload();
                        }
                    })
                    .catch(err => {
                        console.log(err);
                    });

                e.preventDefault()
            },

        }
    }
</script>
