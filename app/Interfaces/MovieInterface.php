<?php

namespace App\Interfaces;

use App\Http\Requests\MovieRequest;

interface MovieInterface 
{
	public function getMovies();
	public function getMovieById($id);
	public function requestMovie(MovieRequest $request, $id = null);
	public function deleteMovie($id);

} 