<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        return $this->middleware( 'auth' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view( 'admin.roles.index' )->with( array( 'roles' => $roles ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy( 'group' );

        return view( 'admin.roles.create' )->with( array( 'permissions' => $permissions ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $request->validate(
            array(
                'name' => 'required'
            ),
            array(
                'name.required' => 'Morate unijeti naziv uloge.'
            )
        );

        $role = Role::create( array(
            'name' => trim( $request->name )
        ) );

        foreach ( $request->permissions as $permission ) {
            $role->permissions()->attach( $permission );
        }

        if ( isset( $role ) ) {
            return redirect()->route( 'roles.index' )->with( 'status', 'Uloga je dodana.' );
        } else {
            return back()->withErrors( array( 'error', 'Unos uloge nije uspio!' ) );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Role $role )
    {
        $permissions = Permission::all()->groupBy( 'group' );

        return view( 'admin.roles.edit' )->with( array( 'permissions' => $permissions, 'role' => $role ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Role $role )
    {
        $request->validate(
            array(
                'name' => 'required|unique:roles,name,' . $role->id
            ),
            array(
                'name.required' => 'Morate unijeti naziv uloge.',
                'name.unique'   => 'Uloga mora biti jedinstvena.'
            )
        );

        $role->permissions()->sync( $request->permissions );

        $role->name = $request->name;
        $role->save();

        return redirect()->route( 'roles.index' )->with( 'status', 'Uloga je ažurirana.' );
    }

    public function delete( Role $role )
    {
        return view( 'admin.roles.delete' )->with( array( 'role' => $role ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Role $role )
    {
        DB::beginTransaction();
        try {
            $role->permissions()->detach();

            $role->delete();

            DB::commit();

            return redirect()->route( 'roles.index' )->with( 'status', 'Uloga je obrisana.' );
        } catch ( \Throwable $th ) {
            DB::rollback();

            return redirect()->back()->withErrors( array( 'message' => $th->getMessage() ) );
        }
    }
}
