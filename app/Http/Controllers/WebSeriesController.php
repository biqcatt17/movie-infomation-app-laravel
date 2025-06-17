<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class WebSeriesController extends Controller
{
    protected $dummyWebSeries = [
        [
            'id' => 1,
            'title' => 'Money Heist',
            'poster' => 'asset/images/webseries/money-heist.jpg',
            'year' => '2017',
            'rating' => '8.2',
            'seasons' => 5,
            'platform' => 'Netflix',
            'views' => 125000,
            'release_date' => '2017-05-02',
            'genre' => 'Crime, Drama, Thriller',
            'creator' => 'Álex Pina',
            'cast' => 'Úrsula Corberó, Álvaro Morte, Itziar Ituño',
            'language' => 'Spanish',
            'description' => 'A criminal mastermind who goes by "The Professor" has a plan to pull off the biggest heist in recorded history -- to print billions of euros in the Royal Mint of Spain.',
            'storyline' => 'Eight thieves take hostages and lock themselves in the Royal Mint of Spain as a criminal mastermind manipulates the police to carry out his plan.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/ZAXA1DV4dtI'
        ],
        [
            'id' => 2,
            'title' => 'Sacred Games',
            'poster' => 'asset/images/webseries/sacred-games.jpg',
            'year' => '2018',
            'rating' => '8.5',
            'seasons' => 2,
            'platform' => 'Netflix',
            'views' => 90000,
            'release_date' => '2018-01-06',
            'genre' => 'Crime, Drama, Thriller',
            'creator' => 'Álex Pina',
            'cast' => 'Úrsula Corberó, Álvaro Morte, Itziar Ituño',
            'language' => 'Spanish',
            'description' => 'A criminal mastermind who goes by "The Professor" has a plan to pull off the biggest heist in recorded history -- to print billions of euros in the Royal Mint of Spain.',
            'storyline' => 'Eight thieves take hostages and lock themselves in the Royal Mint of Spain as a criminal mastermind manipulates the police to carry out his plan.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/AkUgf2jIPyI?si=rWOnkHd2VVe6F1hF'
        ],
        [
            'id' => 3,
            'title' => 'Mirzapur',
            'poster' => 'asset/images/webseries/mirzapur.jpg',
            'year' => '2018',
            'rating' => '8.4',
            'seasons' => 2,
            'platform' => 'Prime Video',
            'views' => 75000,
            'release_date' => '2018-11-16',
            'genre' => 'Crime, Drama, Thriller',
            'creator' => 'Álex Pina',
            'cast' => 'Úrsula Corberó, Álvaro Morte, Itziar Ituño',
            'language' => 'Spanish',
            'description' => 'A criminal mastermind who goes by "The Professor" has a plan to pull off the biggest heist in recorded history -- to print billions of euros in the Royal Mint of Spain.',
            'storyline' => 'Eight thieves take hostages and lock themselves in the Royal Mint of Spain as a criminal mastermind manipulates the police to carry out his plan.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/33o3s4Vs4Sw?si=MPGwsaSaL-qgpF6F'
        ],
        [
            'id' => 4,
            'title' => 'Stranger Things',
            'poster' => 'asset/images/webseries/stranger-things.jpg',
            'year' => '2016',
            'rating' => '8.8',
            'seasons' => 3,
            'platform' => 'Netflix',
            'views' => 200000,
            'release_date' => '2016-07-15',
            'genre' => 'Drama, Fantasy, Horror',
            'creator' => 'The Duffer Brothers',
            'cast' => 'Winona Ryder, David Harbour, Finn Wolfhard',
            'language' => 'English',
            'description' => 'When a',
            'storyline' => 'When a young',
            'trailer_embed_url' => 'https://www.youtube.com/embed/QlYrNC_1Xmk?si=ozGQAC0DVpXhGT89'
        ],
    [
        'id' => 5,
        'title' => 'The Crown',
        'poster' => 'asset/images/webseries/the-crown.jpg',
        'year' => '2016',
        'rating' => '8.6',
        'seasons' => 4,
        'platform' => 'Netflix',
        'views' => 95000,
        'release_date' => '2016-11-04',
        'genre' => 'Biography, Drama, History',
        'creator' => 'Peter Morgan',
        'cast' => 'Olivia Colman, Imelda Staunton, Claire Foy',
        'language' => 'English',
        'description' => 'Follows the political rivalries and romance of Queen Elizabeth II\'s reign and the events that shaped the second half of the 20th century.',
        'storyline' => 'A historical drama about the reign of Queen Elizabeth II of the United Kingdom.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/JWtnJjn6ng0'
    ],
    [
        'id' => 6,
        'title' => 'The Mandalorian',
        'poster' => 'asset/images/webseries/the-mandalorian.jpg',
        'year' => '2019',
        'rating' => '8.8',
        'seasons' => 3,
        'platform' => 'Disney+',
        'views' => 180000,
        'release_date' => '2019-11-12',
        'genre' => 'Action, Adventure, Sci-Fi',
        'creator' => 'Jon Favreau',
        'cast' => 'Pedro Pascal, Carl Weathers, Gina Carano',
        'language' => 'English',
        'description' => 'The travels of a lone bounty hunter in the outer reaches of the galaxy, far from the authority of the New Republic.',
        'storyline' => 'A bounty hunter protects a mysterious alien child in the Star Wars universe.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/eW7Twd85m2g'
    ],
    [
        'id' => 7,
        'title' => 'The Boys',
        'poster' => 'asset/images/webseries/the-boys.jpg',
        'year' => '2019',
        'rating' => '8.7',
        'seasons' => 4,
        'platform' => 'Prime Video',
        'views' => 110000,
        'release_date' => '2019-07-26',
        'genre' => 'Action, Comedy, Crime',
        'creator' => 'Eric Kripke',
        'cast' => 'Karl Urban, Jack Quaid, Antony Starr',
        'language' => 'English',
        'description' => 'A group of vigilantes set out to take down corrupt superheroes who abuse their superpowers.',
        'storyline' => 'Vigilantes fight against superpowered individuals who abuse their abilities.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/M1bhOaLV4FU?si=ijXq18mSeGJa3mtf'
    ],
    [
        'id' => 8,
        'title' => 'Squid Game',
        'poster' => 'asset/images/webseries/squid-game.jpg',
        'year' => '2021',
        'rating' => '8.0',
        'seasons' => 1,
        'platform' => 'Netflix',
        'views' => 250000,
        'release_date' => '2021-09-17',
        'genre' => 'Action, Drama, Mystery',
        'creator' => 'Hwang Dong-hyuk',
        'cast' => 'Lee Jung-jae, Park Hae-soo, Wi Ha-joon',
        'language' => 'Korean',
        'description' => 'Hundreds of cash-strapped contestants accept an invitation to compete in children\'s games for a tempting prize.',
        'storyline' => 'Desperate contestants play deadly children\'s games for a massive cash prize.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/oqxAJKy0ii4'
    ],
    [
        'id' => 9,
        'title' => 'Breaking Bad',
        'poster' => 'asset/images/webseries/breaking-bad.jpg',
        'year' => '2008',
        'rating' => '9.5',
        'seasons' => 5,
        'platform' => 'Netflix',
        'views' => 195000,
        'release_date' => '2008-01-20',
        'genre' => 'Crime, Drama, Thriller',
        'creator' => 'Vince Gilligan',
        'cast' => 'Bryan Cranston, Aaron Paul, Anna Gunn',
        'language' => 'English',
        'description' => 'A chemistry teacher diagnosed with cancer turns to manufacturing drugs to secure his family\'s future.',
        'storyline' => 'A high school chemistry teacher becomes a ruthless drug lord.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/HhesaQXLuRY'
    ],
    [
        'id' => 10,
        'title' => 'The Witcher',
        'poster' => 'asset/images/webseries/the-witcher.jpg',
        'year' => '2019',
        'rating' => '8.2',
        'seasons' => 3,
        'platform' => 'Netflix',
        'views' => 120000,
        'release_date' => '2019-12-20',
        'genre' => 'Action, Adventure, Fantasy',
        'creator' => 'Lauren Schmidt Hissrich',
        'cast' => 'Henry Cavill, Freya Allan, Anya Chalotra',
        'language' => 'English',
        'description' => 'Geralt of Rivia, a mutated monster-hunter for hire, journeys toward his destiny in a turbulent world.',
        'storyline' => 'A solitary monster hunter struggles to find his place in a world where people often prove more wicked than beasts.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/ndl1W4ltcmg'
    ],
    [
        'id' => 11,
        'title' => 'Chernobyl',
        'poster' => 'asset/images/webseries/chernobyl.jpg',
        'year' => '2019',
        'rating' => '9.4',
        'seasons' => 1,
        'platform' => 'HBO Max',
        'views' => 85000,
        'release_date' => '2019-05-06',
        'genre' => 'Drama, History, Thriller',
        'creator' => 'Craig Mazin',
        'cast' => 'Jared Harris, Stellan Skarsgård, Emily Watson',
        'language' => 'English',
        'description' => 'In April 1986, the Chernobyl Nuclear Power Plant in Ukraine explodes, creating the worst nuclear disaster in history.',
        'storyline' => 'The true story of one of the worst man-made catastrophes in history.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/s9APLXM9Ei8'
    ],
    [
        'id' => 12,
        'title' => 'Loki',
        'poster' => 'asset/images/webseries/loki.jpg',
        'year' => '2021',
        'rating' => '8.2',
        'seasons' => 2,
        'platform' => 'Disney+',
        'views' => 150000,
        'release_date' => '2021-06-09',
        'genre' => 'Action, Adventure, Fantasy',
        'creator' => 'Michael Waldron',
        'cast' => 'Tom Hiddleston, Owen Wilson, Sophia Di Martino',
        'language' => 'English',
        'description' => 'The mercurial villain Loki resumes his role as the God of Mischief in a new series that takes place after the events of Avengers: Endgame.',
        'storyline' => 'Loki navigates the multiverse after escaping with the Tesseract.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/nW948Va-l10'
    ],
    [
        'id' => 13,
        'title' => 'The Office (US)',
        'poster' => 'asset/images/webseries/the-office-us.jpg',
        'year' => '2005',
        'rating' => '8.9',
        'seasons' => 9,
        'platform' => 'Prime Video',
        'views' => 300000,
        'release_date' => '2005-03-24',
        'genre' => 'Comedy',
        'creator' => 'Greg Daniels',
        'cast' => 'Steve Carell, Jenna Fischer, John Krasinski',
        'language' => 'English',
        'description' => 'A mockumentary on a group of typical office workers, where the workday consists of ego clashes, inappropriate behavior, and tedium.',
        'storyline' => 'Everyday lives of employees at Dunder Mifflin Paper Company.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/LHOtME2DL4g'
    ],
    [
        'id' => 14,
        'title' => 'Dark',
        'poster' => 'asset/images/webseries/dark.jpg',
        'year' => '2017',
        'rating' => '8.8',
        'seasons' => 3,
        'platform' => 'Netflix',
        'views' => 88000,
        'release_date' => '2017-12-01',
        'genre' => 'Crime, Drama, Mystery',
        'creator' => 'Baran bo Odar, Jantje Friese',
        'cast' => 'Louis Hofmann, Karoline Eichhorn, Lisa Vicari',
        'language' => 'German',
        'description' => 'A family saga with a supernatural twist, set in a German town where the disappearance of two young children exposes the relationships among four families.',
        'storyline' => 'Time travel mystery spanning multiple generations in a small German town.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/ESEUoa-mz2c'
    ],
    [
        'id' => 15,
        'title' => 'The Umbrella Academy',
        'poster' => 'asset/images/webseries/umbrella-academy.jpg',
        'year' => '2019',
        'rating' => '8.0',
        'seasons' => 3,
        'platform' => 'Netflix',
        'views' => 105000,
        'release_date' => '2019-02-15',
        'genre' => 'Action, Adventure, Comedy',
        'creator' => 'Steve Blackman',
        'cast' => 'Elliot Page, Tom Hopper, David Castañeda',
        'language' => 'English',
        'description' => 'A family of former child heroes, now grown apart, must reunite to continue to solve the mystery of their father\'s death and the threat of the apocalypse.',
        'storyline' => 'Dysfunctional family of superheroes works to prevent the apocalypse.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/0DAmWHxeoKw'
    ],
    [
        'id' => 16,
        'title' => 'The Expanse',
        'poster' => 'asset/images/webseries/the-expanse.jpg',
        'year' => '2015',
        'rating' => '8.5',
        'seasons' => 6,
        'platform' => 'Prime Video',
        'views' => 78000,
        'release_date' => '2015-12-14',
        'genre' => 'Adventure, Drama, Sci-Fi',
        'creator' => 'Mark Fergus, Hawk Ostby',
        'cast' => 'Steven Strait, Dominique Tipper, Wes Chatham',
        'language' => 'English',
        'description' => 'In the 24th century, a detective and a rogue ship\'s captain come together for what starts as the case of a missing young woman.',
        'storyline' => 'Humanity has colonized the solar system amidst political tensions.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/kQuTAPWJxNo'
    ],
    [
        'id' => 17,
        'title' => 'Peaky Blinders',
        'poster' => 'asset/images/webseries/peaky-blinders.jpg',
        'year' => '2013',
        'rating' => '8.8',
        'seasons' => 6,
        'platform' => 'Netflix',
        'views' => 95000,
        'release_date' => '2013-09-12',
        'genre' => 'Crime, Drama',
        'creator' => 'Steven Knight',
        'cast' => 'Cillian Murphy, Paul Anderson, Helen McCrory',
        'language' => 'English',
        'description' => 'A gangster family epic set in 1919 Birmingham, England and centered on a gang who sew razor blades in the peaks of their caps.',
        'storyline' => 'Rise of the Shelby crime family in post-WWI Birmingham.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/oVzVdvGIC7U'
    ],
    [
        'id' => 18,
        'title' => 'The Handmaid\'s Tale',
        'poster' => 'asset/images/webseries/handmaids-tale.jpg',
        'year' => '2017',
        'rating' => '8.4',
        'seasons' => 5,
        'platform' => 'Hulu',
        'views' => 115000,
        'release_date' => '2017-04-26',
        'genre' => 'Drama, Sci-Fi, Thriller',
        'creator' => 'Bruce Miller',
        'cast' => 'Elisabeth Moss, Yvonne Strahovski, Joseph Fiennes',
        'language' => 'English',
        'description' => 'Set in a dystopian future, a woman is forced to live as a concubine under a fundamentalist theocratic dictatorship.',
        'storyline' => 'Life in the totalitarian society of Gilead where women are subjugated.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/PJTonrzXTJs'
    ],
    [
        'id' => 19,
        'title' => 'Wednesday',
        'poster' => 'asset/images/webseries/wednesday.jpg',
        'year' => '2022',
        'rating' => '8.2',
        'seasons' => 1,
        'platform' => 'Netflix',
        'views' => 210000,
        'release_date' => '2022-11-23',
        'genre' => 'Comedy, Crime, Fantasy',
        'creator' => 'Alfred Gough, Miles Millar',
        'cast' => 'Jenna Ortega, Gwendoline Christie, Riki Lindhome',
        'language' => 'English',
        'description' => 'Follows Wednesday Addams as she investigates a murder spree while attending Nevermore Academy.',
        'storyline' => 'Wednesday Addams navigates supernatural mysteries at her new school.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/Di310WS8zLk'
    ],
    [
        'id' => 20,
        'title' => 'House of Cards',
        'poster' => 'asset/images/webseries/house-of-cards.jpg',
        'year' => '2013',
        'rating' => '8.7',
        'seasons' => 6,
        'platform' => 'Netflix',
        'views' => 135000,
        'release_date' => '2013-02-01',
        'genre' => 'Drama',
        'creator' => 'Beau Willimon',
        'cast' => 'Kevin Spacey, Robin Wright, Michael Kelly',
        'language' => 'English',
        'description' => 'A Congressman works with his equally conniving wife to exact revenge on the people who betrayed him.',
        'storyline' => 'Ruthless politician Frank Underwood climbs the ranks in Washington D.C.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/8QnMmpfKWvo'
    ],
    [
        'id' => 21,
        'title' => 'The Marvelous Mrs. Maisel',
        'poster' => 'asset/images/webseries/mrs-maisel.jpg',
        'year' => '2017',
        'rating' => '8.7',
        'seasons' => 4,
        'platform' => 'Prime Video',
        'views' => 88000,
        'release_date' => '2017-03-17',
        'genre' => 'Comedy, Drama',
        'creator' => 'Amy Sherman-Palladino',
        'cast' => 'Rachel Brosnahan, Alex Borstein, Michael Zegen',
        'language' => 'English',
        'description' => 'A housewife discovers she has a knack for stand-up comedy in the 1950s.',
        'storyline' => 'A 1950s housewife turns her life upside down by pursuing stand-up comedy.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/5iWaLQa_Hvk'
    ],
    [
        'id' => 22,
        'title' => 'Narcos',
        'poster' => 'asset/images/webseries/narcos.jpg',
        'year' => '2015',
        'rating' => '8.8',
        'seasons' => 3,
        'platform' => 'Netflix',
        'views' => 115000,
        'release_date' => '2015-08-28',
        'genre' => 'Biography, Crime, Drama',
        'creator' => 'Carlo Bernard, Chris Brancato',
        'cast' => 'Wagner Moura, Pedro Pascal, Boyd Holbrook',
        'language' => 'Spanish, English',
        'description' => 'A chronicled look at the criminal exploits of Colombian drug lord Pablo Escobar.',
        'storyline' => 'Rise and fall of notorious drug kingpin Pablo Escobar.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/xl8zdCY-abw'
    ],
    [
        'id' => 23,
        'title' => 'The Queen\'s Gambit',
        'poster' => 'asset/images/webseries/queens-gambit.jpg',
        'year' => '2020',
        'rating' => '8.6',
        'seasons' => 1,
        'platform' => 'Netflix',
        'views' => 185000,
        'release_date' => '2020-10-23',
        'genre' => 'Drama',
        'creator' => 'Scott Frank',
        'cast' => 'Anya Taylor-Joy, Bill Camp, Thomas Brodie-Sangster',
        'language' => 'English',
        'description' => 'Orphaned chess prodigy struggles with addiction while mastering the game of chess.',
        'storyline' => 'A young female chess prodigy battles personal demons in the 1950s-60s.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/oZn3qSgmLqI?si=5mFvt4qKSVwmO8f-'
    ],
    [
        'id' => 24,
        'title' => 'The Last of Us',
        'poster' => 'asset/images/webseries/the-last-of-us.jpg',
        'year' => '2023',
        'rating' => '9.1',
        'seasons' => 1,
        'platform' => 'HBO Max',
        'views' => 165000,
        'release_date' => '2023-01-15',
        'genre' => 'Action, Adventure, Drama',
        'creator' => 'Craig Mazin, Neil Druckmann',
        'cast' => 'Pedro Pascal, Bella Ramsey, Gabriel Luna',
        'language' => 'English',
        'description' => 'After a global pandemic destroys civilization, a hardened survivor takes charge of a 14-year-old girl who may be humanity\'s last hope.',
        'storyline' => 'A smuggler escorts a teenager across post-apocalyptic America.',
        'trailer_embed_url' => 'https://www.youtube.com/embed/uLtkt8BonwM'
    ]
    ];
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'latest');
        
        $series = collect($this->dummyWebSeries);

        // Apply filtering
        switch ($filter) {
            case 'rating':
                $series = $series->sortByDesc('rating');
                break;
            case 'views':
                $series = $series->sortByDesc('views');
                break;
            default:
                $series = $series->sortByDesc('release_date');
                break;
        }

        $series = $series->map(fn($show) => (object) $show);

        // Add pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 8;
        $paginatedSeries = new LengthAwarePaginator(
            $series->forPage($currentPage, $perPage),
            $series->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('web-series', [
            'series' => $paginatedSeries,
            'activeFilter' => $filter
        ]);
    }

    public function show($id)
    {
        $series = collect($this->dummyWebSeries)
            ->firstWhere('id', (int) $id);

        if (!$series) {
            abort(404);
        }

        // Convert array to object including nested arrays
        $seriesObject = json_decode(json_encode($series));

        // Get suggested series (excluding current one)
        $suggestedSeries = collect($this->dummyWebSeries)
            ->filter(function ($item) use ($id) {
                return $item['id'] != $id;
            })
            ->take(4)
            ->map(function($series) {
                return json_decode(json_encode($series));
            });

        return view('web-series-detail', [
            'series' => $seriesObject,
            'suggestedSeries' => $suggestedSeries
        ]);
    }

   public function getDummyWebSeries()
{
    return $this->dummyWebSeries;
}
}
