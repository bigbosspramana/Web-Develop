<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import model product
use App\Models\Book;
use App\Models\Journal;
use App\Models\CD;
use App\Models\Paper;
use App\Models\Skripsi;
use App\Models\Item;

//import return type View
use Illuminate\View\View;

class DatabaseController extends Controller
{
    /**
     * index
     *
     * @return void
     */

    public function index(Request $request)
    {
        $type = $request->input('type');

        switch ($type) {
            case 'book':
                $items = Book::paginate(10);
                break;
            case 'journal':
                $items = Journal::paginate(10);
                break;
            case 'cd':
                $items = CD::paginate(10);
                break;
            case 'newspaper':
                $items = Paper::paginate(10);
                break;
            case 'skripsi':
                $items = Skripsi::paginate(10);
                break;
            default:
                $items = Item::paginate(10); 
        }

        $sortOrder = $request->sort ?? 'asc'; 

        $query = Item::query();
        if ($type) {
            $query->where('type', $type);
        }
        
        // Cek apakah sortOrder kosong, jika ya, acak data dengan inRandomOrder()
        if (empty($sortOrder)) {
            $items = $query->inRandomOrder()->paginate(10);
        } else {
            $items = $query->orderBy('judul', $sortOrder)->paginate(10);
        }
        

        return view('index', compact('items', 'type', 'sortOrder'));
    }
}
