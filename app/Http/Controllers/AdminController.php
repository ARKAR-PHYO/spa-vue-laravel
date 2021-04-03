<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthCheckRequest;
use App\Http\Requests\CreateAdminUserRequest;

class AdminController extends Controller
{
    // AUTHENTICATION
    public function index(AuthCheckRequest $request)
    {

        return $request->isAuthenticate();
    }

    public function adminUserLogin(LoginRequest $request)
    {
        return $request->loginCheck();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    // AUTHENTICATION END

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
    // TAGS END

    // IMAGE UPLOAD CATEGORY
    public function upload(Request $request)
    {
        $request->validate(['file' => 'required|mimes:jpeg,jpg,png']);
        $picName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $picName);
        return $picName;
    }

    public function deleteImage(Request $request)
    {
        $fileName = $request->imageName;
        $this->deleteFileFromServer($fileName, false);
        return 'done';
    }

    public function deleteFileFromServer($fileName, $hasFullPath = false)
    {
        if (!$hasFullPath) {
            $filePath = public_path() . '/uploads' . $fileName;
        }
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }
    // IMAGE UPLOAD CATEGORY END

    // CATEGORIES
    public function getCategories(Category $category)
    {
        return $category->orderBy('id', 'desc')->get();
    }

    public function createCategory(Request $request, Category $category)
    {
        return $category->create($request->validate([
            'categoryName' => 'required',
            'iconImage' => 'required'
        ]));
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
    // CATEGORIES ENDS

    // ADMIN USER
    public function getAdminUsers(User $user)
    {
        // return $user->orderBy('id', 'desc')->get();
        // return $user->orderBy('id', 'desc')->where('userType', '!=', 'User')->get();
        return $user->orderBy('id', 'desc')->get();
    }

    public function createAdminUser(Request $request, User $user)
    {
        // validate request
        $this->validate($request, [
            'fullName' => 'required',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
            'role_id' => 'required',
        ]);
        return $user->create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);
    }

    public function editAdminUser(Request $request, User $user)
    {
        // validate request
        $this->validate($request, [
            'fullName' => 'required',
            'email' => "bail|required|email|unique:users,email,$request->id",
            'password' => 'min:6',
            'role_id' => 'required',
        ]);
        $data = [
            'fullName' => $request->fullName,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];
        if ($request->password) {
            $password = Hash::make($request->password);
            $data['password'] = $password;
        }
        $user = User::where('id', $request->id)->update($data);
        return $user;
    }
    // ADMIN USER ENDS

    // ROLE
    public function getRoles(Role $role)
    {
        return $role->get();
    }

    public function createRole(Request $request, Role $role)
    {
        return $role->create($request->validate([
            'roleName' => 'required'
        ]));
    }

    public function editRole(Request $request, Role $role)
    {
        return $role->where('id', $request->id)->update($request->validate([
            'roleName' => 'required',
            'id' => 'required'
        ]));
    }

    public function deleteRole(Request $request, Role $role)
    {
        return $role->where('id', $request->id)->delete($request->validate(['id' => 'required']));
    }

    public function assignRoles(Request $request, Role $role)
    {
        return $role->where('id', $request->id)->update($request->validate([
            'permission' => 'required',
            'id' => 'required'
        ]));
    }
    // ROLE ENDS

    // EDITOR
    public function uploadEditorImage(Request $request)
    {
        $request->validate(['image' => 'required|mimes:jpeg,jpg,png']);
        $picName = time() . '.' . $request->file->extension();
        $request->image->move(public_path('uploads'), $picName);
        return $picName;
    }
    // EDITOR ENDS
}
