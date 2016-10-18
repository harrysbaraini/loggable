<?php

/**
 * Your package config would go here
 */

return [
    /**
     * -----------------------------------------------------------------------------------------------------------------
     * User Model
     * -----------------------------------------------------------------------------------------------------------------
     *
     * User model class used by the application.
     *
     */
    'user_model' => '/App/Models/User',

    /**
     * -----------------------------------------------------------------------------------------------------------------
     * Users table
     * -----------------------------------------------------------------------------------------------------------------
     *
     * Users table name.
     *
     */
    'users_table' => 'users',
    'users_table_id' => 'id',

    /**
     * -----------------------------------------------------------------------------------------------------------------
     * Table
     * -----------------------------------------------------------------------------------------------------------------
     *
     * Name of the database table. It is 'logs' by default, but in case this name is already used by your
     * application, change it.
     * In case you want to change it but you have already executed the migration, please rollback first. After the
     * rollback get finished, you can change this variable to any name you want and run migration again.
     *
     */
    'table_name' => 'logs',

    /**
     * -----------------------------------------------------------------------------------------------------------------
     * Metadata Rules
     * -----------------------------------------------------------------------------------------------------------------
     *
     * Theses rules are used by the model, to check if information is set correct.
     * Metadata is a JSON data type, so you can customize what you save in your log table.
     *
     */
    'metadata_rules' => [
        'metadata' => 'required',
        'metadata.ip' => 'required|ip',
        'metadata.action' => 'required|string',
        'metadata.useragent' => 'required|string',
    ],
];
