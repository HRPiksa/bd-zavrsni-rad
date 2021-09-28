<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait StorePageImage
{

    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function verifyAndStorePageImage( Request $request )
    {
        if ( $request->hasFile( 'image' ) ) {

            if ( !$request->file( 'image' )->isValid() ) {
                return redirect()->back()->withInput();
            }

            $request->validate(
                array(
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480'
                ),
                array(
                    'image.required' => 'Morate odabrati datoteku!',
                    'image.image'    => 'Datoteka mora biti slika!',
                    'image.mimes'    => 'Tipovi datoteka su: jpeg,png,jpg,gif i svg!',
                    'image.max'      => 'Maksimalna veličina datoteke je 20 MB!'
                )
            );

            $file_name = $request->file( 'image' )->getClientOriginalName();
            $file_folder = 'images/pages/' . trim( $request->input( 'url' ) );

            return $request->image->storeAs( $file_folder, $file_name, array( 'disk' => 'my' ) );
        }

        return null;
    }
}
