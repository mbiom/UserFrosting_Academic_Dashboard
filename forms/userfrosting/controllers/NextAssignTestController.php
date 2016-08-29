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
class NextAssignTestController extends \UserFrosting\BaseController {

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
    public function pageNextAssignTest(){
        // Access-controlled page
        $ClassReference = StudentsBio::queryBuilder()
            ->groupBy('reference_number')
            ->where('term', '=', $this->LASTTERM)
            ->get(array('reference_number'));
            
        $this->_app->render('students/next-assign-test.twig', [
            "classreference" => $ClassReference
        ]);
    }
    
    public function getNATByClass($classId) {
        $students = NextAssignTest::queryBuilder()
            ->leftJoin('uf_students_bio as B', 'B.student_id', '=', 'uf_nat.student_id')
            ->where('reference_number', '=', $classId)
            ->get();
            
        return json_encode($students);
    }
}
