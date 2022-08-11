<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function register_form()
    {
        return view('register');
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'username' => ['required', 'min:6'],
            // 'password' => ['required', 'min:6'],
            'password' => ['min:6', 'required_with:password_confirmation', 'same:password_confirmation'],
            'password_confirmation' => ['min:6'],
        ]);

        $created = Users::create([
            "username" => $request->username,
            "password" => bcrypt($request->password),
        ]);

        if ($created) {
            return to_route('login_form')
            ->with('flash_message', 'Successfully, Creata New Account')
            ->with('flash_type', 'alert-success alert-dismissible fade show'); 
        } else {
            return redirect()->back()
            ->with('flash_message', 'Admin Account Failed To Create')
            ->with('flash_type', 'alert-danger alert-dismissible fade show');
        }
    }

    public function login_form()
    {
        return view('login');
    }

    public function login_action(Request $request)
    {
        $users = Users::where('username', $request->username)->first();

        if ($users == null) {
            return redirect()->back()
            ->with('flash_message', 'Username Not Found')
            ->with('flash_type', 'alert-danger alert-dismissible fade show');
        }

        $db_password = $users->password;
        $hashed_password = Hash::check($request->password, $db_password);

        if ($hashed_password) {
            $users->token = Str::random(20);
            $users->save();
            $request->session()->put('token', $users->token);
            $request->session()->put('username', $users->username);
            return to_route('dashboard_index');
        } else {
            return redirect()->back()
            ->with('flash_message', 'Sorry, your data Doesn`t Match')
            ->with('flash_type', 'alert-danger alert-dismissible fade show');
        }
    }

    public function dashboard_index()
    {
        if (Session::has('token')) {
            $users = Users::where('token', Session::get('token'))->first();
            $total_users = Users::count();
            $articles = Articles::paginate(10);

            return view('Dashboard/index', [
                "title" => "DASHBOARD",
                "users" => $users,
                "articles" => $articles,
                "total_users" => $total_users,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function dashboard_logout(Request $request)
    {
        Users::where('token', $request->token)->update([
            'token' => NULL
        ]);

        Session::pull('token');
        return to_route('login_form');
    }

    public function article_delete_action(Request $request)
    {
        Articles::find($request->id)->delete();
        return redirect()->back()
            ->with('flash_message', 'Article Successfully Deleted!')
            ->with('flash_type', 'alert-info alert-dismissible fade show');
    }

    public function article_add_action(Request $request)
    {

        $request->validate([
            'title' => ['required', 'max:255', 'min:10'],
            'description' => ['required'],
            'tag' => ['nullable'],
        ]);

        $created = Articles::create([
            "title" => $request->title,
            "description" => $request->description,
            "tag" => $request->tag,
        ]);

        if ($created) {
            return redirect()->back()
            ->with('flash_message', 'New Article Successfully Created')
            ->with('flash_type', 'alert-success alert-dismissible fade show');
        } else {
            return redirect()->back()
            ->with('flash_message', 'New Article Failed To Create')
            ->with('flash_type', 'alert-danger alert-dismissible fade show');
        }
    }

    public function article_edit_action($id)
    {
        return view('Dashboard/edit_form', [
            'title' => 'Artikel ' . $id,
            'article' => Articles::find($id)
        ]);
    }

    public function article_update_action(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255', 'min:10'],
            'description' => ['required'],
            'tag' => ['nullable'],
        ]);

        $ubah = Articles::find($request->id)->update([
            "title" => $request->title,
            "description" => $request->description,
            "tag" => $request->tag,
        ]);

        if ($ubah) {
            return redirect()->route('dashboard_index')
            ->with('flash_message', 'Article Modified Successfully')
            ->with('flash_type', 'alert-success alert-dismissible fade show');
        } else {
            return redirect()->route('dashboard_index')
            ->with('flash_message', 'Article Failed To Change')
            ->with('flash_type', 'alert-danger alert-dismissible fade show');
        }
    }
}