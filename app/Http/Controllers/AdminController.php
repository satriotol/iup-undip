<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('permission:admin-index|admin-create|admin-edit|admin-delete', ['only' => ['index', 'show']]);
    //     $this->middleware('permission:admin-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:admin-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
    // }
    public function index()
    {
        $admins = User::whereDoesntHave('user_mahasiswa')->where('email', '!=', 'satriotol69@gmail.com')->get();
        return view('pages.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('pages.admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'roles' => 'required'
        ]);
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $user->assignRole($data['roles']);
        session()->flash('success');
        return redirect(route('admin.index'));
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
    public function edit(User $admin)
    {
        $roles = Role::all();
        return view('pages.admin.create', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $admin->id,
            'password' => 'nullable|confirmed',
            'roles' => 'required'
        ]);
        $data = $request->except('password');
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $admin->update($data);
        DB::table('model_has_roles')->where('model_id', $admin->id)->delete();
        $admin->assignRole($request['roles']);
        session()->flash('success');
        return redirect(route('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        session()->flash('success');
        return back();
    }
    public function reset_password(User $admin)
    {
        $admin->update([
            'password' => ''
        ]);
        session()->flash('success');
        return back();
    }
}