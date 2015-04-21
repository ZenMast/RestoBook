<?php
namespace app\console\controllers;

use yii\helpers\Console;
use yii\console\Controller;
use Yii;

/**
 * Creates base rbac authorization data for our application.
 * -----------------------------------------------------------------------------
 * 4 roles:
 *
 * - theCreator : you, developer of this site (super admin)
 * - admin      : your direct clients, administrators of this site
 * - member     : user of this site who has registered his account and can log in
 * - restaurantRepresentative : Represents restaurant in restobook system, can manage 1 restaurant
 *
 * Creates 1 permission:

 * - manageUsers        : allows admin+ roles to manage users (CRUD plus role assignment)
 */
class RbacController extends Controller
{
    /**
     * Initializes the RBAC authorization data.
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //---------- RULES ----------//

        //---------- PERMISSIONS ----------//

        // add "manageUsers" permission
        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Allows admin+ roles to manage users';
        $auth->add($manageUsers);

        //---------- ROLES ----------//

        // add "member" role
        $member = $auth->createRole('member');
        $member->description = 'Registered users, members of this site';
        $auth->add($member);
        
        // add "restaurantRepresentative" role
        $restaurantRepresentative = $auth->createRole('restaurantRepresentative');
        $restaurantRepresentative->description = 'Represents restaurant in restobook system, can manage 1 restaurant';
        $auth->add($restaurantRepresentative);
        $auth->addChild($restaurantRepresentative, $member);

        // add "admin" role and give this role: 
        // manageUsers, permissions, plus he can do everything that $restaurantRepresentative role can do.
        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator of this application';
        $auth->add($admin);
        $auth->addChild($admin, $restaurantRepresentative);
        $auth->addChild($admin, $manageUsers);

        // add "theCreator" role ( this is you :) )
        // You can do everything that admin can do plus more (if You decide so)
        $theCreator = $auth->createRole('theCreator');
        $theCreator->description = 'Admin that can manage all admins';
        $auth->add($theCreator); 
        $auth->addChild($theCreator, $admin);

        if ($auth) 
        {
            $this->stdout("\nRbac authorization data are installed successfully.\n", Console::FG_GREEN);
        }
    }
}