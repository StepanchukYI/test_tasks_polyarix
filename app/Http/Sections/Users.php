<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\UserRole;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Users
 *
 * @property \App\Models\User $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Users extends Section
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
    protected $title = 'Пользователи';

    /**
     * @var string
     */
    protected $alias= 'users';

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
	    $display = AdminDisplay::table()
	                           ->setHtmlAttribute( 'class' , 'table-primary' )
	                           ->setColumns(
		                           AdminColumn::text( 'id' )->setLabel( 'ID' ) ,
		                           AdminColumn::text( 'role.title' )->setLabel( 'Роль' ),
		                           AdminColumn::text( 'name' )->setLabel( 'Имя' ),
		                           AdminColumn::text( 'last_name' )->setLabel( 'Фамилия' ),
		                           AdminColumn::image( 'image' )->setLabel( 'Email' ),
		                           AdminColumn::text( 'comment.comment' )->setLabel( 'Комментарий' ),
		                           AdminColumn::datetime( 'created_at' )->setLabel( 'Дата создания' )->setFormat( 'd.m.Y' ) ,
		                           AdminColumn::datetime( 'updated_at' )->setLabel( 'Дата изменения' )->setFormat( 'd.m.Y' ) )
	                           ->paginate( 20 );

	    $display->with('role', 'comment');
	    return $display;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
	    $role = [];
	    UserRole::all()->each( function( $item ) use ( &$role )
	    {
		    $role[$item->id] = $item->title;
	    } );

	    $form = AdminForm::panel()->addBody( [
		    AdminFormElement::select( 'user_role_id' , 'Роль' , $role ) ,
		    AdminFormElement::text( 'name' , 'Имя' ),
		    AdminFormElement::text( 'last_name' , 'Фамилия' ),
		    AdminFormElement::text( 'email' , 'Email' )->required() ,
		    AdminFormElement::image( 'image' , 'Фото' ),
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
