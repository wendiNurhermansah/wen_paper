<?php

namespace App\Http\Controllers;

use Auth;
use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\User;

use App\Models\AdminDetails;


use App\Models\ModelHasRole;
use Spatie\Permission\Models\Role;


class PenggunaController extends Controller
{
    protected $path  = 'images/ava/';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::select('id', 'name')->get();
        return view('pengguna.index', compact('roles'));
    }

    public function api()
    {

        $pengguna = AdminDetails::all();


        return DataTables::of($pengguna)
            ->addColumn('action', function ($p) {
                return "
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Permission'><i class='icon-remove'></i></a>";
            })
            ->editColumn('admin_id', function ($p) {
                return "<a href='" . route('pengguna.show', $p->id) . "' class='text-primary' title='Show Data'>" . $p->admin->username . "</a>";
            })
            ->editColumn('foto',  function ($p)  {
                if ($p->foto != null) {
                    return "<img width='50' class='img-fluid mx-auto d-block rounded-circle' alt='foto' src='" . $this->path . $p->foto . "'>";
                } else {
                    return "<img width='50' class='rounded img-fluid mx-auto d-block' alt='foto' src='" . asset('images/404.png') . "'>";
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'foto', 'admin_id'])
            ->toJson();
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
        $request->validate([
            'username' => 'required|unique:admins',
            'password' => 'required',
            'nama'     => 'required',
            'email'    => 'required|email|unique:admin_details',
            'no_telp'  => 'required|max:13|unique:admin_details',
            'foto'     => 'required|mimes:png,jpg,jpeg|max:2024',
            'role_id'  => 'required'
        ]);

        /** Tahapan :
         * 1. admins
         * 2. admins_details
         * 3. model_has_roles
         */

        // Tahap 1
        $username = $request->username;
        $password = $request->password;

        $admin = new User();
        $admin->username = $username;
        $admin->password = Hash::make($password);
        $admin->save();

        // Tahap 2
        $nama    = $request->nama;
        $email   = $request->email;
        $no_telp = $request->no_telp;
        $get_admin_id = User::select('id')->latest()->first();

        // Proses Saved
        $file     = $request->file('foto');
        $fileName = time() . "." . $file->getClientOriginalName();
        $request->file('foto')->move("images/ava/", $fileName);

        $admin_detail = new AdminDetails();
        $admin_detail->nama     = $nama;
        $admin_detail->email    = $email;
        $admin_detail->no_telp  = $no_telp;
        $admin_detail->foto     = $fileName;
        $admin_detail->admin_id = $get_admin_id->id;
        $admin_detail->save();

        // Tahap 3
        $path    = 'app\User';
        $role_id = $request->role_id;

        $model_has_role = new ModelHasRole();
        $model_has_role->role_id    = $role_id;
        $model_has_role->model_type = $path;
        $model_has_role->model_id   = $get_admin_id->id;
        $model_has_role->save();

        return response()->json([
            'message' => 'Data berhasil tersimpan.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $path  = $this->path;

        $admin_detail = AdminDetails::findOrFail($id);
        // dd($admin_detail);
        $admin = User::whereid($admin_detail->admin_id)->first();
        $roles = Role::select('id', 'name')->get();

        // get role_id by user
        $model_has_role = ModelHasRole::where('model_id', $admin_detail->admin_id)->first();
        // dd($model_has_role);
        $role  = Role::select('id', 'name')->whereid($model_has_role->role_id)->first();

        return view('pengguna.show', compact(
            'admin_detail',
            'admin',
            'roles',
            'role',
            'path'
        ));
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
    public function update(Request $request, $id)
    {
        $admin_detail = AdminDetails::find($id);
        $request->validate([
            'username' => 'required|unique:admins,username,' . $admin_detail->admin_id,
            'nama'     => 'required',
            'email'    => 'required|email|unique:admin_details,email,' . $id,
            'no_telp'  => 'required|max:13|unique:admin_details,no_telp,' . $id,
            'role_id'  => 'required'
        ]);

        /** Tahapan :
         * 1. admins
         * 2. admins_details
         * 3. model_has_roles
         */

        //  Tahap 1
        $username = $request->username;
        $admin    = User::find($admin_detail->admin_id);
        $admin->update([
            'username' => $username
        ]);

        // Tahap 2
        $nama    = $request->nama;
        $email   = $request->email;
        $no_telp = $request->no_telp;

        if ($request->foto != null) {
            $request->validate([
                'foto' => 'required|mimes:png,jpg,jpeg|max:1024'
            ]);

            // Proses Saved Foto
            $file     = $request->file('foto');
            $fileName = time() . "." . $file->getClientOriginalName();
            $request->file('foto')->move("images/ava/", $fileName);

            // Proses Delete Foto
            $exist = $admin_detail->foto;
            $path  = "images/ava/" . $exist;
            \File::delete(public_path($path));

            $admin_detail->update([
                'nama'    => $nama,
                'email'   => $email,
                'no_telp' => $no_telp,
                'foto'    => $fileName
            ]);
        } else {
            $admin_detail->update([
                'nama'    => $nama,
                'email'   => $email,
                'no_telp' => $no_telp,
            ]);
        }

        // Tahap 3
        $role_id = $request->role_id;

        $model_has_role = ModelHasRole::wheremodel_id($admin_detail->admin_id);
        $model_has_role->update([
            'role_id' => $role_id
        ]);

        return response()->json([
            'message' => 'Data berhasil diperbaharui.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editpassword($id){
        $admin_detail = AdminDetails::findOrFail($id);

        return view('pengguna.form_password', compact(
            'admin_detail'
        ));
    }

    public function updatePassword(Request $request, $id){
        $admin_detail = AdminDetails::find($id);
        $request->validate([
            'password'         => 'required|string|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $password = $request->password;
        $admin    = User::find($admin_detail->admin_id);
        $admin->update([
            'password' => Hash::make($password)
        ]);

        return response()->json([
            'message' => 'Data berhasil diperbaharui.'
        ]);
    }
}
