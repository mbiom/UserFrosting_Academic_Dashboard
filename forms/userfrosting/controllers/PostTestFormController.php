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
    public $LEVEL_RANGES = array(
                                 array("FO", 153, 180, 169, 180, "A"),
                                 array("LB", 181, 190, 181, 189, "B"),
                                 array("HB", 191, 200, 190, 199, "C"),
                                 array("LI", 201, 210, 200, 209, "D"),
                                 array("HI", 211, 220, 210, 218, "E"),
                                 array("ADV", 221, 235, 219, 227, "F"),
                                 array("CCR", 236, 1000, 228, 1000, ""),);
    
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
            ->get(array('reference_number'));

        $Terms = StudentsBio::queryBuilder()
            ->groupBy('term')
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
    
    public function updateTestFormTable($term) {
        
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
        unset($students);
        //get test results from current term
        $test_results = TestResults::queryBuilder()
            ->where('term', '=', $term)
            ->where('type', '<>', '')
            ->where('form', '<>', '')
            ->get();
        
        $arr_test_results = array();
        
        foreach ($test_results as $test_result) {
            if (!array_key_exists($test_result['student_id'], $arr_students)) {
                continue;
            }
            if ($test_result['type'] == "POST-TEST") {
                if (strpos($test_result['form'], "R") != false)
                    $arr_test_results[$test_result['student_id']]['postR'] = $test_result['score'];
                else if (strpos($test_result['form'], "L") != false)
                    $arr_test_results[$test_result['student_id']]['postL'] = $test_result['score'];
            }
            else if ($test_result['type'] == "PRE-TEST") {
                if (strpos($test_result['form'], "R") != false)
                    $arr_test_results[$test_result['student_id']]['preR'] = $test_result['score'];
                else if (strpos($test_result['form'], "L") != false)
                    $arr_test_results[$test_result['student_id']]['preL'] = $test_result['score'];
            }
        }
        unset($test_results);
        //get pre test results from last test
        $last_test_results = TestResults::queryBuilder()
            ->where('term', '=', $this->getLastTerm($term))
            ->where('type', '=', 'POST-TEST')
            ->where('form', '<>', '')
            ->get();
        
        $arr_last_test_results = array();
        
        foreach ($arr_students as $student=> $value) {
            $arr_last_test_results[$student] = array();
        }
       
        foreach ($last_test_results as $last_test_result) {
            if (strpos($last_test_result['form'], "R") != false)
                $arr_last_test_results[$last_test_result['student_id']]['postR'] = $last_test_result['score'];
            else if (strpos($last_test_result['form'], "L") != false)
                $arr_last_test_results[$last_test_result['student_id']]['postL'] = $last_test_result['score'];
        }
        unset($last_test_results);
        
        foreach ($arr_test_results as $student_id => $test_result) {
            if (!array_key_exists ($student_id, $arr_last_test_results))
                continue;
            if (!array_key_exists("preR", $test_result) && array_key_exists("postR", $arr_last_test_results[$student_id])) {
                $arr_test_results[$student_id]['preR'] = $arr_last_test_results[$student_id]['postR'];
            }
            if (!array_key_exists("preL", $test_result) && array_key_exists("postL", $arr_last_test_results[$student_id])) {
                $arr_test_results[$student_id]['preL'] = $arr_last_test_results[$student_id]['postL'];
            }
        }
    
        //get NRS, tracking
        foreach ($arr_test_results as $student_id => $test_result) {
            if (!array_key_exists("preR", $test_result) || !array_key_exists("preL", $test_result)) {
                $arr_test_results[$student_id]['comments'] = "Check testing";
            }
            else {
                $trackingLevel = $this->getTracking($test_result['preR'], $test_result['preL']);
                $arr_test_results[$student_id]['tracking'] = $trackingLevel[0];
                $arr_test_results[$student_id]['NRS'] = $trackingLevel[1];
            }
        }
        
        foreach ($arr_test_results as $student_id => $test_result) {
            
            if (array_key_exists("preR", $test_result) && array_key_exists("preL", $test_result)
                && array_key_exists("postR", $test_result) && array_key_exists("postL", $test_result)
                && array_key_exists("tracking", $test_result) && array_key_exists("NRS", $test_result)) {
                
                $arr_test_results[$student_id]['progR'] = $test_result['postR'] - $test_result['preR'];
                $arr_test_results[$student_id]['progL'] = $test_result['postL'] - $test_result['preL'];
                if ($test_result['tracking'] == 0) { // tracking is reading
                    $postLevel = $this->getLevel($test_result['postR'], true);
                    
                    if ($arr_test_results[$student_id]['progR'] < 0) {
                        $arr_test_results[$student_id]['LCPEarned'] = 'No';
                        $arr_test_results[$student_id]['LCP'] = '';
                        $arr_test_results[$student_id]['LCPTotal'] = 0;
                        $arr_test_results[$student_id]['nextLevel'] = $test_result['NRS'];
                        $arr_test_results[$student_id]['autoProm'] = "";
                        $arr_test_results[$student_id]['adminProm'] ="";
                    }
                    else if ($test_result['NRS'] == $postLevel
                             && $this->LEVEL_RANGES[$postLevel][2] - 3 > $test_result['postR']) {
                        $arr_test_results[$student_id]['LCPEarned'] = 'No';
                        $arr_test_results[$student_id]['LCP'] = '';
                        $arr_test_results[$student_id]['LCPTotal'] = 0;
                        $arr_test_results[$student_id]['nextLevel'] = $test_result['NRS'];
                        $arr_test_results[$student_id]['autoProm'] = "";
                        $arr_test_results[$student_id]['adminProm'] ="";
                    }
                    else if ($test_result['NRS'] == $postLevel
                             && $this->LEVEL_RANGES[$postLevel][2] == $test_result['postR']) {
                        $arr_test_results[$student_id]['LCPEarned'] = 'No';
                        $arr_test_results[$student_id]['LCP'] = '';
                        $arr_test_results[$student_id]['LCPTotal'] = 0;
                        $arr_test_results[$student_id]['nextLevel'] = $test_result['NRS'] + 1;
                        $arr_test_results[$student_id]['autoProm'] = 1; // checkmark
                        $arr_test_results[$student_id]['adminProm'] ="";
                    }
                    else if ($test_result['NRS'] == $postLevel
                             && $this->LEVEL_RANGES[$postLevel][2] - 1 >= $test_result['postR']
                             && $this->LEVEL_RANGES[$postLevel][2] - 3 <= $test_result['postR']) {
                        $arr_test_results[$student_id]['LCPEarned'] = 'No';
                        $arr_test_results[$student_id]['LCP'] = '';
                        $arr_test_results[$student_id]['LCPTotal'] = 0;
                        $arr_test_results[$student_id]['nextLevel'] = $test_result['NRS'] - 1;
                        $arr_test_results[$student_id]['autoProm'] = 2; //checkmark, need autorize
                        $arr_test_results[$student_id]['adminProm'] ="";
                    }
                    else if ($test_result['NRS'] + 1 == $postLevel) {
                        $arr_test_results[$student_id]['LCPEarned'] = 'Yes';
                        $arr_test_results[$student_id]['LCP'] = $this->LEVEL_RANGES[$test_result['NRS']][5];
                        $arr_test_results[$student_id]['LCPTotal'] = 1;
                        $arr_test_results[$student_id]['nextLevel'] = $arr_test_results[$student_id]['NRS'];
                        $arr_test_results[$student_id]['autoProm'] = "";
                        $arr_test_results[$student_id]['adminProm'] ="";
                    }
                    else if ($test_result['NRS'] + 1 < $postLevel) {
                        $arr_test_results[$student_id]['LCPEarned'] = 'Yes';
                        $arr_test_results[$student_id]['LCP'] = $this->LEVEL_RANGES[$postLevel - 1][5];
                        $arr_test_results[$student_id]['LCPTotal'] = $postLevel - $test_result['NRS'];
                        $arr_test_results[$student_id]['nextLevel'] = $arr_test_results[$student_id]['NRS'] + $postLevel - $test_result['NRS'] - 1;
                        $arr_test_results[$student_id]['autoProm'] = "";
                        $arr_test_results[$student_id]['adminProm'] ="";
                        $arr_test_results[$student_id]['comments'] = "Skipped Level";
                    }
                }
                else { //tracking is listening
                    $postLevel = $this->getLevel($test_result['postL'], false);
                    
                    if ($arr_test_results[$student_id]['progL'] < 0) {
                        $arr_test_results[$student_id]['LCPEarned'] = 'No';
                        $arr_test_results[$student_id]['LCP'] = '';
                        $arr_test_results[$student_id]['LCPTotal'] = 0;
                        $arr_test_results[$student_id]['nextLevel'] = $test_result['NRS'];
                        $arr_test_results[$student_id]['autoProm'] = "";
                        $arr_test_results[$student_id]['adminProm'] ="";
                    }
                    else if ($test_result['NRS'] == $postLevel
                             && $this->LEVEL_RANGES[$postLevel][4] - 3 > $test_result['postL']) {
                        $arr_test_results[$student_id]['LCPEarned'] = 'No';
                        $arr_test_results[$student_id]['LCP'] = '';
                        $arr_test_results[$student_id]['LCPTotal'] = 0;
                        $arr_test_results[$student_id]['nextLevel'] = $test_result['NRS'];
                        $arr_test_results[$student_id]['autoProm'] = "";
                        $arr_test_results[$student_id]['adminProm'] ="";
                    }
                    else if ($test_result['NRS'] == $postLevel
                             && $this->LEVEL_RANGES[$postLevel][4] == $test_result['postL']) {
                        $arr_test_results[$student_id]['LCPEarned'] = 'No';
                        $arr_test_results[$student_id]['LCP'] = '';
                        $arr_test_results[$student_id]['LCPTotal'] = 0;
                        $arr_test_results[$student_id]['nextLevel'] = $test_result['NRS'] + 1;
                        $arr_test_results[$student_id]['autoProm'] = 1; // checkmark
                        $arr_test_results[$student_id]['adminProm'] ="";
                    }
                    else if ($test_result['NRS'] == $postLevel
                             && $this->LEVEL_RANGES[$postLevel][4] - 1 >= $test_result['postL']
                             && $this->LEVEL_RANGES[$postLevel][4] - 3 <= $test_result['postL']) {
                        $arr_test_results[$student_id]['LCPEarned'] = 'No';
                        $arr_test_results[$student_id]['LCP'] = '';
                        $arr_test_results[$student_id]['LCPTotal'] = 0;
                        $arr_test_results[$student_id]['nextLevel'] = $test_result['NRS'] - 1;
                        $arr_test_results[$student_id]['autoProm'] = 2; //checkmark, need autorize
                        $arr_test_results[$student_id]['adminProm'] ="";
                    }
                    else if ($test_result['NRS'] + 1 == $postLevel) {
                        $arr_test_results[$student_id]['LCPEarned'] = 'Yes';
                        $arr_test_results[$student_id]['LCP'] = $this->LEVEL_RANGES[$test_result['NRS']][5];
                        $arr_test_results[$student_id]['LCPTotal'] = 1;
                        $arr_test_results[$student_id]['nextLevel'] = $arr_test_results[$student_id]['NRS'];
                        $arr_test_results[$student_id]['autoProm'] = "";
                        $arr_test_results[$student_id]['adminProm'] ="";
                    }
                    else if ($test_result['NRS'] + 1 < $postLevel) {
                        $arr_test_results[$student_id]['LCPEarned'] = 'Yes';
                        $arr_test_results[$student_id]['LCP'] = $this->LEVEL_RANGES[$postLevel - 1][5];
                        $arr_test_results[$student_id]['LCPTotal'] = $postLevel - $test_result['NRS'];
                        $arr_test_results[$student_id]['nextLevel'] = $arr_test_results[$student_id]['NRS'] + $postLevel - $test_result['NRS'] - 1;
                        $arr_test_results[$student_id]['autoProm'] = "";
                        $arr_test_results[$student_id]['adminProm'] ="";
                        $arr_test_results[$student_id]['comments'] = "Skipped Level";
                    }
                }
            }
        }
        //combine with bio info
        foreach ($arr_students as $student_id=> $student) {
            $arr_test_results[$student_id]['classRef'] = $student['reference_number'];
            $arr_test_results[$student_id]['lastName'] = $student['last_name'];
            $arr_test_results[$student_id]['firstName'] = $student['first_name'];
            $arr_test_results[$student_id]['phone'] = $student['telephone'];
        }
        
        //format array result
        $check_fields = array('NRS', 'preR', 'postR', 'progR', 'preL', 'postL', 'progL', 'tracking', 'LCPEarned', 'LCP', 'LCPTotal', 'nextLevel', 'autoProm', 'adminProm', 'flags', 'comments');
        foreach ($arr_test_results as $key => $test_result) {
            foreach ($check_fields as $fieldname) {
                if (!array_key_exists($fieldname, $test_result)){
                    $arr_test_results[$key][$fieldname] = "";
                }
            }
        }
        
        foreach ($arr_test_results as $key => $test_result) {
            if ($test_result['NRS'] != "" && $test_result['NRS'] >= 0){
                $arr_test_results[$key]['NRS'] = $this->LEVEL_RANGES[$test_result['NRS']][0];
            }
            if ($test_result['nextLevel'] != "" && $test_result['nextLevel'] >= 0){
                $arr_test_results[$key]['nextLevel'] = $this->LEVEL_RANGES[$test_result['nextLevel']][0];
            }
        }
        return json_encode($arr_test_results);
    }
    
    public function getTracking($reading, $listening) {
        $level_reading = $this->getLevel($reading, true);
        $level_listening = $this->getLevel($listening, false);
        $tracking = 0;
        $return_val = array();
        if ($reading == $listening && $level_reading == $level_listening) {
            $return_val[0] = 0;
            $return_val[1] = $level_reading;
        }
        else if ($level_reading == $level_listening){
            $return_val[0] = $reading <=$listening ? 0 : 1;
            $return_val[1] = $reading <=$listening ? $level_reading : $level_listening;
        }
        else{
            $return_val[0] = $level_reading <=$level_listening ? 0 : 1;
            $return_val[1] = $level_reading <=$level_listening ? $level_reading : $level_listening;
        }
        return $return_val;
    }
    
    public function getLevel($marks, $isReading) {
        for ($i = 0; $i < count($this->LEVEL_RANGES); $i++) {
            if ($isReading && $this->LEVEL_RANGES[$i][1] <= $marks && $this->LEVEL_RANGES[$i][2] >= $marks ||
                !$isReading && $this->LEVEL_RANGES[$i][3] <= $marks && $this->LEVEL_RANGES[$i][4] >= $marks) {
                return $i;
            }
        }
    }
}
