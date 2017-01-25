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
class UpdateTableController extends \UserFrosting\BaseController {

    /**
     * Create a new PostTestFormController object.
     *
     * @param UserFrosting $app The main UserFrosting app.
     */
    
    public function __construct($app){
        $this->_app = $app;
    }
    
    public $STUDENTS_TRACKING;
    /**
     * Renders the PostTestForm listing page.
     *
     * This page renders a table of user PostTestForm, with dropdown menus for modifying those PostTestForm.
     * This page requires authentication (and should generally be limited to admins or the root user).
     * Request type: GET
     * @todo implement interface to modify authorization hooks and permissions
     */
    public function pageUpdateTable(){
        // Access-controlled page
        $ClassReference = StudentsBio::queryBuilder()
            ->groupBy('reference_number')
            ->get(array('reference_number'));

        $this->_app->render('students/update-table.twig', [
           "classreference" => $ClassReference
        ]);
    }
    
    public function getClassesOfTerm($term) {
        $classRefs = StudentsBio::queryBuilder()
            ->groupBy('reference_number')
            ->where('term', '=', $term)
            ->get(array('reference_number'));
        return json_encode($classRefs);
    }
    // update tracking table first
    public function updateFirstTrackingTable() {
        StudentsTracking::queryBuilder()
            ->delete();
            
        $arr_trackings = array();
        $students = StudentsBio::queryBuilder()
            ->where('term', '=', '20152')
            ->groupBy('student_id')
            ->get(array('student_id'));
            
        foreach ($students as $student) {
            $arr_trackings[$student['student_id']] = 10;
        }
        
        $students = StudentsBio::queryBuilder()
            ->where('term', '=', '20153')
            ->groupBy('student_id')
            ->get(array('student_id'));
        
        foreach ($students as $student) {
            if (!array_key_exists($student['student_id'], $arr_trackings)) {
                $missed_tracking = PostTestForm::queryBuilder()
                    ->where('term', '=', '20153')
                    ->where('student_id', '=', $student['student_id'])
                    ->get(array('student_id', 'tracking'));
                if(count($missed_tracking) != 0 && $missed_tracking[0]['tracking'] != 0) {
                    $arr_trackings[$student['student_id']]  = $missed_tracking[0]['tracking'];
                }
            }
        }
        
        $insertData = array();
        foreach ($arr_trackings as $key=>$value) {
            $row = array(
                'student_id' => $key,
                'tracking' => $value
            );
            array_push($insertData, $row);
        }
        
        StudentsTracking::queryBuilder()
            ->insert($insertData);
            
        // var_dump($insertData);
         
        return "";
    }
    
    public function updateLaterTrackingTable() {
    }

    public function removeEditionTable()
    {
        $students = StudentsBio::queryBuilder()
            ->where('term', '=', '20161')
            ->delete();
        return json_encode("Ok");
    }

    public function updateTestFormTable() {
        //get trackings from tracking table
        $this->STUDENTS_TRACKING = array();
        $trackings = StudentsTracking::queryBuilder()
            ->get();
            
        foreach ($trackings as $tracking) {
            $this->STUDENTS_TRACKING[$tracking['student_id']] = $tracking['tracking'];
        }
        //update table where last term
        $terms = TestResults::queryBuilder()
            ->where('term', '<>', '')
            ->groupBy('term')
            ->orderBy('term', 'desc')
            ->get(array('term'));
        
        $this->updatePostTestFormTable($terms[0]['term']);
        // $this->updateTrackingTable();
            // return (json_encode($this->updatePostTestFormTable($terms[0]['term'])));
        return json_encode("Ok");
    }
    
    public function updatePostTestFormTable($term) {
        //get students list of term from studentsbio
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
                $arr_test_results[$student_id]['flags'] = "Check testing";
            }
            else {
                // $trackingLevel = $this->STUDENTS_TRACKING[$student_id];
                // $trackingLevel = array_key_exists($student_id, $this->STUDENTS_TRACKING) ? $this->STUDENTS_TRACKING[$student_id] : 10;
                $trackingLevel = [10,0];
                if (!array_key_exists('postR', $arr_test_results[$student_id]) || !array_key_exists('postL', $arr_test_results[$student_id]))
                    $trackingLevel = [10,0];
                else
                    $trackingLevel = $this->getTracking($arr_test_results[$student_id]['postR'], $arr_test_results[$student_id]['postL']);
                $arr_test_results[$student_id]['tracking'] = $trackingLevel[0];
                $arr_test_results[$student_id]['NRS'] = $trackingLevel[1];
            }
        }
        
        //return json_encode($arr_test_results);
        foreach ($arr_test_results as $student_id => $test_result) {
            
            if (array_key_exists("preR", $test_result) && array_key_exists("preL", $test_result)
                && array_key_exists("postR", $test_result) && array_key_exists("postL", $test_result)
                && array_key_exists("tracking", $test_result) && array_key_exists("NRS", $test_result)) {
                
                $arr_test_results[$student_id]['progR'] = $test_result['postR'] - $test_result['preR'];
                $arr_test_results[$student_id]['progL'] = $test_result['postL'] - $test_result['preL'];
                
                $postLevel = 0; $preScore = 0; $postScore = 0; $endOfLevel = false; $closeEnd = false;
                if ($test_result['tracking'] == 10) { // tracking is reading
                    $postLevel = $this->getLevel($test_result['postR'], true);
                    $preScore = $test_result['preR'];
                    $postScore = $test_result['postR'];
                    $endOfLevel = $this->LEVEL_RANGES[$postLevel][2] == $test_result['postR'];
                    $closeEnd = $this->LEVEL_RANGES[$postLevel][2] - 1 >= $test_result['postR']
                             && $this->LEVEL_RANGES[$postLevel][2] - 3 <= $test_result['postR'];
                }
                else { // tracking is listening
                    $postLevel = $this->getLevel($test_result['postL'], false);
                    $preScore = $test_result['preL'];
                    $postScore = $test_result['postL'];
                    $endOfLevel = $this->LEVEL_RANGES[$postLevel][4] == $test_result['postL'];
                    $closeEnd = $this->LEVEL_RANGES[$postLevel][4] - 1 >= $test_result['postL']
                             && $this->LEVEL_RANGES[$postLevel][4] - 3 < $test_result['postL'];
                }
                
                $uplevels = $postLevel - $test_result['NRS'];
                $arr_test_results[$student_id]['LCPEarned'] = 'No';
                $arr_test_results[$student_id]['LCP'] = '';
                $arr_test_results[$student_id]['LCPTotal'] = 0;
                $arr_test_results[$student_id]['nextLevel'] = $postLevel;
                $arr_test_results[$student_id]['autoProm'] = "";
                $arr_test_results[$student_id]['adminProm'] ="";
                $arr_test_results[$student_id]['flags'] ="";
                $arr_test_results[$student_id]['comments'] ="";
                
                if ($postScore - $preScore < 0) {
                    $arr_test_results[$student_id]['nextLevel'] = $test_result['NRS'];
                    if ($uplevels < 0)
                        $arr_test_results[$student_id]['flags'] ="Downgraded Level";
                }
                else if ($uplevels == 0) {
                    if ($endOfLevel) {
                        $arr_test_results[$student_id]['nextLevel'] = $test_result['NRS'] + 1;
                        $arr_test_results[$student_id]['autoProm'] = "C";
                    }
                    else if($closeEnd) {
                        $arr_test_results[$student_id]['adminProm'] ="C";
                    }
                }
                else if ($uplevels > 0) {
                    $arr_test_results[$student_id]['LCPEarned'] = 'Yes';
                    $earnedLCPs = '';
                    for ($i = 0; $i < $uplevels; $i++) {
                        $earnedLCPs .= $this->LEVEL_RANGES[$i + $test_result['NRS']][5] . ",";
                    }
                    $arr_test_results[$student_id]['LCP'] = strlen($earnedLCPs) > 1 ?
                        substr($earnedLCPs, 0, strlen($earnedLCPs)-1) : "";
                    $arr_test_results[$student_id]['LCPTotal'] = $uplevels;
                    if ($uplevels > 1)
                        $arr_test_results[$student_id]['flags'] ="Skipped " . ($uplevels == 2 ? "Level" : ($uplevels-1)." Levels");
                }
            }
        }
        //combine with bio info
        foreach ($arr_students as $student_id=> $student) {
            $arr_test_results[$student_id]['classRef'] = $student['reference_number'];
            $arr_test_results[$student_id]['lastName'] = $student['last_name'];
            $arr_test_results[$student_id]['firstName'] = $student['first_name'];
            $arr_test_results[$student_id]['phone'] = $student['telephone'];
            $arr_test_results[$student_id]['hours'] = $student['hours'];
        }
        
        //validate array result
        $check_fields = array('NRS', 'preR', 'postR', 'progR', 'preL', 'postL', 'progL', 'tracking', 'LCPEarned', 'LCP', 'LCPTotal', 'nextLevel', 'autoProm', 'adminProm', 'flags', 'comments');
        foreach ($arr_test_results as $key => $test_result) {
            foreach ($check_fields as $fieldname) {
                if (!array_key_exists($fieldname, $test_result)){
                    $arr_test_results[$key][$fieldname] = "";
                }
            }
        }
        
        foreach ($arr_test_results as $key => $test_result) {
            if ((string)$test_result['NRS'] != ''){
                $arr_test_results[$key]['NRS'] = $this->LEVEL_RANGES[$test_result['NRS']][0];
            }
            if ((string)$test_result['nextLevel'] != ''){
                $arr_test_results[$key]['nextLevel'] = $this->LEVEL_RANGES[$test_result['nextLevel']][0];
            }
            if ($test_result['tracking'] != 10 && $test_result['tracking'] != 14 )
                $arr_test_results[$key]['tracking'] = 10;
        }
    
        $delete = PostTestForm::queryBuilder()
            ->where('term', '=', $term)
            ->delete();
        
        $insertData = array();
        
        foreach ($arr_test_results as $key => $test_result) {

            $row = array(
                'term'  => $term,
                'reference_number'  => $test_result['classRef'],
                'last_name'  => $test_result['lastName'],
                'first_name'  => $test_result['firstName'],
                'student_id'  => $key,
                'telephone'  => $test_result['phone'],
                'hours' => $test_result['hours'],
                'nrs_level'  => $test_result['NRS'],
                'pre_reading'  => $test_result['preR'],
                'post_reading'  => $test_result['postR'],
                'prog_reading'  => $test_result['progR'],
                'pre_listening'  => $test_result['preL'],
                'post_listening'  => $test_result['postL'],
                'prog_listening'  => $test_result['progL'],
                'tracking'  => $test_result['tracking'],
                'lcp_earned'  => $test_result['LCPEarned'],
                'lcp'  => $test_result['LCP'],
                'lcp_total'  => $test_result['LCPTotal'],
                'next_level'  => $test_result['nextLevel'],
                'auto_prom'  => $test_result['autoProm'],
                'admin_prom'  => $test_result['adminProm'],
                'flags'  => $test_result['flags'],
                'comments'  => $test_result['comments']
                );
            
            array_push($insertData, $row);
        }
        // return $insertData;
        PostTestForm::queryBuilder()
            ->insert($insertData);
    }
    
    public function getTracking($reading, $listening) {
        if (!is_numeric($reading) || !is_numeric($listening))
            return 10;
        $level_reading = $this->getLevel($reading, true);
        $level_listening = $this->getLevel($listening, false);
        $tracking = 10;
        $return_val = array();
        if ($reading == $listening && $level_reading == $level_listening) {
            $return_val[0] = 10;
            $return_val[1] = $level_reading;
        }
        else if ($level_reading == $level_listening){
            $return_val[0] = $reading <=$listening ? 10 : 14;
            $return_val[1] = $reading <=$listening ? $level_reading : $level_listening;
        }
        else{
            $return_val[0] = $level_reading <=$level_listening ? 10 : 14;
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
