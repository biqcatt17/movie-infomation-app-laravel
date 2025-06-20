<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    // Change from private to protected
    protected $dummyMovies = [
        [
            'id' => 1,
            'title' => 'Doctor Strange in the Multiverse of Madness',
            'poster' => 'asset/images/1.jpeg',
            'release_date' => '2022',
            'duration' => '2h 6m',
            'rating' => '8.5',
            'imdb_rating' => '7.5',
            'views' => 1200, // Add views property
            'description' => 'Dr. Stephen Strange casts a forbidden spell...',
            'genre' => 'Action, Adventure, Fantasy',
            'director' => 'Sam Raimi',
            'cast' => 'Benedict Cumberbatch, Elizabeth Olsen, Chiwetel Ejiofor',
            'language' => 'English',
            'category' => 'Action',
            'storyline' => 'In this sequel to "Doctor Strange," the titular character must navigate the multiverse to protect reality from a powerful new threat. Alongside Wanda Maximoff, he faces dark forces that challenge his understanding of magic and the consequences of his actions.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/4r7wHMg5Yjg'
        ],
        [
            'id' => 2,
            'title' => 'Memory',
            'poster' => 'asset/images/2.png',
            'release_date' => '2022',
            'duration' => '1h 54m',
            'imdb_rating' => '6.1',
            'views' => 800, // Add views property
            'description' => 'An expert assassin with a memory disorder...',
            'genre' => 'Action, Thriller',
            'director' => 'Martin Campbell',
            'cast' => 'Liam Neeson, Guy Pearce, Monica Bellucci',
            'language' => 'English',
            'category' => 'Action',
            'storyline' => 'Alex Lewis, an expert assassin, is on the verge of retirement when he discovers that his latest target',
            'trailer_embed_url' => 'https://www.youtube.com/embed/yGw8yw6Mso8?si=6ZpDp4zOqq8XbC_a'
        ],
        [
            'id' => 3,
            'title' => 'The Unbearable Weight of Massive Talent',
            'poster' => 'asset/images/3.png',
            'release_date' => '2022',
            'duration' => '1h 47m',
            'rating' => '9.1',
            'imdb_rating' => '7.7',
            'views' => 1500, // Add views property
            'rating_quality' => 'Excellent',
            'description' => 'Nicolas Cage plays a fictionalized version of himself who is creatively unfulfilled and facing financial ruin, leading him to accept a $1 million offer to attend the birthday of a dangerous superfan.',
            'genre' => 'Action, Comedy',
            'director' => 'Tom Gormican',
            'cast' => 'Nicolas Cage, Pedro Pascal, Tiffany Haddish',
            'language' => 'English',
            'category' => 'Action',
            'storyline' => 'In this meta-comedy, Nicolas Cage is desperate to get a role in a Quentin Tarantino movie. With his career in a slump, he grudgingly accepts a $1 million offer to attend the birthday of a dangerous fan, Javi Gutierrez. Things take a wild turn when a CIA agent recruits him for a mission to take down the fan, who is a notorious arms dealer.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/CKTRbKch2K4?si=aCtwTkTf-DyFcHkn'
        ],
        [
            'id' => 4,
            'title' => 'The Northman',
            'poster' => 'asset/images/4.png',
            'release_date' => '2022',
            'duration' => '2h 17m',
            'rating' => '8.8',
            'imdb_rating' => '7.2',
            'views' => 1500, 
            'description' => 'From director Robert Eggers, "The Northman" is an epic revenge thriller that explores how far a Viking prince will go to seek justice for his murdered father.',
            'genre' => 'Action, Adventure, Drama',
            'director' => 'Robert Eggers',
            'cast' => 'Alexander Skarsgård, Nicole Kidman, Claes Bang',
            'language' => 'English',
            'storyline' => 'A young Viking prince, Amleth, vows to avenge his father\'s murder by his uncle. He sets out on a brutal quest that takes him through the icy landscapes of the North Atlantic, culminating in a climactic showdown on an active volcano.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/oMSdFM12hOw?si=W1deEBSCGkPu4gdu'
        ],
        [
            'id' => 5,
            'title' => 'Fantastic Beasts: The Secrets of Dumbledore',
            'poster' => 'asset/images/5.jpg',
            'release_date' => '2022',
            'duration' => '2h 22m',
            'rating' => '7.0',
            'imdb_rating' => '6.2',
            'views' => 1500, 
            'description' => 'Professor Albus Dumbledore knows the powerful dark wizard Gellert Grindelwald is moving to seize control of the wizarding world. Unable to stop him alone, he entrusts Magizoologist Newt Scamander to lead an intrepid team.',
            'genre' => 'Adventure, Family, Fantasy',
            'director' => 'David Yates',
            'cast' => 'Eddie Redmayne, Jude Law, Mads Mikkelsen',
            'language' => 'English',
            'storyline' => 'Albus Dumbledore tasks Newt Scamander and a team of wizards and witches with a dangerous mission that could lead to a confrontation with the powerful dark wizard Gellert Grindelwald. The fate of the wizarding world hangs in the balance as they uncover Grindelwald\'s escalating power.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/Y9dr2zw-TXQ'
        ],
        [
            'id' => 6,
            'title' => 'Sonic The Hedgehog 2',
            'poster' => 'asset/images/6.png',
            'release_date' => '2022',
            'duration' => '2h 2m',
            'rating' => '9.0',
            'imdb_rating' => '6.5',
            'views' => 1500, 
            'description' => 'When the evil Dr. Robotnik returns with a new ally, Knuckles the Echidna, Sonic and his new friend Tails embark on a globe-trotting adventure to find a massive emerald before it falls into the wrong hands.',
            'genre' => 'Animation, Action, Adventure',
            'director' => 'Jeff Fowler',
            'cast' => 'James Marsden, Ben Schwartz (voice), Jim Carrey',
            'language' => 'English',
            'storyline' => 'Sonic is ready for more freedom, and Tom and Maddie agree to let him stay home while they go on vacation. But when Dr. Robotnik returns, this time with a new partner, Knuckles, Sonic must team up with his own sidekick, Tails, to find the Master Emerald before it falls into the wrong hands.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/G5kzUpWAusI?si=Jczsjl2u41TrpZHk'
        ],
        [
            'id' => 7,
            'title' => 'Morbius',
            'poster' => 'asset/images/7.png',
            'release_date' => '2022',
            'duration' => '1h 44m',
            'rating' => '6.0',
            'imdb_rating' => '5.2',
            'views' => 1500, 
            'description' => 'Dangerously ill with a rare blood disorder and determined to save others suffering his same fate, Dr. Morbius attempts a desperate gamble. While at first it seems to be a radical success, a darkness inside him is unleashed.',
            'genre' => 'Action, Adventure, Sci-Fi',
            'director' => 'Daniel Espinosa',
            'cast' => 'Jared Leto, Matt Smith, Adria Arjona',
            'language' => 'English',
            'storyline' => 'Biochemist Michael Morbius attempts to cure his rare blood disease. What at first appears to be a success soon reveals itself to be a potentially deadly cure, transforming him into a living vampire with superhuman abilities but also a strong desire for blood.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/oZ6iiRrz1SY?si=eyCpoUUgWBLYuf4j'
        ],
        [
            'id' => 8,
            'title' => 'Death on the Nile',
            'poster' => 'asset/images/8.png',
            'release_date' => '2022',
            'duration' => '2h 7m',
            'rating' => '7.8',
            'imdb_rating' => '6.2',
            'views'=>1056,
            'description' => 'Belgian sleuth Hercule Poirot investigates the murder of a young heiress on a cruise ship on the Nile River.',
            'genre' => 'Crime, Drama, Mystery',
            'director' => 'Kenneth Branagh',
            'cast' => 'Kenneth Branagh, Gal Gadot, Armie Hammer',
            'language' => 'English',
            'storyline' => 'Belgian detective Hercule Poirot\'s Egyptian vacation aboard a glamorous river steamer turns into a terrifying search for a murderer when a picture-perfect couple\'s idyllic honeymoon is tragically cut short. Set against an epic landscape of sweeping desert vistas and majestic Giza pyramids, this tale of unbridled passion and incapacitating jealousy features a cosmopolitan group of impeccably dressed travelers, and enough wicked twists and turns to leave audiences guessing until the final, shocking denouement.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/dZRqB0JLizw?si=js8-M-GrgXLCjFp3'
        ],
        [
            'id' => 9,
            'title' => 'Mission: Chapter 1',
            'poster' => 'asset/images/9.jpg',
            'release_date' =>'2024',
            'duration' =>'2h 5m',
            'rating' =>'8.3',
            'imdb_rating' =>'6.1',
            'views'=>1000,
            'description' =>'A father takes his daughter to UK for treatment. But he ends up in trouble',
            'genre' =>'action',
            'director' =>'A.L. Vijay',
            'cast' =>'Arun VijayAmy ,JacksonNimisha ,Sajayan',
            'language' =>'Tamil',
            'category' => 'Action',
            'storyline' =>'A father takes his daughter to the UK for treatment, but he ends up in trouble with the law and must navigate a dangerous situation to protect his family.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/U1A9UWPAnNA?si=C_oxluCfCkvsbwbk'
        ],
    ];
public function index(Request $request)
{
    $search = $request->input('search');
    
    $movies = collect($this->dummyMovies)
        ->when($search, function ($collection) use ($search) {
            return $collection->filter(function ($movie) use ($search) {
                return stripos($movie['title'], $search) !== false;
            });
        })
        ->map(fn($movie) => (object) $movie);

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 8;
    $paginatedMovies = new LengthAwarePaginator(
        $movies->forPage($currentPage, $perPage),
        $movies->count(),
        $perPage,
        $currentPage,
        ['path' => LengthAwarePaginator::resolveCurrentPath()]
    );

    return view('index', ['movies' => $paginatedMovies]);
}
    public function show($id)
{
    $movie = collect($this->dummyMovies)
        ->firstWhere('id', (int)$id);

    if (!$movie) {
        abort(404);
    }

    $movie = (object)$movie;
    $movie->comments = collect([]);
    $movie->ratings = collect([]);
    $movie->average_rating = 0;
    // Ensure trailer_url is available
    $movie->trailer_embed_url = $movie->trailer_embed_url ?? null;

    return view('movie-detail', compact('movie'));
}

    /**
     * Display a listing of all movies.
     * This method handles the /movies route.
     *
     * @return \Illuminate\View\View
     */
public function movies(Request $request)
{
    $search = $request->input('search');
    $category = $request->input('category');
    $filter = $request->input('filter', 'latest'); // default to latest

    $movies = collect($this->dummyMovies)
        ->when($search, function ($collection) use ($search) {
            return $collection->filter(function ($movie) use ($search) {
                return stripos($movie['title'], $search) !== false;
            });
        })
        ->when($category, function ($collection) use ($category) {
            return $collection->where('category', $category);
        });

    // Apply filtering
    switch ($filter) {
        case 'rating':
            $movies = $movies->sortByDesc('rating');
            break;
        case 'views':
            $movies = $movies->sortByDesc('views');
            break;
        default: // latest
            $movies = $movies->sortByDesc('year');
            break;
    }

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 8;
    $paginatedMovies = new LengthAwarePaginator(
        $movies->forPage($currentPage, $perPage),
        $movies->count(),
        $perPage,
        $currentPage,
        ['path' => LengthAwarePaginator::resolveCurrentPath()]
    );

    return view('movies', [
        'allMovies' => $paginatedMovies,
        'activeFilter' => $filter
    ]);
}

    // Add this method to MovieController.php, TVShowController.php, and WebSeriesController.php respectively
    public function getDummyMovies()
{
    return $this->dummyMovies;
}
}