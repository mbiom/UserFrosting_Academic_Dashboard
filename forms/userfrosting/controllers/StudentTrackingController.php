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
        $ClassReference = StudentsBio::queryBuilder()
            ->groupBy('reference_number')
            ->get(array('reference_number'));

        $Terms = StudentsBio::queryBuilder()
            ->groupBy('term')
            ->get();
            
        $this->_app->render('students/student-tracking.twig', [
           "classreference" => $ClassReference,
           "terms" => $Terms
        ]);
    }
    
    public function getStudentTracking($student_id) {
        $students = array();
        
        $term = StudentsBio::queryBuilder()
            ->groupBy('term')
            ->orderBy('term', 'desc')
            ->first();
        
        if (is_null($term))
            return json_encode($students);
        
        $term = $term['term'];
        
        $students = StudentsBio::queryBuilder()
            ->leftJoin('uf_excessive_absences as ea', 'ea.student_id', '=', 'uf_students_bio.student_id', 'and', 'ea.term', '=', 'uf_students_bio.term')
            ->where('reference_number', '=', $classRef)
            ->get(array('uf_students_bio.*', 'ea.absences', 'ea.checked'));
        
        return json_encode($students);
    }
}
