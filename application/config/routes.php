<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['student-home'] = 'student';
$route['deliverable/(:num)'] = 'student/viewDeliverable/$1';
$route['evidence/(:num)'] = 'student/viewEvidence/$1';
$route['view-requests'] = 'student/viewRequests';
$route['view-all-feedback'] = 'student/viewAllFeedbacks';
$route['view-supervisor'] = 'student/viewSupervisor';

$route['createDeliverable'] = 'DeliverableController/create';
$route['uploadEvidence'] = 'EvidenceController/uploadFile';
$route['downloadEvidence'] = 'EvidenceController/downloadFile';
$route['uploadFeedback'] = 'FeedbackController/provideFeedback';
$route['downloadFeedback'] = 'FeedbackController/downloadFile';
$route['updateDelStatus'] = 'FeedbackController/markDelStatus';

$route['emailTest'] = 'EmailController';
$route['processEmail'] = 'EmailController/sendEmail';

$route['processDeadlineRequest'] = 'RequestController/requestDeadlineExtension';
$route['processDeleteRequest'] = 'RequestController/requestDeliverableDelete';
$route['approveDeadlineExtension'] = 'RequestController/approveDeadlineRequest';
$route['approveDelete'] = 'RequestController/approveDeliverableDelete';
$route['rejectRequestProcess'] = 'RequestController/rejectRequest';
$route['updateRequestStatus'] = 'RequestController/setRequestToSeen';
$route['processDeadlineResponses'] = 'RequestController/deadlineResponseProcess';
$route['processDeleteResponses'] = 'RequestController/deleteResponseProcess';

$route['staff-home'] = 'staff';
$route['view-student/(:any)'] = 'staff/viewStudent/$1';
$route['view-deliverable/(:num)'] = 'staff/viewDeliverable/$1';
$route['view-evidence/(:num)'] = 'staff/viewEvidence/$1';
$route['manage-requests'] = 'staff/ManageRequests';
$route['latest-submissions'] = 'staff/viewSubmittedEvidences';

$route['student-allocation'] = 'staff/allocateStudents';
$route['allocationPortal'] = 'staff/processAllocation';
$route['all-supervisors'] = 'staff/viewAllSupervisors';
$route['all-students'] = 'staff/viewAllStudents';

$route['default_controller'] = 'landing';
$route['studentRegister'] = 'landing/registerStudent';
$route['staffRegister'] = 'landing/registerStaff';
$route['loginPortal'] = 'landing/processLogin';
$route['logout'] = 'landing/logOut';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
