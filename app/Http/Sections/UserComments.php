<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\User;
use App\Models\UserRole;
use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;
/**
 * Class UserComments
 *
 * @property \App\Models\UserComment $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class UserComments extends Section
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Комментарии';

    /**
     * @var string
     */
    protected $alias = 'user_comments';

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
	    $display = AdminDisplay::table()
	                           ->setHtmlAttribute( 'class' , 'table-primary' )
	                           ->setColumns(
		                           AdminColumn::text( 'id' )->setLabel( 'ID' ) ,
		                           AdminColumn::text( 'user.email' )->setLabel( 'email пользователя' ),
		                           AdminColumn::text( 'comment' )->setLabel( 'ID пользователя' ),
		                           AdminColumn::datetime( 'created_at' )->setLabel( 'Дата создания' )->setFormat( 'd.m.Y' ) ,
		                           AdminColumn::datetime( 'updated_at' )->setLabel( 'Дата изменения' )->setFormat( 'd.m.Y' ) )
	                           ->paginate( 20 );

	    $display->with('user');
	    return $display;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
	    $users = [];
	    User::all()->each( function( $item ) use ( &$users )
	    {
		    $users[$item->id] = $item->email;
	    } );

	    $form = AdminForm::panel()->addBody( [
		    AdminFormElement::select( 'user_id' , 'Потзователь' , $users )->required() ,
		    AdminFormElement::text( 'comment' , 'Комментарий' )->required(),
	    ] );

	    return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
