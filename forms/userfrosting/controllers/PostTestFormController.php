<?php

namespace UserFrosting;

/**
 * PostTestFormController Class
 *
 * Controller class for /PostTestForm/* URLs.  Handles PostTestForm-related activities, including listing PostTestForm, CRUD for PostTestForm, etc.
 *
 * @package UserFrosting
 * @author Alex Weissman
 * @link http://www.userfrosting.com/navigating/#structure
 */
class PostTestFormController extends \UserFrosting\BaseController {

    /**
     * Create a new PostTestFormController object.
     *
     * @param UserFrosting $app The main UserFrosting app.
     */
    public function __construct($app){
        $this->_app = $app;
    }

    /**
     * Renders the PostTestForm listing page.
     *
     * This page renders a table of user PostTestForm, with dropdown menus for modifying those PostTestForm.
     * This page requires authentication (and should generally be limited to admins or the root user).
     * Request type: GET
     * @todo implement interface to modify authorization hooks and permissions
     */
    public function pagePostTestForm(){
        // Access-controlled page

    }
    
    public function updateTestFormTable($term="20153") {
        
        $students = StudentsBio::queryBuilder()
            ->where('term', '=', $term)
            ->where('status_code', '<>', 'W')
            ->where('status_code', '<>', 'WX')
            ->groupBy('student_id')
            ->get();

        $arr_students = array();
        foreach($students as $student) {
            $arr_students[$student['student_id']] = $student;
        }
        
        var_dump($arr_students);
        
        $test_post_results = TestResults::queryBuilder()
            ->where('term', '=', $term)
            ->where('type', '=', 'POST-TEST')
            ->get();
        
        return json_encode($students);
    
        //$query = "
        //    SELECT `$object_table`.*
        //    FROM `$link_table`, `$object_table`
        //    WHERE `$link_table`.event_id = :id
        //    AND `$link_table`.user_id = `$object_table`.id";
        //
        //$stmt = $db->prepare($query);
        //
        //$sqlVars[':id'] = $this->_id;
        //
        //$stmt->execute($sqlVars);
        //
        //$results = [];
        //while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        //    $id = $row['id'];
        //    $results[$id] = new User($row, $row['id']);
        //}
        //return $results;
    }
}
