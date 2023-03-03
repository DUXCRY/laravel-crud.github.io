<?php

namespace App\Http\Controllers;


use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Access;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Gate::allows('isAdministrator')) {
            abort(403, "Halaman tidak dapat di Akses!");
        }

        $users = UserModel::all();
        return view('user/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAsOperator(Request $request, UserModel $user)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'email'         => 'required',
            'jabatan'       => 'required',
        ]);

        $user->nama             = $request->nama;
        $user->email            = $request->email;
        $user->jabatan          = $request->jabatan;
        $user->roles            = Auth::user()->roles;
        $user->save();

        return redirect()->back()->with('status', 'Data Berhasil Diubah.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserModel $user)
    {
        $this->validate($request, [
            'nama'       => 'required',
            'email'      => 'required',
            'jabatan'    => 'required',
            'roles'      => 'required'
        ]);

        if ($request->password == NULL) {
            $user->nama             = $request->nama;
            $user->email            = $request->email;
            $user->jabatan          = $request->jabatan;
            $user->roles            = $request->roles;
            $user->save();
        } else {
            $user->nama             = $request->nama;
            $user->email            = $request->email;
            $user->jabatan          = $request->jabatan;
            $user->roles            = $request->roles;
            $user->password         = bcrypt($request->password);
            $user->save();
        }

        return redirect()->back()->with('status', 'Data Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserModel $user)
    {
        $user->delete();
        return redirect('user')->with('status', 'Data Berhasil Dihapus.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profile(UserModel $user)
    {
        $user = Auth::user();
        return view('user/profile', compact('user'));
        //return view('user/index', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showChangePassword()
    {
        return view('user/change_password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success", "Password changed successfully !");
    }
}
