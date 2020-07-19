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
                            <li class="breadcrumb-item active">Movie</li>
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
                            <router-link tag="a" to="/movies/create" class="btn btn-primary">
                                Create
                            </router-link>
                            <br/>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Genre</th>
                                        <th>Directors</th>
                                        <th>Casts</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-if="movies.length > 0" v-for="movie in movies">
                                        <td>{{ movie.image }}</td>
                                        <td>{{ movie.title }}</td>
                                        <td>{{ movie.genre }}</td>
                                        <td>{{ movie.directors }}</td>
                                        <td>{{ movie.casts }}</td>
                                        <td>
                                            <router-link :to="`/movies/${movie.id}/edit`" class="btn btn-sm btn-primary">Edit</router-link>
                                            <button class="btn btn-sm btn-danger" @click="deleteMovie(movie.id)">Delete</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
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
                movies: [],
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
            axios.get('/api/movies')
                .then(({data}) => this.movies = data.results);
        },

        methods: {
            deleteMovie (id) {
                let self = this;
                axios.delete('/api/movies/' + id)
                    .then(function (response) {
                        console.log(response);
                        if(response.data.error) {
                            alert("Error Delete");
                        }
                        var index = _.findIndex(self.movies, function (o) { return o.id == id;});
                        self.movies.splice(index, 1);
                    });
            }
        }
    }

</script>
