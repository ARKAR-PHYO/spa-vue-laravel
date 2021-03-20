<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addTag(Request $request, Tag $tag)
    {
        return $tag->create($request->all());
    }

    public function getTags(Tag $tag)
    {
        return $tag->orderBy('id', 'desc')->get();
    }

    public function editTag(Request $request, Tag $tag)
    {
        return $tag->where('id', $request->id)->update($request->all());
    }

    public function deleteTag(Request $request, Tag $tag)
    {
        return $tag->where('id', $request->id)->delete();
    }


}
