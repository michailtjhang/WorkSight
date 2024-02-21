<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogBookRequest;
use App\Models\LogBook;
use Illuminate\Http\Request;

class LogBookController extends Controller
{
    public function index()
    {
        return view('logbook');
    }

    public function logbookList(request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));

        $logbook = LogBook::where('date', '>=', $start)->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'date' => $item->date,
                'description' => $item->description,
                'status' => $item->status
            ]);

        return response()->json($logbook);
    }

    public function create(LogBook $logBook)
    {
        return view('logbook-form', ['data' => $logBook, 'action' => route('logbook.store')]);
    }

    public function store(LogBookRequest $request, LogBook $logBook)
    {
        $logBook->date = $request->date;
        $logBook->title = $request->title;
        $logBook->description = $request->description;

        $logBook->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Logbook saved successfully',
        ]);
    }

    public function show(LogBook $logBook)
    {
        // 
    }

    public function edit(LogBook $logBook)
    {
        // 
    }

    public function update(Request $request, LogBook $logBook)
    {
        //
    }

    public function destroy(LogBook $logBook)
    {
        //
    }
}
