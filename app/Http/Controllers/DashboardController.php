<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Work;
use App\Models\Challenge;
use App\Models\Material;
use App\Models\WorkComment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{ private function authorizeAdmin()
    {
        if (!Auth::guard('teacher')->check()) {
            abort(redirect()->route('teacher.login')->withErrors(['message' => 'Please login first.']));
        }

    }
    public function index(Request $request)
    {
        $this->authorizeAdmin();
        // Statistik utama
        $totalStudents = Student::count();
        $totalWorks = Work::count();
        $totalChallenges = Challenge::count();
        $totalMaterials = Material::count();

        // Grafik views karya (minat membaca)
        // Harian dalam sebulan (30 hari terakhir)
        $viewsDaily = Work::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(views) as total_views')
            )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Bulanan dalam setahun (12 bulan terakhir)
        $viewsMonthly = Work::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(views) as total_views')
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year')->orderBy('month')
            ->get();

        // Tahunan dalam 10 tahun terakhir
        $viewsYearly = Work::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(views) as total_views')
            )
            ->where('created_at', '>=', now()->subYears(10))
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        // Grafik total karya (minat menulis)
        // Harian dalam sebulan
        $worksDaily = Work::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total_works')
            )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Bulanan dalam setahun
        $worksMonthly = Work::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total_works')
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year')->orderBy('month')
            ->get()
            ->map(function($item) {
                return [
                    'year' => $item->year,
                    'month' => str_pad($item->month, 2, '0', STR_PAD_LEFT),
                    'total_works' => $item->total_works
                ];
            })
            ->toArray();

        // Tahunan dalam 10 tahun
        $worksYearly = Work::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as total_works')
            )
            ->where('created_at', '>=', now()->subYears(10))
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        // 5 karya terbaik berdasarkan views, like, favorit
        $topWorks = Work::withCount([
                'favorites',
                'ratings as likes_count' => function($q) {
                    $q->where('type', 'like');
                }
            ])
            ->orderByDesc(DB::raw('views + likes_count + favorites_count'))
            ->take(5)
            ->get();

        // Pie chart kolaborasi student berdasarkan komentar
        $totalComments = WorkComment::count();
        $collab = WorkComment::select('student_id', DB::raw('COUNT(*) as total'))
            ->groupBy('student_id')
            ->get();
        $collabPie = [];
        foreach ($collab as $c) {
            $student = $c->student_id ? Student::find($c->student_id) : null;
            $collabPie[] = [
                'label' => $student ? $student->nama : 'Unknown',
                'value' => $totalComments > 0 ? round($c->total / $totalComments * 100, 2) : 0,
            ];
        }

        // Top 10 students with most works
        $topStudents = \App\Models\Student::withCount('works')
            ->orderByDesc('works_count')
            ->take(10)
            ->get();

        // Ambil semua kategori beserta karya teratas berdasarkan like
        $categories = Category::all();
        $categoryWorks = [];
        foreach ($categories as $category) {
            $works = $category->works()
                ->with('author')
                ->withCount([
                    'ratings as likes_count' => function($q) {
                        $q->where('type', 'like');
                    }
                ])
                ->orderByDesc('likes_count')
                ->take(5)
                ->get();
            $categoryWorks[$category->id] = $works;
        }

        return view('dashboard', compact(
            'totalStudents',
            'totalWorks',
            'totalChallenges',
            'totalMaterials',
            'viewsDaily',
            'viewsMonthly',
            'viewsYearly',
            'worksDaily',
            'worksMonthly',
            'worksYearly',
            'topWorks',
            'collabPie',
            'topStudents',
            'categories',
            'categoryWorks'
        ));
    }
}
