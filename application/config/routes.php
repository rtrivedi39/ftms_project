  <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
/* common front page */
$route['default_controller'] = "site/home";
$route['home'] = "site/home";
$route['login'] = "site/home/login_user";
$route['logout'] = "site/home/logout";
$route['forgote_password'] = "site/home/forgote_password";
$route['reset_password'] = "site/home/reset_password";
$route['password_change'] = "site/home/reset_forgote_password";
$route['admin/dashboard'] = "admin/Admin_dashboard";
$route['dashboard'] = "dashboard/common_dashboard";
/*End*/


// $route['admin/sections'] = "admin/admin_sections";
$route[ADMIN_URL.'/sections'] = "admin_sections_master";
$route[ADMIN_URL.'/add_section'] = "admin_sections_master/manage_section";
$route[ADMIN_URL.'/edit_section/(:any)'] = "admin_sections_master/manage_section/$1";
$route[ADMIN_URL.'/delete_section/(:any)']  = "admin_sections_master/delete_section/$1";

// $route['admin/section/add_section/(:any)']  = "admin/admin_sections/manage_section/$1";


$route['admin/changepassword'] = "admin/admin_dashboard/editpassword";
$route['admin/profile'] = "admin/admin_dashboard/profile";
/*Unite Master */
$route['admin/unit'] = "admin/admin_unit";
$route['admin/manage_unit/(:any)']  = "admin/admin_unit/manage_unit/$1";
$route['admin/add_unit']  = "admin/admin_unit/manage_unit";
$route['admin/delete_unit/(:any)']  = "admin/admin_unit/delete_unit/$1";

/*Admin District*/
$route['admin/district'] = "admin/admin_district";
$route['admin/manage_district/(:any)'] = "admin/admin_district/manage_district/$1";
$route['admin/add_district']  = "admin/admin_district/manage_district";
$route['admin/district_delete/(:any)']  = "admin/admin_district/district_delete/$1";
/*End*/

/*Admin Tahsil*/
$route['admin/tahsil/index/(:any)'] = "admin/admin_tahsil/index/$1";
$route['admin/manage_tahsil/(:any)'] = "admin/admin_tahsil/manage_tahsil/$1";
$route['admin/add_tahsil/index/(:any)']  = "admin/admin_tahsil/manage_tahsil/$1";
$route['admin/tahsil_delete/(:any)']  = "admin/admin_tahsil/tahsil_delete/$1";
/*End*/

/*Admin taluka*/
$route['admin/taluka/index/(:any)'] = "admin/admin_taluka/index/$1";
$route['admin/manage_taluka/(:any)/(:any)'] = "admin/admin_taluka/manage_taluka/$1/$2";
$route['admin/add_taluka/(:any)']  = "admin/admin_taluka/manage_taluka/$1";
$route['admin/taluka_delete/(:any)']  = "admin/admin_taluka/taluka_delete/$1";
/*End*/

/*Admin Division*/
$route['admin/division'] = "admin/admin_division";
$route['admin/manage_division/(:any)'] = "admin/admin_division/manage_division/$1";
$route['admin/add_division']  = "admin/admin_division/manage_division";
$route['admin/division_delete/(:any)']  = "admin/admin_division/division_delete/$1";
/*End*/

/*Admin User */
$route[ADMIN_URL.'/employees'] = "admin_users";
$route[ADMIN_URL.'/add_employee'] = "admin_users/manage_user";
$route[ADMIN_URL.'/edit_employee/(:any)'] = "admin_users/manage_user/$1";

/*Admin Employee Role*/
$route[ADMIN_URL.'/employeerole'] = "admin_employeerole_master";
$route[ADMIN_URL.'/add_employeerole'] = "admin_employeerole_master/manage_employeerole";
$route[ADMIN_URL.'/edit_employeerole/(:any)'] = "admin_employeerole_master/manage_employeerole/$1";
/*End*/

/*Admin Department*/
$route['admin/department'] = "admin/admin_department";
$route['admin/manage_department/(:any)'] = "admin/admin_department/manage_department/$1";
$route['admin/add_department']  = "admin/admin_department/manage_department";
/*End*/


//RP
$route['add_file'] = "manage_file/files/index";
//$route['dashboard/show_file'] = "view_file/crviewfile";
$route['show_file/(:any)'] = "view_file/crviewfile/$1";
$route['dashboard/add_file'] = "manage_file/files/manage_files";
$route['dashboard/edit_file/(:any)'] = "manage_file/files_edit/index/$1";
//$route['dashboard/editFile/(:any)'] = "manage_file/files_edit/update_files/$1";
//$route['dashboard/receive_edit/(:any)'] = "manage_file/files_edit/receivebycr/$1";
/*End*/

/*Admin Notice*/
$route[ADMIN_URL.'/notice'] = "admin_notice_master";
$route[ADMIN_URL.'/add_notice'] = "admin_notice_master/manage_notice";
$route[ADMIN_URL.'/delete_notice/(:any)'] = "admin_notice_master/notice_delete/$1";
$route[ADMIN_URL.'/edit_notice/(:any)'] = "admin_notice_master/manage_notice/$1";
/*End*/

/*View files*/
$route['return_file'] = "view_file/crviewfile";
$route['File/work/(:any)'] = "view_file/senttoda_action/$1";
/*End*/

/*Dealing assistance*/
$route['dashboard/dealing/(:any)'] = "manage_file/dealing_manage_files/index/$1";
$route['dashboard/save_dealing/(:any)'] = "manage_file/dealing_manage_files/manage_files/$1";
$route['dashboard/save_dealing_procedution/(:any)'] = "manage_file/dealing_manage_files/save_manage_file_proceqution/$1";
/*End*/

/* leave */
$route['leave/cancel/(:any)'] = "leave/cancel_leave/$1";
$route['leave/print/(:any)'] = "leave/print_leave/$1";
$route['leave/employee_list'] = "leave/leave_approve/getEmployeeLeave";
$route['leave/employee_search'] = "leave/leave_approve/employeeLeave";
$route['leave/approve_list'] = "leave/approve_deny_secretary";
$route['leave/leave_details/(:any)'] = "leave/leave_details/index/$1";
$route['leave/under_employees/(:any)'] = "leave/leave/under_employees/$1";


/*Code Bij 01/08/2015*/
$route[ADMIN_URL.'/department_posts'] = "admin_department_post_master";
$route[ADMIN_URL.'/edit_post/(:any)'] = "admin_department_post_master/manage_post/$1";

$route[ADMIN_URL.'/employee_otherwork'] = "admin_upper_level_work_master";
$route[ADMIN_URL.'/edit_otherwork/(:any)'] = "admin_upper_level_work_master/manage_otherwork/$1";

$route[ADMIN_URL.'/notesheets'] = "admin_notesheet_master";
$route[ADMIN_URL.'/edit_notesheet/(:any)'] = "admin_notesheet_master/manage_notesheet/$1";
$route[ADMIN_URL.'/add_notesheet'] = "admin_notesheet_master/manage_notesheet";

$route[ADMIN_URL.'/notesheet_master_menu'] = "admin_notesheet_type_master";
$route[ADMIN_URL.'/edit_notesheet_master_menu/(:any)'] = "admin_notesheet_type_master/manage_notesheet_mastmenu/$1";
$route[ADMIN_URL.'/add_notesheet_master_menu'] = "admin_notesheet_type_master/manage_notesheet_mastmenu";
$route[ADMIN_URL.'admin_notesheet_master/get_file_notesheet/(:num)/(:any)'] = 'admin_notesheet_master/get_file_notesheet/$1/$2';
/*End of Code Bij 01/08/2015*/
$route['first_reset_password'] = "reset_password";
/*Bij Code added 06/08/2015*/

$route['attached/file_doc/(:any)'] = "view_file/dealing_file/notesheet_files/$1";
$route['Attached/Doc_File/(:any)'] = "view_file/dealing_file/notesheet_files/$1";
/*Rohit*/
$route['attached/doc_file/(:any)'] = "view_file/dealing_file/notesheet_files/$1";
/* home footer links */
$route['faq'] = "site/home/faq";
$route['privacy_policy'] = "site/home/privacy_policy";
$route['departmental_setup'] = "site/home/departmental_setup";
$route['faq'] = "site/home/faq";
/*end*/
$route['moniter/files/close'] = "view_file/file_moniter";
$route['moniter/files'] = "view_file/file_moniter";
$route['user_activity'] = "user_activity/activity";
$route['activity_details/(:any)'] = "user_activity/activity/activity_details/$1";

/*Bij 22-08-2015*/
$route['pa/list'] = "pa_permission";
$route['pa/assign_permission'] = "pa_permission/assign_permission";
/*End Bij 22-08-2015*/
$route['data_entry/insert_petition/(:any)'] = "data_entry/entry_by_section/index/$1";
$route['data_entry/modify_petition/(:any)'] = "data_entry/entry_by_section/data_insert_petition/$1";
$route['reports'] = "activity_report/index";
$route['reports/moniter'] = "activity_report/file_moniter";
$route['individual_reports'] = "activity_report/individual_reports";
$route['work_done_report'] = "activity_report/work_done_report";
/*Admin leave level master*/

$route['admin/leave_levels'] = "admin/leave_levels";
$route['admin/add_leave_levels']  = "admin/leave_levels/manage_leave_levels";
$route['admin/manage_leave_levels/(:any)'] = "admin/leave_levels/manage_leave_levels/$1";
$route['admin/delete_level_lists/(:any)'] = "admin/leave_levels/delete_level_lists/$1";
//for link file
$route['view_file/file_link/(:any)/(:any)'] = "view_file/file_search/index/$1/$2";

/*End*/

$route['admin/heads'] = "admin_head_master";
$route['admin/manage_heads']  = "admin_head_master/manage_head";
$route['admin/edit_heads/(:any)']  = "admin_head_master/manage_head/$1";
$route['admin/delete_head/(:any)']  = "admin_head_master/delete_head/$1";

/*14-09-2015*/
$route['permission/allot'] = "pa_permission/permission_to_employee";
$route['permission/delete/(:any)'] = "pa_permission/delete_permission/$1";
$route['permission/alloted_files'] = "pa_permission/delete_permission";
$route['today/files'] = "view_file/assign_other_employees_files/$1";
/*End 14-09-2015*/

/*Begin 29_09_2015*/
$route['add/file'] = "pa_permission/add_file";
$route['manage/file'] = "pa_permission/manage_files";
/*End 29_09_2015*/

/*Begin 1-10-2015 Bij Drafting*/
$route['drafting/dealing/file/(:any)'] = "view_file_legislative/dealing_manage_files/index/$1";
$route['drafting/save_dealing/(:any)'] = "view_file_legislative/manage_file_drafting/manage_files/$1";
$route['drafting/file/work/(:any)'] = "view_file_legislative/view_file_drafting/senttoda_action/$1";
$route['drafting/files'] = "view_file_legislative/view_file_drafting/index";
$route['drafting/files/(:any)'] = "view_file_legislative/view_file_drafting/index/$1";
$route['drafting/receive_by_officer/(:any)'] = "manage_file_legislative/manage_file_drafting/receive_file_sectionno/$1";

/*Begin 12-10-2015*/
$route['add/rti_file'] = "rti_manage_file/add_file";
$route['edit/rti_file/(:any)'] = "rti_manage_file/add_file/$1";
$route['rti/view_file'] = "rti_manage_file/view_created_file";
$route['manage/rti_file'] = "rti_manage_file/manage_files";
$route['manage/rti_file/(:any)'] = "rti_manage_file/update_files/$1";
$route['edit/update_rtifiles_da/(:any)'] = "rti_manage_file/add_file/$1";
$route['manage/rti_file_da/(:any)'] = "rti_manage_file/update_files_from_da/$1";
$route['rti/notreceive_file'] = "rti_manage_file/notreceive_file";
$route['rti/view_officer_file'] = "rti_manage_file/view_officer_file";
$route['rti/show_all_rti'] = "rti_manage_file/created_file_list";
/*End 12-10-2015*/

/* End of file routes.php */
$route['attached/file_doc_legis/(:any)'] = "view_file_legislative/dealing_file/notesheet_files/$1";
$route['Attached/Doc_File_legis/(:any)'] = "view_file_legislative/dealing_file/notesheet_files/$1";

$route['return_file_legis'] = "view_file_legislative/crviewfile";
$route['File/work_legis/(:any)'] = "view_file_legislative/senttoda_action/$1";

$route['dashboard/dealing_legis/(:any)'] = "manage_file_legislative/dealing_manage_files/index/$1";
$route['dashboard/save_dealing_legis/(:any)'] = "manage_file_legislative/dealing_manage_files/manage_files/$1";
$route['dashboard/save_dealing_procedution_legis/(:any)'] = "manage_file_legislative/dealing_manage_files/save_manage_file_proceqution/$1";

$route['send_file_return'] = "view_file/send_file_return";

$route['officer_employee_report/(:any)'] = "activity_report/employee_officer_report/$1";
/* Establishment section*/
//for add category


/* Begin  sulbha  02-11-2015 */
$route['establishment/category'] = "establishment/est_master_category";
$route['establishment/add_category'] = "establishment/est_master_category/manage_category";
$route['establishment/managecategory'] = "establishment/est_master_category/manage_category";
$route['establishment/edit_category/(:any)'] = "establishment/est_master_category/manage_category/$1";
$route['establishment/delete_category/(:any)'] = "establishment/est_master_category/delete_category/$1";
//for subcategory
$route['establishment/subcategory/(:any)'] = "establishment/est_master_category/addsub_category/$1";
$route['establishment/view_subcategory/(:any)'] = "establishment/est_master_category/viewsub_category/$1";
$route['establishment/edit_subcategory/(:any)'] = "establishment/est_master_category/addsub_category/$1/$2";
$route['establishment/delete_subcategory/(:any)'] = "establishment/est_master_category/delete_subcategory/$1/$2";
//for add work to employee
$route['establishment/work_allote'] = "establishment/est_master_category/work_allote";
$route['establishment/add_work'] = "establishment/est_master_category/manage_work_allote";
$route['establishment/edit_work/(:any)'] = "establishment/est_master_category/manage_work_allote/$1";
//for create new form
$route['establishment/create_form/(:any)'] = "establishment/forms/$1";
$route['establishment/add_from/(:any)'] = "establishment/forms/add_from/$1";
//for complaints
$route['establishment/complaints'] = "establishment/complaint";
$route['establishment/add_complaints'] = "establishment/complaint/add_complaint";
$route['establishment/finish_complaint/(:any)'] = "establishment/complaint/finish_complaint/$1";
$route['establishment/view_complaint/(:any)'] = "establishment/complaint/view_complaint/$1";
$route['establishment/print_complaint/(:any)'] = "establishment/complaint/print_complaint/$1";

$route['officer/auto_login'] = "site/home/auto_login_user";

/*Code added by bij 3 11 2015*/
$route['officer_employee_report/(:any)'] = "activity_report/employee_officer_report/$1";
$route['show/(:any)'] = "dashboard/common_dashboard/show_detail/$1";

$route['camra'] = "dashboard/common_dashboard/show_camra";
$route['biomartrics'] = "dashboard/common_dashboard/show_biomartrics";
$route['advocate/repor_view/(:any)'] = "advocates/repor_view/$1";
$route['advocate/report_view_agp_gp'] = "advocates/report_view_agp_gp";
$route['advocate/list/(:any)'] = "advocates/index/$1";
$route['advocate/add/(:any)'] = "advocates/manage_advocate/$1";
$route['advocate/edit_advocate/(:any)'] = "advocates/edit_advocate/$1";
$route['advocate/post/add'] = "advocates/advocates_posts/manage_advocate_post";
$route['advocate/post'] = "advocates/advocates_posts";
$route['advocate/edit_post/(:any)'] = "advocates/advocates_posts/manage_advocate_post/$1";
$route['report/file_report'] = "activity_report/file_report";
$route['advocate/delete_char_certificate/(:any)'] = "advocates/delete_char_certificate/$1";
$route['advocate/delete_records/(:any)'] = "advocates/delete_records/$1";
$route['advocate/report'] = "advocates/advocate_report";
$route['advocate/advocate_report/(:any)'] = "advocates/reports_advocate/index/$1";
$route['advocate/delete_records_agp_gp/(:any)'] = "advocates/delete_records_agp_gp/$1";
$route['advocate/delete_posting_master/(:any)/(:any)'] = "advocates/delete_posting_master/$1/$2";

//for suggestions
$route['suggestions'] = "suggestions/suggestion";
$route['add_suggestion'] = "suggestions/suggestion/add_suggestion";
$route['finish_suggestion/(:any)'] = "suggestions/suggestion/finish_suggestion/$1";
$route['view_suggestion/(:any)'] = "suggestions/suggestion/view_suggestion/$1";
$route['print_suggestion/(:any)'] = "suggestions/suggestion/print_suggestion/$1";


//Scan files //
$route['scan_file'] = "scan_files/search_scan_file";
$route['scan/dealing/(:any)'] = "scan_files/scan_dealing_manage_files/index/$1";
$route['scan_file_open'] = "scan_files/scan_file_open";
$route['scan/save_dealing/(:any)'] = "scan_files/scan_dealing_manage_files/manage_files/$1";

$route['add_scan_files'] = "scan_files/files_scan_upolad";
$route['manage_scan_files'] = "scan_files/files_scan_upolad/manage_files";

$route['efile/(:any)'] = "draft/draft/efile_view/$1";

$route['scan_file/scan_dealing/(:any)'] = "scan_file_legislative/dealing_scan_files/index/$1";
$route['scan_file/save_dealing_legis/(:any)'] = "scan_file_legislative/dealing_scan_files/manage_files/$1";
$route['e-files/efile_sign'] = "e_filelist/efile_sign";
$route['establishment/scan_form'] = "establishment/scan_forms";
$route['establishment/scan_add_from/(:any)'] = "establishment/scan_forms/scan_add_from/$1";
/*New menu for E-file*/
$route['e-files/inbox'] = "e_filelist";
$route['e-files/sent'] = "e_filelist/sent";
$route['e-files/sent/(:any)'] = "e_filelist/sent/$1";
$route['e-files/working'] = "e_filelist/working";
 
/*Admin sub file type*/

$route[ADMIN_URL.'/sub_file_type'] = "sub_file_type";
$route[ADMIN_URL.'/add_sub_file_type'] = "sub_file_type/manage_sub_file_type";
$route[ADMIN_URL.'/sub_file_type_delete/(:any)'] = "sub_file_type/sub_file_type_delete/$1";
$route[ADMIN_URL.'/edit_sub_file_type/(:any)'] = "sub_file_type/manage_sub_file_type/$1";
/*End*/
/* pay bill */
$route['payroll/edit_billno/(:any)'] = "payroll/pay_bill/$1";
/*End*/

$route[ADMIN_URL.'/employee_vehicle'] = "admin_employee_vechilde";
$route[ADMIN_URL.'/add_vehicle'] = "admin_employee_vechilde/manage_vechilde";
$route[ADMIN_URL.'/edit_vehicle/(:any)'] = "admin_employee_vechilde/manage_vechilde/$1";
$route[ADMIN_URL.'/delete_vehicle/(:any)'] = "admin_employee_vechilde/delete_vehicle/$1";
$route[ADMIN_URL.'/manage_vechilde/(:any)'] = "admin_employee_vechilde/manage_vechilde/$1";
$route[ADMIN_URL.'/manage_vechilde'] = "admin_employee_vechilde/manage_vechilde";

$route[ADMIN_URL.'/teep_list'] = "admin_teep_master";
$route[ADMIN_URL.'/manage_teep'] = "admin_teep_master/manage_teep";
$route[ADMIN_URL.'/manage_teep/(:any)'] = "admin_teep_master/manage_teep/$1";
$route[ADMIN_URL.'/delete_teep/(:any)'] = "admin_teep_master/delete_teep/$1";

$route['establishment/service_forms/(:any)/(:any)'] = "est_service_module/gpfdpf_manage/index/$1/$/";
$route['establishment/user_service_forms/(:any)/(:any)'] = "est_service_module/gpfdpf_manage/index/$1/$/";
$route['establishment/edit_service_forms/(:any)'] = "est_service_module/gpfdpf_manage/index/$1";
$route['establishment/form_view/(:any)/(:any)'] = "est_service_module/gpfdpf_manage/view_fill_from/$1/$/";
$route['establishment/user_app_list/(:any)/(:any)'] = "est_service_module/app_list/$1/$2";

$route['establishment/user_bill_list/(:any)/(:any)'] = "est_service_module/app_bill_list/$1/$2";
$route['establishment/bill_list/(:any)'] = "est_service_module/app_bill_list/$1/$2";
$route['establishment/user_bill_forms/(:any)/(:any)'] = "est_service_module/local_bill_manage/index/$1/$/";
$route['establishment/edit_bill_forms/(:any)'] = "est_service_module/local_bill_manage/index/$1";

$route['establishment/bill_forms/(:any)/(:any)'] = "est_service_module/local_bill_manage/index/$1/$/";

$route['establishment/oth_bill_forms/(:any)'] = "est_service_module/local_bill_manage/addout_bills/$1/$/";


$route['moniter/files/(:any)'] = "view_file/file_moniter/index/$1";
/* End of file routes.php */ 
/* Location: ./application/config/routes.php */