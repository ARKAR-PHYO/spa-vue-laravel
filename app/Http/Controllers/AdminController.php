<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // TAGS
    public function getTags(Tag $tag)
    {
        return $tag->orderBy('id', 'desc')->get();
    }

    public function addTag(Request $request, Tag $tag)
    {
        return $tag->create($request->validate([
            'tagName' => 'required'
        ]));
    }

    public function editTag(Request $request, Tag $tag)
    {
        return $tag->where('id', $request->id)->update($request->validate([
            'tagName' => 'required',
            'id' => 'required'
        ]));
    }

    public function deleteTag(Request $request, Tag $tag)
    {
        return $tag->where('id', $request->id)->delete($request->validate(['id' => 'required']));
    }
    // TAG END

    // IMAGE UPLOAD CATEGORY
    public function upload(Request $request)
    {
        $request->validate(['file' => 'required|mimes:jpeg,jpg,png']);
        $picName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $picName);
        return $picName;
    }

    // DELETE IMAGE
    public function deleteImage(Request $request)
    {
        $fileName = $request->imageName;
        $this->deleteFileFromServer($fileName);
        return 'done';
    }

    public function deleteFileFromServer($fileName)
    {
        $filePath = public_path().'/uploads'. $fileName;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        return 'done';
    }

    public function createCategory(Request $request, Category $category)
    {
        return $category->create($request->validate([
            'categoryName' => 'required',
            'iconImage' => 'required'
        ]));
    }

    public function getCategories(Category $category)
    {
        return $category->orderBy('id', 'desc')->get();
    }

    public function editCategory(Request $request, Category $category)
    {
        return $category->where('id', $request->id)->update($request->validate([
            'categoryName' => 'required',
            'iconImage' => 'required',
        ]));
    }
}
