<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Comments::class,
            ['Comment'],
            ['IdUser', 'IdReplyComment', 'IdCourse', 'IdLesson', 'IdMeet', 'Active'],
            ['Date']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Comments::create($data);
        return response()->json($item, 201);
    }

    public function show($comments)
    {
        $item = Comments::findOrFail($comments);
        return response()->json($item);
    }

    public function update(Request $request, $comments)
    {
        $item = Comments::findOrFail($comments);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($comments)
    {
        $item = Comments::findOrFail($comments);
        $item->delete();
        return response()->json(null, 204);
    }
}
