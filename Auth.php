<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login', ['title' => 'Login']);
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Username and password are required.');
        }

        $user = (new UserModel())
            ->where('username', trim((string) $this->request->getPost('username')))
            ->first();

        if (! $user || ! password_verify((string) $this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        session()->regenerate(true);
        session()->set([
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/dashboard');
    }

    public function dashboard()
    {
        return view('auth/dashboard', [
            'title'    => 'Dashboard',
            'username' => session()->get('username'),
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('message', 'You have been logged out.');
    }
}
