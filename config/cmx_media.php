<?php

return [
    /* you can add your own middleware here */
    'middleware' => ['web','auth'],

    /* you can set your own model */
    'model' => CmXperts\MediaManager\Models\Upload::class,

    /* you can set your own table names */
    'table' => 'cmx_uploads',

    /* you can set your route path*/
    'route_prefix' => 'cmxperts/media',

    /* here you can make menu items visible to specific roles */
    'use_roles' => false,

    /* If use_roles = true above then must set the table name, primary key and title field to get roles details */
    'roles_table' => 'roles',

    'roles_pk' => 'id', // primary key of the roles table

    'roles_title_field' => 'name', // display name (field) of the roles table
];
