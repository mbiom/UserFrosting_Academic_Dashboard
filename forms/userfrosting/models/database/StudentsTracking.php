<?php

namespace UserFrosting;

use \Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Group Class
 *
 * Represents a group object as stored in the database.
 *
 * @package UserFrosting
 * @author Alex Weissman
 * @see http://www.userfrosting.com/tutorials/lesson-3-data-model/
 *
 * @property string name
 * @property string theme
 * @property string landing_page
 * @property string new_user_title
 * @property string icon
 * @property bool is_default
 * @property bool can_delete
 */
class StudentsTracking extends UFModel {

    /**
     * @var string The id of the table for the current model.
     */ 
    protected static $_table_id = "students_tracking";
    
    /**
     * Create a new Group object.
     *
     */
    public function __construct($properties = []) {
        parent::__construct($properties);
    }
    
}
