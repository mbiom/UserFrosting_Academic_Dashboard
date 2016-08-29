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
class ExcessiveAbsencesController extends \UserFrosting\BaseController {

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
    public function pageExcessiveAbsences(){
        // Access-controlled page
        $ClassReference = StudentsBio::queryBuilder()
            ->groupBy('reference_number')
            ->get(array('reference_number'));

        $Terms = StudentsBio::queryBuilder()
            ->groupBy('term')
            ->get();
            
        $this->_app->render('students/excessive-absences.twig', [
           "classreference" => $ClassReference,
           "terms" => $Terms
        ]);
    }
    
    public function getExcessiveAbsences($classRef) {
        
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
            ->orderBy('last_name')
            ->get(array('uf_students_bio.*', 'ea.absences', 'ea.checked'));
        
        return json_encode($students);
    }
    
    public function setExcessiveAbsences($student_absences_str) {
        
        $temp_arr = explode('-', $student_absences_str);
        
        $student_absences = array();
        foreach($temp_arr as $temp_line) {
            $temp_arr1 = explode('_', $temp_line);
            array_push($student_absences, $temp_arr1);
        }
        //return json_encode($student_absences);
        //$student_absences = json_decode($data);
        if (count($student_absences) == 0)
            return "F";
        
        $term = $student_absences[0][0];
        foreach ($student_absences as $student_absence) {
            ExcessiveAbsences::queryBuilder()
                ->where('term', '=', $term)
                ->where('student_id', '=', $student_absence[1])
                ->delete();
        }
        
        $insertData = array();
        
        foreach ($student_absences as $student_absence) {
            
            $row = array(
                'term'  => $term,
                'student_id'  => $student_absence[1],
                'checked'  => $student_absence[2],
                'absences'  => $student_absence[3]
            );
            array_push($insertData, $row);
        }
        ExcessiveAbsences::queryBuilder()
            ->insert($insertData);
        
        $to = 'yurikonev@hotmail.com';

        $subject = 'Student Absences Report';
        
        $headers = "From: nobody@opinadero.com \r\n";
        $headers .= "Reply-To: nobody@opinadero.com \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $message = '<p height=60px>Instructor:</p>';
        $message .= '<p height=60px>Class Ref:'. $student_absences[0][4] .'</p>';
        $message .= "<table style='border:1px solid;widh:500px;border-spacing:0px'><tr><td>Student ID</td><td>Student Name</td><td>Number of Absences</td></tr>";
        foreach ($insertData as $row) {
            if($row['checked'] == 1) {
                $message .= "<tr><td>".$row['student_id']."</td><td>".$this->getStudentNameFromId($row['student_id'])."</td><td>".$row['absences']."</td></tr>";
            }
        }
        $message .= '</table>';
        mail($to, $subject, $message, $headers);
        
        return "S";
    }
    
    public function getStudentNameFromId($student_id) {
        $student = StudentsBio::queryBuilder()
            ->where('student_id', '=', $student_id)
            ->where('term', '=', $this->LASTTERM)
            ->get(array('last_name', 'first_name'));
        if (count($student)) {
            return $student[0]['last_name'].", ".$student[0]['first_name']; 
        }
        else {
            return "";
        }
    }
}
