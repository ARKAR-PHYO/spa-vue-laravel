<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateAdminUserRequest;

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
        $this->deleteFileFromServer($fileName, false);
        return 'done';
    }

    public function deleteFileFromServer($fileName, $hasFullPath = false)
    {
        if (!$hasFullPath) {
            $filePath = public_path().'/uploads'. $fileName;
        }
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
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

    public function deleteCategory(Request $request, Category $category)
    {
        // first delete the original file from the server
        $this->deleteFileFromServer($request->iconImage);
        return $category->where('id', $request->id)->delete($request->validate(['id' => 'required']));
    }

    public function getAdminUsers(User $user)
    {
        return $user->orderBy('id', 'desc')->get();
    }

    public function createAdminUser(CreateAdminUserRequest $request)
    {
        return User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'userType' => $request->userType
        ]);
    }

    // public function createAdminUser(Request $request)
    // {
    //     $this->validate($request, [
    //         'fullName' => 'required',
    //         'email' => 'bail|required',
    //         'password' => 'bail|required|min:6',
    //         'userType' => 'required',
    //     ]);

    //     return User::create([
    //         'fullName' => $request->fullName,
    //         'email' => $request->email,
    //         'userType' => $request->userType,
    //         'password' => Hash::make($request->password),
    //     ]);
    // }

}
