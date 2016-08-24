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
        $ClassReference = StudentsBio::queryBuilder()
            ->groupBy('reference_number')
            ->where('term', '=', '20153')
            ->get(array('reference_number'));

        $Terms = StudentsBio::queryBuilder()
            ->groupBy('term')
            ->where('term', '<>', '20152')
            ->get();
            
        $this->_app->render('students/post-test-form.twig', [
           "classreference" => $ClassReference,
           "terms" => $Terms
        ]);
    }
    
    public function getClassesOfTerm($term) {
        $classRefs = StudentsBio::queryBuilder()
            ->groupBy('reference_number')
            ->where('term', '=', $term)
            ->get(array('reference_number'));
        return json_encode($classRefs);
    }
    
    public function getTestFormOfTerm($term) {
        $testResults = PostTestForm::queryBuilder()
            ->where('term', '=', $term)
            ->orderBy('last_name')
            ->get();
        return json_encode($testResults);
    }
    
    public function authoizePromotion($term_id) {
        PostTestForm::queryBuilder()
            ->where('term', '=', substr($term_id, 0, 5))
            ->where('student_id', '=', substr($term_id, 6, strlen($term_id) - 6))
            ->update(['admin_prom' => 'A']);
        return json_encode("A");
    }
}
