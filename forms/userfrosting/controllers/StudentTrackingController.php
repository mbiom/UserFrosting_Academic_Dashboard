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
class StudentTrackingController extends \UserFrosting\BaseController {

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
    public function pageStudentTracking(){
        // Access-controlled page
        $students = StudentsBio::queryBuilder()
            ->groupBy('student_id')
            ->get(array('student_id'));

        $this->_app->render('students/student-tracking.twig', [
           "students" => $students
        ]);
    }
    
    public function getStudentTracking($student_id) {
        
        $student_tracking = array(); // returning value
        
        $test_results = TestResults::queryBuilder()
            ->where('student_id', $student_id)
            ->orderBy('test_date', 'desc')
            ->get();
        $last_taken = "";
        if (count($test_results) != 0) {
            $last_taken = $test_results[0]['test_date'];
        }
        else {
            return json_encode($student_tracking);
        }
        
        $trackings = PostTestForm::queryBuilder()
            ->where('student_id', $student_id)
            ->where('term', '=', $this->LASTTERM)
            ->get();
            
        if (count($trackings) != 0) {
            $student_tracking = $trackings[0];
        }
        
        $student_tracking['last_taken'] = $last_taken;
        $student_tracking['test_results'] = $test_results;
        
        //var_dump($student_tracking);
        return json_encode($student_tracking);
    }
}
