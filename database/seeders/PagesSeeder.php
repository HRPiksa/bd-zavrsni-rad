<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'pages' )->delete();

        $admin_user = User::where( 'username', 'admin' )->first();

        Page::create( array(
            'title'     => 'O nama',
            'url'       => 'about',
            'content'   => '<p>This is the about page.</p>',
            'user_id'   => $admin_user->id,
            'parent_id' => null,
            '_lft'      => 1,
            '_rgt'      => 2,
            'image'     => 'images/pages/about/about.jpg'
        ) );

        Page::create( array(
            'title'     => 'Kontakt',
            'url'       => 'contact',
            'content'   => '<p>Ovo je stranica za kontakt.</p>',
            'user_id'   => $admin_user->id,
            'parent_id' => null,
            '_lft'      => 9,
            '_rgt'      => 12,
            'image'     => 'images/pages/contact/contact.jpg'
        ) );

        Page::create( array(
            'title'     => 'Lokacija',
            'url'       => 'another-page',
            'content'   => '<p>Nalazimo se na lokaciji .......</p>',
            'user_id'   => $admin_user->id,
            'parent_id' => null,
            '_lft'      => 10,
            '_rgt'      => 11,
            'image'     => 'images/pages/another-page/another.jpg'
        ) );

        Page::create( array(
            'title'     => 'Test1',
            'url'       => 'test',
            'content'   => '<p>Test,</p>

<p>koji to nije</p>',
            'user_id'   => $admin_user->id,
            'parent_id' => null,
            '_lft'      => 3,
            '_rgt'      => 4,
            'image'     => 'images/pages/test/test_1.jpg'
        ) );

        Page::create( array(
            'title'     => 'Test2',
            'url'       => 'test_2',
            'content'   => '<p>Testirati treba kontinuirano i temeljito.</p>',
            'user_id'   => $admin_user->id,
            'parent_id' => null,
            '_lft'      => 5,
            '_rgt'      => 6,
            'image'     => 'images/pages/test_2/test_2.jpg'
        ) );

        Page::create( array(
            'title'     => 'Test3',
            'url'       => 'test_3',
            'content'   => '<h1><strong>Abeceda znanja</strong></h1>

<p><em>Tko zna &scaron;to je to?</em></p>

<ol>
	<li>Prvo</li>
	<li>Drugo</li>
	<li>Treće</li>
</ol>

<p>Bok&nbsp; &euro;</p>

<p>&nbsp;</p>',
            'user_id'   => $admin_user->id,
            'parent_id' => null,
            '_lft'      => 7,
            '_rgt'      => 8,
            'image'     => 'images/pages/test_3/test_3.jpg'
        ) );
    }
}
