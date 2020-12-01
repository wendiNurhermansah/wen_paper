<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\ModelHasPermission;

use App\Models\ModelHasRole;
use App\Models\Permission;
use App\Models\RoleHasPermissions;
use Spatie\Permission\Models\Role;
use DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view ('role.index');
    }

    public function api(){
        $role = Role::all();
        return Datatables::of($role)
        ->addColumn('permissions', function ($p) {
            return count($p->permissions) . " <a href='" .route('addpermission',$p->id) . "' class='text-success pull-right' title='Edit Permissions'><i class='icon-clipboard-list2 mr-1'></i></a>";
        })
            
            ->addColumn('action', function ($p) {
                return "
                    <a href='#' onclick='edit(" . $p->id . ")' title='Edit Role'><i class='icon-pencil mr-1'></i></a>
                    <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'permissions'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'name' => 'required|unique:roles,name',
            'guard_name' => 'required'
        ]);
        $input = $request->all();
        Role::create($input);
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
        return Role::find($id);
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
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'guard_name' => 'required'
        ]);

        $input = $request->all();
        $role = Role::findOrfail($id);
        $role->update($input);
        return response()->json([
            'message' => 'Data berhasil di perbaharui.'
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
        Role::destroy($id);

        return response()->json([
            'message' => 'Data berhsil di Hapus'
        ]);
    }

    public function permission($id)
    {
    

        $role  = Role::findOrFail($id);
        $exist_permission = RoleHasPermissions::select('permission_id')->whererole_id($id)->get()->toArray();
        $permission      = Permission::select('id', 'name')->whereNotIn('id', $exist_permission)->get();

        return view('role.formPermission', compact(
            'role',
            'permission'
        ));
    }

   
    public function storePermissions(Request $request)
    {
        $request->validate([
            'permissions' => 'required'
        ]);

        $role = Role::findOrFail($request->id);
        $role->givePermissionTo($request->permissions);

        return response()->json([
            'message' => 'Data permission berhasil tersimpan.'
        ]);
    }

    public function getPermissions($id)
    {
        $role = Role::findOrFail($id);
        return $role->permissions;
    }

    public function destroyPermission(Request $request, $name)
    {
        $role = Role::findOrFail($request->id);
        $role->revokePermissionTo($name);

        return response()->json([
            'success' => true
        ]);
    }

}
