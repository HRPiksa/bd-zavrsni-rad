<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReqValidPage;
use App\Models\Page;
use App\Models\User;
use App\Traits\StorePageImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    use StorePageImage;

    public function __construct()
    {
        return $this->middleware( 'auth' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( User $user )
    {
        $pages = Page::defaultOrder()->withDepth()->get();

        return view( 'admin.pages.index' )->with( array( 'pages' => $pages ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'admin.pages.create' )->with( array( 'model' => new Page(), 'orderPages' => Page::defaultOrder()->withDepth()->get() ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( ReqValidPage $request )
    {
        $path = '';

        if ( $request->hasFile( 'image' ) ) {
            if ( $request->file( 'image' )->isValid() ) {
                $request->validate( array(
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ) );

                $file_name = $request->file( 'image' )->getClientOriginalName();
                $file_folder = 'images/pages/' . trim( $request->input( 'url' ) );

                $path = $request->image->storeAs( $file_folder, $file_name, array( 'disk' => 'my' ) );
            }
        }

        $page = Page::create( array(
            'title'   => trim( $request->input( 'title' ) ),
            'url'     => trim( $request->input( 'url' ) ),
            'content' => trim( $request->input( 'content' ) ),
            'user_id' => Auth::user()->id,
            'image'   => trim( $path )
        ) );

        if ( isset( $page ) ) {
            if ( $request->has( 'order', 'orderPage' ) ) {
                $this->updatePageOrder( $page, $request );
            }

            return redirect()->route( 'pages.index' )->with( 'status', 'Stranica je dodana.' );
        } else {
            return back()->withErrors( array( 'error', 'Unos stranice nije uspio!' ) );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show( Page $page )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit( Page $page )
    {
        return view( 'admin.pages.edit' )->with( array( 'model' => $page, 'orderPages' => Page::defaultOrder()->withDepth()->get() ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update( ReqValidPage $request, Page $page )
    {
        if ( $response = $this->updatePageOrder( $page, $request ) ) {
            return $response;
        }

        $path = $this->verifyAndStorePageImage( $request );

        $page->title = $request->title;
        $page->url = $request->url;
        $page->content = $request->content;

        $page->image = trim( $path );

        $page->save();

        return redirect()->route( 'pages.index' )->with( 'status', 'Stranica je ažurirana.' );
    }

    public function delete( Page $page )
    {
        return view( 'admin.pages.delete' )->with( array( 'page' => $page ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy( Page $page )
    {
        DB::beginTransaction();
        try {
            $page->delete();

            DB::commit();

            return redirect()->route( 'pages.index' )->with( 'status', 'Stranica je obrisana.' );
        } catch ( \Throwable $th ) {
            DB::rollback();

            return redirect()->back()->withErrors( array( 'message' => $th->getMessage() ) );
        }
    }

    protected function updatePageOrder( Page $page, Request $request )
    {
        if ( $request->has( 'order', 'orderPage' ) ) {
            if ( $page->id == $request->orderPage ) {
                return redirect()->route( 'pages.edit', array( 'page' => $page->id ) )->withInput()->withErrors( array( 'error', 'Cannot order page against itself.' ) );
            }

            $page->updateOrder( $request->order, $request->orderPage );
        }
    }
}
