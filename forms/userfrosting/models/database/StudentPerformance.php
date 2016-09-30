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
class StudentPerformance extends UFModel {

    /**
     * @var string The id of the table for the current model.
     */ 
    protected static $_table_id = "student_performance";
    
    /**
     * Create a new Group object.
     *
     */
    public function __construct($properties = []) {
        parent::__construct($properties);
    }

    public function getPerformanceByForm($term, $classId, $formId) {
        $sql= "select A.*, sum(A.correct='Yes')/count(A.student_id) 
                from uf_student_performance as A left 
                join uf_students_bio as B on A.student_id=B.student_id 
                where A.term=". $term ." and A.form=" . $formId ." and B.reference_number=". $classId ." 
                group by position, comp_number 
                order by position, main_comp desc";
        $sql = "select * from uf_student_performance";

        $db = Capsule::connection();
        var_dump($db);
        $result = $db -> raw($sql);
        return $result;
    }
}
