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
        $ClassReferences = StudentsBio::queryBuilder()
            ->where('term', '=', $this->LASTTERM)
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
            ->where('term', '=', $this->LASTTERM)
            ->get(array('reference_number'));
        
        $Terms = StudentsBio::queryBuilder()
            ->groupBy('term')
            ->where('term', '<>', '20152')
            ->get(array('term'));
            
        $this->_app->render('students/excessive-absences.twig', [
           "classreference" => $TeacherClasses,
           "allclasses" => $AllClasses,
           "terms" => $Terms
        ]);
    }
    
    public function getExcessiveAbsences($classRef) {
        $arr_param = explode('_', $classRef);
        $term = $arr_param[0];
        $classRef = $arr_param[1];
        
        $students = array();
        
        $students = StudentsBio::queryBuilder()
            ->where('term', '=', $term)
            ->where('reference_number', '=', $classRef)
            ->where('status_code', '<>', 'W')
            ->where('status_code', '<>', 'WX')
            ->groupBy('student_id')
            ->get(array('student_id', 'last_name', 'first_name'));
        return json_encode($students);
    }
    
    public function setExcessiveAbsences($student_absences_str) {
        
        $temp_arr = explode('-', $student_absences_str);
        $commonInfo = array_pop ($temp_arr);
        $commonInfo = explode('_', $commonInfo);
        $term = $commonInfo[0];
        $classId = $commonInfo[1];
        $userId = $commonInfo[2];
        
        $student_absences = array();
        foreach($temp_arr as $temp_line) {
            $temp_arr1 = explode('_', $temp_line);
            array_push($student_absences, $temp_arr1);
        }
        // return json_encode($student_absences);
        //$student_absences = json_decode($data);
        if (count($student_absences) == 0)
            return "F";
        
        foreach ($student_absences as $student_absence) {
            ExcessiveAbsences::queryBuilder()
                ->where('term', '=', $term)
                ->where('student_id', '=', $student_absence[0])
                ->delete();
        }
        
        $insertData = array();
        
        foreach ($student_absences as $student_absence) {
            
            $row = array(
                'term'  => $term,
                'student_id'  => $student_absence[0],
                'checked'  => $student_absence[1],
                'absences'  => $student_absence[2]
            );
            array_push($insertData, $row);
        }
        ExcessiveAbsences::queryBuilder()
            ->insert($insertData);
        
        $recipients = User::queryBuilder()
            ->leftJoin('uf_group', 'uf_user.primary_group_id', '=', 'uf_group.id')
            ->whereIn('uf_group.id', array(2,4,7))
            ->get(array('email'));
        
        $headerRecipients = "";
        foreach ($recipients as $recipient) {
            $headerRecipients .= $recipient['email'] . ',';
        }
        if (strlen($headerRecipients) > 1) $headerRecipients = substr($headerRecipients, 0 , strlen($headerRecipients) - 1);
        
        $to = $headerRecipients;
        //$to = "yurikonev@hotmail.com";
        $subject = 'Student Absences Report';
        
        $headers = "From: nobody@opinadero.com \r\n";
        $headers .= "Reply-To: nobody@opinadero.com \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $message = "<div style='padding:20px 20px'><p style='padding-top:20px'>Instructor: <b>".$userId."</b></p>";
        $message .= "<p style='padding:20px 0px 20px 0px'>Class Ref: <b>". $classId ."</b></p>";
        $message .= "<table style='border: 1px solid;border-collapse:collapse;'>
                    <tr style='height:50px'><td style='border: 1px solid;font-weight:bold;text-align:center;width:150px;'>Student ID</td>
                    <td style='border: 1px solid;font-weight:bold;text-align:center;width:350px;'>Student Name</td>
                    <td style='border: 1px solid;font-weight:bold;text-align:center;'>Number of Absences</td></tr>";
        
        $willSend = false;
        foreach ($insertData as $row) {
            if($row['checked'] == 1) {
                $willSend = true;
                $message .= "<tr style='height:30px'><td style='border: 1px solid;'>".$row['student_id']."</td><td style='border: 1px solid;'>".$this->getStudentNameFromId($row['student_id'])."</td><td style='border: 1px solid;'>".$row['absences']."</td></tr>";
            }
        }
        $message .= '</table>';
        
        $message .= "<p style='padding-top:20px'>Today's Date: " .date('m-d-Y'). "</p><div>";
        
        //var_dump($message);
        if ($willSend)
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