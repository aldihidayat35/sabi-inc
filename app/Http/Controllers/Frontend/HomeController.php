<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Work;
use App\Models\Topic;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Karya terbaik berdasarkan rating (minimal ada rating)
        $bestRatedWorks = Work::with(['categories', 'ratings', 'author'])
            ->where('status', 'Publish')
            ->withCount(['ratings as ratings_count' => function($q) {
                $q->whereNotNull('rating');
            }])
            ->withAvg('ratings as avg_rating', 'rating')
            ->having('ratings_count', '>', 0)
            ->orderByDesc('avg_rating')
            ->orderByDesc('ratings_count')
            ->take(5)
            ->get();

        $challenges2 = Challenge::whereDate('end_time', '>=', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        $latestWorks = Work::with(['categories', 'ratings'])->latest()->take(10)->get();
        $latestTopics = Topic::orderBy('created_at', 'desc')->take(10)->get();

        // Search works by title if search_work is present
        $searchWorks = null;
        if (request()->has('search_work') && trim(request('search_work')) !== '') {
            $searchWorks = Work::where('title', 'like', '%' . request('search_work') . '%')->take(10)->get();
        }

        // Trending works: top 5 by views
        $trendingWorks = Work::with(['categories', 'ratings', 'author'])
            ->where('status', 'Publish')
            ->orderByDesc('views')
            ->take(5)
            ->get();

        return view('frontend.home', compact(
            'challenges2',
            'bestRatedWorks',
            'latestWorks',
            'latestTopics',
            'searchWorks',
            'trendingWorks'
        ));
    }
}
