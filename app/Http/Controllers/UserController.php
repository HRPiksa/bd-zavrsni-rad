<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReqValidUserCreate;
use App\Http\Requests\ReqValidUserEdit;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        return $this->middleware( 'auth' );
    }

    public function index( Request $request )
    {
        $valuesPerPage = array( 2, 3, 5, 10, 20, 50 );

        $totalPerPage = $request->get( 'per_page', 3 );

        $search = $request->input( 'term' );
        if ( $search != "" ) {
            $all_users = User::where( function ( $query ) use ( $search ) {
                $query->where( 'firstname', 'like', '%' . $search . '%' )
                    ->orWhereRaw( "concat(firstname, ' ', lastname) like '%$search%' " )
                    ->orWhere( 'lastname', 'like', '%' . $search . '%' )
                    ->orWhere( 'email', 'like', '%' . $search . '%' );
            } )
                ->sortable()->paginate( $totalPerPage );
            $all_users->appends( array( 'term' => $search ) );
        } else {
            $all_users = User::sortable()->paginate( $totalPerPage );
        }

        $totalPage = $all_users->lastPage();

        $request->session()->put( 'users_data_url', $request->getUri() );

        return view( 'admin.users.index' )->with( array( 'all_users' => $all_users, 'totalPage' => $totalPage, 'valuesPerPage' => $valuesPerPage ) );
    }

    public function show( User $user )
    {
        $roles = Role::all();

        return view( 'admin.users.view' )->with( array( 'user' => $user, 'roles' => $roles ) );
    }

    public function viewModal( $id = 0 )
    {
        $roles = Role::all();

        $user = new User();
        $data = $user->find( $id );

        $html = '<div class="form-group row">
                    <label for="firstname" class="control-label col-sm-3">Ime:</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" name="firstname" id="editFirstname" value="' . $data->firstname . '" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="viewLastname" class="control-label col-sm-3">Prezime:</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" name="viewLastname" id="viewLastname" value="' . $data->lastname . '" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="viewEmail" class="control-label col-sm-3">Email adresa:</label>
                    <div class="col-sm-9">
                    <input type="email" name="viewEmail" class="form-control" id="viewEmail" value="' . $data->email . '" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="viewUsername" class="control-label col-sm-3">Korisničko ime:</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" name="viewUsername" id="viewUsername" value="' . $data->username . '" readonly>
                    </div>
                </div>';

        $html .= '<div class="form-group row">
                 <label for="viewRoles" class="control-label col-sm-3">Uloge:</label>
                 <div id="viewRoles" class="col-sm-9">';
        foreach ( $roles as $role ) {
            $checked = $data->roles->pluck( 'id' )->contains( $role->id ) ? ' checked' : '';
            $html .= '<div class="form-check">
                         <input type="checkbox" name="roles[]" value=' . $role->id . $checked . ' disabled="disabled"><label>&nbsp;&nbsp;' . $role->name . '</label></div>';
        }
        $html .= '</div></div>';

        return response()->json( array( 'html' => $html ) );
    }

    public function create( Request $request )
    {
        $roles = Role::all();

        return view( 'admin.users.create' )->with( array( 'roles' => $roles, 'request' => $request ) );
    }

    public function store( ReqValidUserCreate $request )
    {
        $user = User::create( array(
            'firstname' => trim( $request->input( 'firstname' ) ),
            'lastname'  => trim( $request->input( 'lastname' ) ),
            'username'  => trim( $request->input( 'username' ) ),
            'email'     => strtolower( $request->input( 'email' ) ),
            'password'  => Hash::make( $request->input( 'password' ) )
        ) );

        if ( isset( $user ) ) {
            $user->roles()->sync( $request->input( 'roles' ) );

            return redirect()->route( 'user-show' )->with( 'status', 'Korisnik je dodan.' );
        } else {
            return back()->withErrors( array( 'error', 'Unos korisnika nije uspio!' ) );
        }
    }

    public function edit( User $user )
    {
        $roles = Role::all();

        return view( 'admin.users.edit' )->with(
            array(
                'roles' => $roles,
                'user'  => $user
            )
        );
    }

    public function update( ReqValidUserEdit $request, User $user )
    {
        $request->validate( array(
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email',
            'roles'     => 'required'
        ) );

        $user->roles()->sync( $request->roles );

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;

        $user->save();

        if ( Session( 'users_data_url' ) ) {
            return redirect( Session( 'users_data_url' ) )->with( 'status', 'Korisnik je ažuriran.' );
        }
        return redirect()->route( 'user-show' )->with( 'status', 'Korisnik je ažuriran.' );
    }

    public function delete( User $user )
    {
        return view( 'admin.users.delete' )->with(
            array(
                'user' => $user
            )
        );
    }

    public function destroy( User $user )
    {
        if ( Auth::user()->id == $user->id ) {
            return redirect()->back()->withErrors( array( 'message' => 'Brisanje trenutno prijavljenog korisnika nije moguće :(' ) );
        }

        DB::beginTransaction();
        try {
            $user->roles()->detach();

            $user->delete();

            DB::commit();

            return redirect()->route( 'user-show' )->with( 'status', 'Korisnik je obrisan.' );
        } catch ( \Throwable $th ) {
            DB::rollback();

            return redirect()->back()->withErrors( array( 'message' => $th->getMessage() ) );
        }
    }

    public function profile( User $user )
    {
        return view( 'user.profile' )->with( array( 'user' => $user ) );
    }
}
