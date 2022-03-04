<style scoped>
.card{
    position: relative;
}
</style>
<template>
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <form method="POST" action="">

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Main Category</label>

                                    <div class="col-md-12">
                                        <select name="main_cate" id="main_cate" class="form-control" @change="getSubCategories($event)">
                                            <option value="" selected disabled>Select Category</option>
                                            <option v-for="category in mainCategories" class="mb-2" :value="category.id" :key="category.id">{{category.name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">Sub Category</label>

                                    <div class="col-md-12">
                                        <select name="sub_cate" id="sub_cate" class="form-control" @change="getProperties($event)">
                                            <option value="" selected disabled>Select subcategory</option>
                                            <option v-for="category in subCategories" :value="category.id" :key="category.id">{{category.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div v-if="show">
                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">Process Type</label>

                                        <div class="col-md-12">
                                            <select name="sub_cate" id="sub_cate" class="form-control">
                                                <option value="" selected disabled>Select process type</option>
                                                <option value="">Other</option>
                                                <option value="">Unspecified</option>
                                                <option v-for="option in options" :value="option.id" :key="option.id">{{option.name}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">Brand</label>

                                        <div class="col-md-12">
                                            <select name="sub_cate" id="sub_cate" class="form-control" @change="getModels($event)">
                                                <option value="" selected disabled>Select Brand</option>
                                                <option v-for="brand in brands" :value="brand.id" :key="brand.id">{{brand.name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="showModels">
                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">Model</label>

                                        <div class="col-md-12">
                                            <select name="sub_cate" id="sub_cate" class="form-control" @change="getTypes($event)">
                                                <option value="" selected disabled>Select Model</option>
                                                <option v-for="model in models" :value="model.id" :key="model.id">{{model.name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="showTypes">
                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">Type</label>

                                        <div class="col-md-12">
                                            <select name="sub_cate" id="sub_cate" class="form-control">
                                                <option value="" selected disabled>Select Type</option>
                                                <option v-for="type in types" :value="type.id" :key="type.id">{{type.name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <Loading v-if="loading"></Loading>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            url: 'https://staging.mazaady.com',
            mainCategories: [],
            subCategories: [],
            properties: [],
            options: [],
            brands: [],
            models:[],
            types: [],
            showModels: false,
            showTypes: false,
            show: false,
            loading: false
        }
    },
    mounted(){
        this.getMainCategories()
    },
    methods:{
        getMainCategories(){
            this.loading = true
            axios.get(`api/get_all_cats`,{
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-Type': 'application/json',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                }
            })
            .then(res => {
                // var valObj = res.data.data.categories.filter(function(elem){
                //     if(elem.id == 12) console.log(elem.children);
                // });
                this.mainCategories = res.data.data.categories
                this.loading = false
            })
        },
        getSubCategories(e){
            this.loading = true
            const id = e.target.value;
            axios.get(`api/get_sub_cats`,{
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-Type': 'application/json',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                }
            })
            .then(res => {
                this.subCategories = []
                var arr = res.data.data.categories.filter(function(elem){
                    if(elem.id == id) {
                        return elem.children
                    }
                });
                this.subCategories = arr[0].children
                this.loading = false
            })
        },
        getProperties(e){
            this.loading = true
            const id = e.target.value;
            axios.get(`api/get_properties/${id}`,{
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-Type': 'application/json',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                }
            }).then(res => {
                console.log(res.data)
                this.options = []
                if(res.data.data.length > 0){
                    this.options = res.data.data[0].options;
                    this.brands = res.data.data[1].options;
                    (res.data.data[0].list == false)? this.show = true : this.show = false;
                }
                this.loading = false
            })
        },
        getModels(e){
            this.loading = true
            const id = e.target.value;
            axios.get(`api/get_models/${id}`,{
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-Type': 'application/json',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                }
            }).then(res => {
                console.log(res.data)
                this.options = []
                if(res.data.data.length > 0){
                    this.models = res.data.data[0].options;
                }
                this.showModels = true
                this.loading = false
            })
        },
        getTypes(e){
            this.loading = true
            const id = e.target.value;
            axios.get(`api/get_models/${id}`,{
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-Type': 'application/json',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                }
            }).then(res => {
                console.log(res.data)
                this.options = []
                if(res.data.data.length > 0){
                    this.types = res.data.data[0].options;
                }
                this.showTypes = true
                this.loading = false
            })
        }
    }
}
</script>
