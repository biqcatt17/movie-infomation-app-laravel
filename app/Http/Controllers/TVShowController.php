<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator; // Add this at the top
class TVShowController extends Controller
{
    // Change from private to protected
    protected $dummyTVShows = [
        [
            'id' => 1,
            'title' => 'Stranger Things',
            'poster' => 'asset/images/shows/stranger-things.jpg', // Changed from 'assets' to 'asset'
            'year' => '2016',
            'rating' => '8.7',
            'seasons' => 4,
            'network' => 'Netflix',
            'views' => 150000,
            'release_date' => '2016-07-15',
            'genre' => 'Drama, Fantasy, Horror',
            'director' => 'The Duffer Brothers',
            'cast' => 'Millie Bobby Brown, Finn Wolfhard, Winona Ryder',
            'language' => 'English',
            'imdb_rating' => '8.7',
            'description' => 'When a young boy disappears, his mother, a police chief and his friends must confront terrifying supernatural forces in order to get him back.',
            'storyline' => 'In a small town where everyone knows everyone, a peculiar incident starts a chain of events that leads to the disappearance of a child, which begins to tear at the fabric of an otherwise peaceful community.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/b9EkMc79ZSU'
        ],
        [
            'id' => 2,
            'title' => 'Breaking Bad',
            'poster' => 'asset/images/shows/breaking-bad.jpg',
            'year' => '2008',
            'rating' => '9.5',
            'seasons' => 5,
            'network' => 'AMC',  // Added network field
            'views' => 200000,
            'release_date' => '2008-01-20',
            'genre' => 'Crime, Drama, Thriller',
            'director' => 'Vince Gilligan',
            'cast' => 'Bryan Cranston, Aaron Paul, Anna Gunn',
            'language' => 'English',
            'imdb_rating' => '8.7',
            'description' => 'A high school chemistry teacher turned methamphetamine manufacturer partners with a former student to secure his family\'s financial future.',
            'storyline' => 'When a high school chemistry teacher is diagnosed with terminal cancer, he turns to a life of crime to secure his family\'s financial future, leading to a series of events that spiral out of control.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/HhesaQXLuRY'

        ],
        [
            'id' => 3,
            'title' => 'The Crown',
            'poster' => 'asset/images/shows/the-crown.jpg',
            'year' => '2016',
            'rating' => '8.7',
            'seasons' => 5,
            'network' => 'Netflix',
            'views' => 120000,
            'release_date' => '2016-11-04',
            'genre' => 'Biography, Drama, History',
            'director' => 'Peter Morgan',
            'cast' => 'Claire Foy, Olivia Colman, Imelda Staunton',
            'language' => 'English',
            'imdb_rating' => '8.7',
            'description' => 'The story of the reign of Queen Elizabeth II, exploring the political and personal events that shaped her life and the nation.',
            'storyline' => 'A chronicle of the life and reign of Queen Elizabeth II, from her early days as a young princess to her ascension to the throne and the challenges she faces as a monarch.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/JWtnJjn6ng0?si=JULnsC1ptmBn0t2z'
        ],
        [
            'id' => 4,
            'title' => 'Game of Thrones',
            'poster' => 'asset/images/shows/game-of-thrones.jpg',
            'year' => '2011',
            'rating' => '9.3',
            'seasons' => 8,
            'network' => 'HBO',
            'views' => 300000,
            'release_date' => '2011-04-17',
            'genre' => 'Action, Adventure, Drama',
            'director' => 'David Benioff, D.B. Weiss',
            'cast' => 'Emilia Clarke, Kit Harington, Peter Dinklage',
            'language' => 'English',
            'imdb_rating' => '8.7',
            'description' => 'Noble families vie for control of the Iron Throne in the mythical land of Westeros, leading to a battle for power and survival.',
            'storyline' => 'In a land where summers can last decades and winters a lifetime, noble families vie for control of the Iron Throne, leading to a complex web of alliances and betrayals.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/KPLWWIOCOOQ?si=xwdJoLGBlTMF9lZ0'
        ],
        [
            'id' => 5,
            'title' => 'The Mandalorian',
            'poster' => 'asset/images/shows/the-mandalorian.jpg',
            'year' => '2019',
            'rating' => '8.8',
            'seasons' => 3,
            'network' => 'Disney+',
            'views' => 180000,
            'release_date' => '2019-11-12',
            'genre' => 'Action, Adventure, Fantasy',
            'director' => 'Jon Favreau',
            'cast' => 'Pedro Pascal, Gina Carano, Carl Weathers',
            'language' => 'English',
            'imdb_rating' => '8.7',
            'description' => 'A lone bounty hunter in the outer reaches of the galaxy, far from the authority of the New Republic, embarks on a journey to protect a mysterious child.',
            'storyline' => 'Set in the Star Wars universe, a lone bounty hunter navigates the outer reaches of the galaxy, taking on dangerous missions while protecting a mysterious child.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/aOC8E8z_ifw?si=WSSSlFNyaFMmT99x'
        ],
         [
    'id' => 6,
    'title' => 'Planet Earth II',
    'poster' => 'asset/images/shows/planet-earth-ii.jpg',
    'year' => '2016',
    'rating' => '9.5',
    'seasons' => 1,
    'network' => 'BBC',
    'views' => 180000,
    'release_date' => '2016-11-06',
    'genre' => 'Documentary, Adventure, Nature',
    'director' => 'David Attenborough (narrator)',
    'cast' => 'David Attenborough',
    'language' => 'English',
    'imdb_rating' => '8.7',
    'description' => 'A stunning exploration of Earth’s diverse habitats and wildlife.',
    'storyline' => 'From remote islands to harsh deserts, each episode highlights the delicate balance of nature in spectacular locales.',
    'trailer_embed_url' => 'https://www.youtube.com/embed/c8aFcHFu8QM'
  ],
  [
    'id' => 7,
    'title' => 'Chernobyl',
    'poster' => 'asset/images/shows/chernobyl.jpg',
    'year' => '2019',
    'rating' => '9.4',
    'seasons' => 1,
    'network' => 'HBO',
    'views' => 150000,
    'release_date' => '2019-05-06',
    'genre' => 'Drama, History, Thriller',
    'director' => 'Craig Mazin',
    'cast' => 'Jared Harris, Stellan Skarsgård, Emily Watson',
    'language' => 'English',
    'imdb_rating' => '8.7',
    'description' => 'Dramatization of the 1986 Chernobyl nuclear disaster and its aftermath.',
    'storyline' => 'Officials and engineers race to contain the catastrophe and uncover the truths behind the explosion.',
    'trailer_embed_url' => 'https://www.youtube.com/embed/s9APLXM9Ei8'
  ],
  [
    'id' => 8,
    'title' => 'Band of Brothers',
    'poster' => 'asset/images/shows/band-of-brothers.jpg',
    'year' => '2001',
    'rating' => '9.4',
    'seasons' => 1,
    'network' => 'HBO',
    'views' => 170000,
    'release_date' => '2001-09-09',
    'genre' => 'Action, Drama, History',
    'director' => 'Tom Hanks, Steven Spielberg (producers)',
    'cast' => 'Damian Lewis, Ron Livingston, Donnie Wahlberg',
    'language' => 'English',
    'imdb_rating' => '8.7',
    'description' => 'Following “Easy Company” of the US Army during WWII in Europe.',
    'storyline' => 'From training camp to D‑Day, the series depicts bravery, losses, and camaraderie through intense battles.',
    'trailer_embed_url' => 'https://www.youtube.com/embed/KKRBAFlN5ww?si=aX2GePxFZiZlE3j5'
  ],
  [
    'id' => 9,
    'title' => 'The Wire',
    'poster' => 'asset/images/shows/the-wire.jpg',
    'year' => '2002–2008',
    'rating' => '9.3',
    'seasons' => 5,
    'network' => 'HBO',
    'views' => 160000,
    'release_date' => '2002-06-02',
    'genre' => 'Crime, Drama, Thriller',
    'director' => 'David Simon',
    'cast' => 'Dominic West, Lance Reddick, Wendell Pierce',
    'language' => 'English',
    'imdb_rating' => '8.7',
    'description' => 'An unflinching look at Baltimore through the eyes of both law enforcers and drug dealers.',
    'storyline' => 'Each season explores different facets: drug trade, bureaucracy, education, politics, and media.',
    'trailer_embed_url' => 'https://www.youtube.com/embed/lUeOCo0HeJo?si=HsLbQU685le6AcXg'
  ],
  [
    'id' => 10,
    'title' => 'Avatar: The Last Airbender',
    'poster' => 'asset/images/shows/avatar-the-last-airbender.jpg',
    'year' => '2005–2008',
    'rating' => '9.3',
    'seasons' => 3,
    'network' => 'Nickelodeon',
    'views' => 140000,
    'release_date' => '2005-02-21',
    'genre' => 'Animation, Action, Adventure',
    'director' => 'Michael Dante DiMartino, Bryan Konietzko',
    'cast' => 'Zach Tyler Eisen, Mae Whitman, Jack DeSena',
    'language' => 'English',
    'imdb_rating' => '8.7',
    'description' => 'A young Avatar must master all four elements to save the world from the Fire Nation.',
    'storyline' => 'Aang travels with friends to learn bending and face destiny as he fights to bring balance to the world.',
    'trailer_embed_url' => 'https://www.youtube.com/embed/ByAn8DF8Ykk?si=POmLejslNS82bkdz'
  ],
  [
    'id' => 11,
    'title' => 'Game of Thrones',
    'poster' => 'asset/images/shows/game-of-thrones.jpg',
    'year' => '2011–2019',
    'rating' => '9.2',
    'seasons' => 8,
    'network' => 'HBO',
    'views' => 300000,
    'release_date' => '2011-04-17',
    'genre' => 'Action, Adventure, Drama',
    'director' => 'David Benioff, D. B. Weiss',
    'cast' => 'Emilia Clarke, Kit Harington, Peter Dinklage',
    'language' => 'English',
    'imdb_rating' => '8.7',
    'description' => 'Nine noble families vie for control over the lands of Westeros.',
    'storyline' => 'An epic struggle for the Iron Throne unfolds amid betrayal, dragons, and dark forces.',
    'trailer_embed_url' => 'https://www.youtube.com/embed/BpJYNVhGf1s'
  ],
  [
    'id' => 12,
    'title' => 'Sherlock',
    'poster' => 'asset/images/shows/sherlock.jpg',
    'year' => '2010–2017',
    'rating' => '9.1',
    'seasons' => 4,
    'network' => 'BBC',
    'views' => 130000,
    'release_date' => '2010-07-25',
    'genre' => 'Crime, Drama, Mystery',
    'director' => 'Steven Moffat, Mark Gatiss',
    'cast' => 'Benedict Cumberbatch, Martin Freeman',
    'language' => 'English',
    'imdb_rating' => '8.7',
    'description' => 'A modern update to the classic British detective stories.',
    'storyline' => 'Sherlock Holmes and Dr. Watson solve modern crimes in contemporary London.',
    'trailer_embed_url' => 'https://www.youtube.com/embed/xK7S9mrFWL4?si=KXTVI_TBOEMhUprP'
  ]
    ];

    public function index(Request $request)
    {
        $filter = $request->input('filter', 'latest');
        
        $shows = collect($this->dummyTVShows)
            ->map(fn($show) => (object) $show);

        // Apply filtering
        switch ($filter) {
            case 'rating':
                $shows = $shows->sortByDesc('imdb_rating');
                break;
            case 'latest':
                $shows = $shows->sortByDesc('release_date');
                break;
            case 'views':
                $shows = $shows->sortByDesc('views');
                break;
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 8;
        $paginatedShows = new LengthAwarePaginator(
            $shows->forPage($currentPage, $perPage),
            $shows->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('tv-shows', [
            'shows' => $paginatedShows,
            'activeFilter' => $filter
        ]);
    }

    public function show($id)
    {
        // Debug the incoming ID
        \Log::info('Requested TV Show ID: ' . $id);

        // Find the TV show
        $tvShow = collect($this->dummyTVShows)
            ->firstWhere('id', (int)$id);

        if (!$tvShow) {
            \Log::error('TV Show not found with ID: ' . $id);
            abort(404);
        }

        // Convert array to object and add required properties
        $tvShow = (object)$tvShow;
        $tvShow->comments = collect([]);
        $tvShow->ratings = collect([]);
        $tvShow->average_rating = 0;

        // Debug the TV show data
        \Log::info('TV Show data:', ['tvShow' => $tvShow]);

        return view('tv-show-detail', compact('tvShow'));
    }
    public function getDummyTVShows()
{
    return $this->dummyTVShows;
}
}