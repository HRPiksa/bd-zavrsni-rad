<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Laracasts\Presenter\PresentableTrait;

class Page extends Model
{
    use HasFactory;

    use NodeTrait;
    use PresentableTrait;

    protected $presenter = 'App\Presenters\PagePresenter';

    protected $table = 'pages';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = array(
        'title',
        'url',
        'content',
        'user_id',
        'parent_id',
        '_lft',
        '_rgt',
        'image'
    );

    public function user()
    {
        return $this->belongsTo( User::class );
    }

    public function updateOrder( $order, $orderPage )
    {
        $relative = Page::findOrFail( $orderPage );

        if ( $order == 'before' ) {
            $this->beforeNode( $relative )->save();
        } else if ( $order == 'after' ) {
            $this->afterNode( $relative )->save();
        } else {
            $relative->appendNode( $this );
        }

        Page::fixTree();
    }
}
