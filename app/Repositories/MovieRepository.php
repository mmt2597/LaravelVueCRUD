<?php 
namespace App\Repositories;

use Illuminite\Http\Request;
use App\Http\Requests\MovieRequest;
use App\Interfaces\MovieInterface;
use App\Traits\ResponseAPI;
use App\Models\Movie;

class MovieRepository implements MovieInterface
{
	use ResponseAPI;

	public function getMovies ()
	{
		try {
			$movies = Movie::orderBy('created_at', 'DESC')->get();
			return $this->success("Get All List Movies", $movies);
		} catch (\Exception $e) {
			return $this->error($e->getMessage(), 201);
		}
	}

	public function getMovieById($id)
	{
		try {
			$movie = Movie::find($id);

			if(!$movie) return $this->error("No Movie Found", 404);
			return $this->success("Get All List Movies", $movie);
		} catch (\Exception $e) {
			return $this->error($e->getMessage(), 201);
		}
	}

	public function requestMovie (MovieRequest $request, $id = null)
	{
		try {
			// If Movie Exists Operation Will be Update
			// Else Create New Movie 
			$movie = $id ? Movie::find($id) : new Movie;

			// Check Movie
			if($id && !$movie) return $this->error('No Movie Found', 404);

			$movie->image = $request->image;
			$movie->title = $request->title;
			$movie->genre = $request->genre;
			$movie->directors = $request->directors;
			$movie->casts = $request->casts;
			$movie->description = $request->description;
			$movie->save();

			$message = $id ? "Movie Updated" : "Movie Created";
			$statusCode = $id ? 200 : 201;
			return $this->success($message, $movie, $statusCode);

		} catch (\Exception $e) {
			return $this->error($e->getMessage(), 201);
		}
	}

	public function deleteMovie ($id)
	{
		try {
			$movie = Movie::find($id);

			if(!$movie) return $this->error("No Movie Found", 404);
			
			$movie->delete();
			return  $this->success("Movie Deleted", $movie);
		} catch (\Exception $e) {
			return $this->error($e->getMessage(), 201);
		}
	}
}

?>