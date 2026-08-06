<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function edit(Request $request)
    {
        return view('admin.account.edit', ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($user->id)],
        ];

        // Password akun "User" ditentukan oleh Super Admin lewat Manajemen Akun,
        // jadi field ganti password di sini hanya berlaku untuk Super Admin.
        if ($user->isSuperAdmin()) {
            $rules['current_password'] = ['nullable', 'required_with:password', 'current_password'];
            $rules['password'] = ['nullable', 'confirmed', 'min:8'];
        }

        $data = $request->validate($rules);

        $user->name = $data['name'];

        if ($user->isSuperAdmin() && ! empty($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();

        return redirect()->route('admin.account.edit')->with('success', 'Akun berhasil diperbarui.');
    }
}
