<?php

namespace UserFrosting;

/**
 * StudentPerformanceController Class
 *
 * Controller class for /StudentsPerformance/* URLs.  Handles StudentsPerformance-related activities, including listing StudentsPerformance, CRUD for StudentsPerformance, etc.
 *
 * @package UserFrosting
 * @author Alex Weissman
 * @link http://www.userfrosting.com/navigating/#structure
 */
class StudentPerformanceController extends \UserFrosting\BaseController {

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
    public function pageStudentPerformance(){
        // Access-controlled page

        $ClassReference = StudentsBio::queryBuilder()
            ->groupBy('reference_number')
            ->where('term', '=', '20153')
            ->get(array('reference_number'));

        $Terms = StudentsBio::queryBuilder()
            ->groupBy('term')
            ->where('term', '<>', '20152')
            ->get();
            
        $this->_app->render('students/student-performance.twig', [
           "classreference" => $ClassReference,
           "terms" => $Terms
        ]);
    }
    
    public function getPerformanceByClass($classId) {
        $students = StudentsBio::queryBuilder()
            ->where('reference_number', '=', $classId)
            ->groupBy('student_id')
            ->orderBy('last_name')
            ->get(array('student_id'));
        
        $pfm_data = array();
        foreach($students as $student) {
            $pfm_data[$student['student_id']] = array();
        
            $reading_pfms = $this->getRLPerformanceOfStudent($student['student_id'], true);
            $listening_pfms = $this->getRLPerformanceOfStudent($student['student_id'], false);
            if (count($reading_pfms) > 0) $pfm_data[$student['student_id']]['R'] = $reading_pfms;
            if (count($listening_pfms) > 0) $pfm_data[$student['student_id']]['L'] = $listening_pfms;
        }
        
        return json_encode($pfm_data);
    }
    
    public function getPerformanceByStudent($studentId) {
        $pfm_data = array();
        $pfm_data[$studentId] = array();
        
        $reading_pfms = $this->getRLPerformanceOfStudent($studentId, true);
        $listening_pfms = $this->getRLPerformanceOfStudent($studentId, false);
        if (count($reading_pfms) > 0) $pfm_data[$studentId]['R'] = $reading_pfms;
        if (count($listening_pfms) > 0) $pfm_data[$studentId]['L'] = $listening_pfms;
        
        return json_encode($pfm_data);
    }
    
    public function getPerformanceByCompetency($compId) {
        $arr_param = explode('_', $compId);
        $classId = $arr_param[0];
        $compId = $arr_param[1];
        
        $students = StudentsBio::queryBuilder()
            ->where('reference_number', '=', $classId)
            ->groupBy('student_id')
            ->orderBy('last_name')
            ->get(array('student_id'));
        
        $pfm_data = array();
        foreach($students as $student) {
            $pfm_data[$student['student_id']] = array();
        
            $reading_pfms = $this->getRLPerformanceOfStudent($student['student_id'], true, $compId);
            $listening_pfms = $this->getRLPerformanceOfStudent($student['student_id'], false, $compId);
            if (count($reading_pfms) > 0) $pfm_data[$student['student_id']]['R'] = $reading_pfms;
            if (count($listening_pfms) > 0) $pfm_data[$student['student_id']]['L'] = $listening_pfms;
        }
        
        return json_encode($pfm_data);
    }
    
    public function getRLPerformanceOfStudent($student_id, $isReading, $compNo="") {
        $pfm_data = array();
        $pfms = StudentPerformance::queryBuilder()
            ->where('term', '=', $this->LASTTERM)
            ->where('student_id', '=', $student_id)
            ->where('form', 'regexp', $isReading ? 'R':'L')
            ->orderBy('position', 'asc')
            ->orderBy('main_comp', 'desc')
            ->get();
            
        if(count($pfms) > 0) {
            $accurate = TestResults::queryBuilder()
                ->where('term', '=', $this->LASTTERM)
                ->where('student_id', '=', $student_id)
                ->where('form', '=', $pfms[0]['form'])
                ->get();
                
            if(count($accurate) > 0 && $accurate[0]['accurate']=='Yes') {
                
                $pfm_data['student_name'] = $pfms[0]['student_name'];
                $pfm_data['form'] = $pfms[0]['form'];
                $pfm_data['score'] = $pfms[0]['scale_score'];
                $pfm_data['test_date'] = $pfms[0]['test_date'];
                $pfm_data['NAT'] = '';
                $pfm_data['series'] = '';
                
                $pfm_data['pfm'] = array();
                $positions = array();  //positions that have specific competency number
                if ($compNo == "") {
                    $pfm_data['pfm'] = $pfms;
                }
                else {
                    $hasComp = false;
                    foreach($pfms as $pfm) {
                        if ($pfm['comp_number'] == $compNo)
                        {
                            $hasComp = true;
                            $positions[$pfm['position']] = $compNo;
                        }
                    }
                    if (!$hasComp) return $pfm_data;
                    foreach($pfms as $pfm) {
                        if (array_key_exists($pfm['position'], $positions))
                        {
                            array_push($pfm_data['pfm'], $pfm);
                        }
                    }
                }
            }
        }
        
        return $pfm_data;
    }
    
    public function getRLPerformanceForCompetency($compNo, $isReading, $success=-1) {
        $positions = StudentPerformance::queryBuilder()
            ->where('term', '=', $this->LASTTERM)
            ->where('student_id', '=', $student_id)
            ->where('form', 'regexp', $isReading ? 'R':'L')
            ->orderBy('position', 'asc')
            ->orderBy('main_comp', 'desc')
            ->get();
    }
    
    public function getStudentsOfClass($classid) {
        
        $students = StudentsBio::queryBuilder()
            ->leftJoin('uf_student_performance as stp', 'stp.student_id', '=', 'uf_students_bio.student_id')
            ->where('reference_number', '=', $classid)
            ->get();
        
        return json_encode($students);
    }
    
}
