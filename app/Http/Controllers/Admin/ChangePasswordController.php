<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\RedirectResponse;

class ChangePasswordController extends AdminController
{
    /**
     * @return View
     */
    public function edit() : View
    {
        return view('auth.passwords.edit');
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return RedirectResponse
     */
    public function update(UpdatePasswordRequest $request)
    {
        $validData = $request->validated();

        /** @var User $user */
        $user = auth()->user();
        $user->password = Hash::make($validData['password']);
        $user->email = $validData['email'];
        $user->save();

        return redirect()
            ->route('admin.password.edit')
            ->with('message', __('global.change_password_success'));
    }
}
