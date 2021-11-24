<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(string $projectDomain): JsonResponse
    {
        $pages = \Cache::remember("projects:$projectDomain:pages", 36000, function () use ($projectDomain){
            return Project::where('domain', $projectDomain)->first()
                ->pages()
                ->where('active', 1)
                ->get();
            });
        return response()->json($pages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function show(string $slug): JsonResponse
    {
        $lp = \Cache::remember("pages:$slug", 3600, function () use ($slug) {
            return LandingPage::where('slug', $slug)->first();
        });
        return response()->json($lp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     */
    public function update(Request $request, int $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(int $id): void
    {
        //
    }
}
