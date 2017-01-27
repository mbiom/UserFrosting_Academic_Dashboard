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
        $ClassReferences = StudentsBio::queryBuilder()
            ->where('term', '=', $this->getLastTermName())
            ->groupBy('teacher_id')
            ->groupBy('reference_number')
            ->get(array('teacher_id', 'reference_number'));
            
        $TeacherClasses = array();
        foreach($ClassReferences as $classRef) {
            if (!array_key_exists($classRef['teacher_id'], $TeacherClasses))
                $TeacherClasses[$classRef['teacher_id']] = array();
                
            array_push($TeacherClasses[$classRef['teacher_id']], $classRef['reference_number']);
        }
        
        $AllClasses = StudentsBio::queryBuilder()
            ->groupBy('reference_number')
            ->where('term', '=', $this->getLastTermName())
            ->get(array('reference_number'));
        
        $Terms = StudentsBio::queryBuilder()
            ->groupBy('term')
            ->where('term', '<>', '20152')
            ->get(array('term'));
            
        $this->_app->render('students/next-assign-test.twig', [
           "classreference" => $TeacherClasses,
           "allclasses" => $AllClasses,
           "terms" => $Terms
        ]);
    }
    
    public function getNATByClass($classId) {
        $arr_param = explode('_', $classId);
        $term = $arr_param[0];
        $classId = $arr_param[1];
        
        $students = NextAssignTest::queryBuilder()
            ->leftJoin('uf_students_bio as B', 'B.student_id', '=', 'uf_nat.student_id')
            ->where('B.term', '=', $term)
            ->where('uf_nat.term', '=', $term)
            ->where('reference_number', '=', $classId)
            ->get();
        
        return json_encode($students);
    }
}
