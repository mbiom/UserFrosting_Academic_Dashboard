<?php

namespace UserFrosting;

use \Illuminate\Database\Capsule\Manager as Capsule;

 /* Group Class
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
class TestResults extends UFModel {

    /**
     * @var string The id of the table for the current model.
     */ 
    protected static $_table_id = "test_results";
    
    /**
     * Create a new Group object.
     *
     */
    public function __construct($properties = []) {
        parent::__construct($properties);
    }
    
    public function getPostTestResults($term) {
    $students = StudentsBio::queryBuilder()
            ->leftJoin('uf_student_performance as stp', 'stp.student_id', '=', 'uf_students_bio.student_id')
            ->where('reference_number', '=', $classid)
            ->get();
            
        return $results;
    }
}
