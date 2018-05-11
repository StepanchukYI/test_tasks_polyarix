<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\UserRole;
use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class UserRoles
 *
 * @property \App\Models\UserRole $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class UserRoles extends Section
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
    protected $title = "Роли пользователей";

    /**
     * @var string
     */
    protected $alias = 'user_roles';

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
	    $display = AdminDisplay::table()
	                           ->setHtmlAttribute( 'class' , 'table-primary' )
	                           ->setColumns(
		                           AdminColumn::text( 'id' )->setLabel( 'ID' ) ,
		                           AdminColumn::text( 'title' )->setLabel( 'Роль' ),
		                           AdminColumn::datetime( 'created_at' )->setLabel( 'Дата создания' )->setFormat( 'd.m.Y' ) ,
		                           AdminColumn::datetime( 'updated_at' )->setLabel( 'Дата изменения' )->setFormat( 'd.m.Y' ) )
	                           ->paginate( 20 );

	    return $display;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
	    return $form = AdminForm::panel()->addBody( [
		    AdminFormElement::text( 'title' , 'Имя' ),
	    ] );
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
