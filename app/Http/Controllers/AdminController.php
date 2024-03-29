<?php

namespace App\Http\Controllers;

use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminLogin(Request $request)
    {
        $input = $request->all();

        $admin = Admin::where('username', $input['username'])->first();
        if ($admin) {
            if (Hash::check($input['password'], $admin->password)) {
                $request->session()->push('admin', $admin);

                return redirect('/admin/dashboard');
            }
        }

        return view('admin.login')->with('errors', ['Username or password is incorrect!']);
    }

    public function adminLogout()
    {
        session(['admin' => null]);
        return redirect('/admin/login');
    }
}

?>
