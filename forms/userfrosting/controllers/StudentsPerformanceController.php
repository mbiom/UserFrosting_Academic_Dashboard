<?php

namespace UserFrosting;

/**
 * StudentsPerformanceController Class
 *
 * Controller class for /StudentsPerformance/* URLs.  Handles StudentsPerformance-related activities, including listing StudentsPerformance, CRUD for StudentsPerformance, etc.
 *
 * @package UserFrosting
 * @author Alex Weissman
 * @link http://www.userfrosting.com/navigating/#structure
 */
class StudentsPerformanceController extends \UserFrosting\BaseController {

    /**
     * Create a new StudentsPerformanceController object.
     *
     * @param UserFrosting $app The main UserFrosting app.
     */
    public function __construct($app){
        $this->_app = $app;
    }

    /**
     * Renders the StudentsPerformance listing page.
     *
     * This page renders a table of user StudentsPerformance, with dropdown menus for modifying those StudentsPerformance.
     * This page requires authentication (and should generally be limited to admins or the root user).
     * Request type: GET
     * @todo implement interface to modify authorization hooks and permissions
     */
    public function pageStudentsPerformance(){
        // Access-controlled page

        $StudentsPerformance = StudentPerformance::queryBuilder()->get();

        $this->_app->render('students/students-performance.twig', [
           "studentsperformance" => $StudentsPerformance
        ]);
    }

}
