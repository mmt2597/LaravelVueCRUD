<template>

    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Movie</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="/admin/movies">Movie</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="buttons pb-3">
                            <router-link tag="a" to="/movies" class="btn btn-primary">
                                Back
                            </router-link>
                            <br/>
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Edit Movie</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" @submit.prevent="onSubmit" @keydown="form.errors.clear()">
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="title" title="title" required autocomplete="title" autofocus placeholder="Title" v-model="form.title">
                                            <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('title')" v-text="form.errors.get('title')"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="genre" class="col-sm-2 col-form-label">Genre</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="genre" title="genre" required autocomplete="genre" autofocus placeholder="Genre" v-model="form.genre">
                                            <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('genre')" v-text="form.errors.get('genre')"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="directors" class="col-sm-2 col-form-label">Directors</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="directors" title="directors" required autocomplete="directors" autofocus placeholder="Directors" v-model="form.directors">
                                            <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('directors')" v-text="form.errors.get('directors')"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="casts" class="col-sm-2 col-form-label">Casts</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="casts" title="casts" required autocomplete="casts" autofocus placeholder="Casts" v-model="form.casts">
                                            <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('casts')" v-text="form.errors.get('casts')"></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" class="col-form-label form-control" id="description" title="description" v-model="form.description" autofocus required placeholder="Description"></textarea>
 
                                            <span class="invalid-feedback d-block" role="alert" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
                                        </div>
                                    </div>

                                   

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info" :disabled="form.errors.any()">Save</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>

                    </div>

                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /.content -->

    </div>

</template>

<script>

    export default {

        data() {

            return {
                form: new Form({
                    'title': '',
                    'genre': '',
                    'directors': '',
                    'casts': '',
                    'description': '',
                })
            }

        },

        created() {
            // console.log(this.$route.params.id);
            var self = this;
            axios.get('/api/movies/' + this.$route.params.id + '/edit')
                .then(({data}) => this.form = new Form(data.results));
        },

        methods: {
            onSubmit(){
                this.form
                    .put('/api/movies/' + this.$route.params.id)
                    .then(function (response) {
                        if(response.error) {
                            alert(response.message);
                            return;
                        }
                        window.location.href = '/admin/movies'
                    });
            }
        }
    }

</script>
