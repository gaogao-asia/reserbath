<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReserveTimeOptionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Notifications\ReservationStore;
use App\Notifications\ReservationUpdate;

use App\Category;
use App\Post;

/**
 * House Documentコントローラー
 * Class ReservationsController
 * @package App\Http\Controllers\Www
 */
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all();
        $categories->load('posts');

        return response()->json(['categories' => $categories]);
    }
}
