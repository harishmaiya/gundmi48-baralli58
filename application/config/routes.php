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
neighborhood
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

/*Web Controllers*/
$route['default_controller'] = "site/landing";
$route['404_override'] = '';
$route['admin'] = "admin/adminlogin";
$route['signup'] = "site/user/signup_form";
$route['login'] = "site/user/login_form";
$route['logout'] = "site/user/logout_user";
$route['forgot-password'] = "site/user/forgot_password_form";
$route['checkout/(:any)'] = "site/checkout";
$route['order/(:any)'] = "site/order";
$route['order/ipnpayment'] = "site/order/ipnpayment";
$route['popular'] = "site/rentals/popular_list";
$route['property'] = "site/rentals/mapview/$1";
$route['property/(:any)'] = "site/rentals/mapview/$1";
$route['rental/(:any)'] = 'site/rentals/display_product_detail/$1';
$route['booking/(:any)'] = "site/rentals/rental_guest_booking";
$route['download'] = "admin/download/display_download";
$route['dashboard'] = "site/user_settings";
$route['inbox'] = "site/user_settings/inbox";
$route['new_conversation/(:any)'] = "site/user_settings/conversation/$1";
$route['listing/(:any)'] = "site/user_settings/dashboard_listing/$1";
$route['listing-reservation'] = "site/user_settings/dashboard_listing_reservation";
$route['listing-requirement'] = "site/user_settings/dashboard_listing_requirement";
$route['edit_inquiry_details/(:any)'] = "site/rentals/edit_inquiry_details/$1";
$route['trips/upcoming'] = "site/user_settings/dashboard_trips";
$route['trips/previous'] = "site/user_settings/dashboard_trips_prve";
$route['settings'] = "site/user_settings/display_user_settings";
$route['photo-video'] = "site/user/change_profile_photo_redirect";
$route['profile-photo'] = "site/user/change_profile_photo";
$route['verification'] = "site/user/verification";
$route['verification/(:any)'] = "site/user/verification/$1";
$route['display-review'] = "site/user_settings/display_review";
$route['display-review1'] = "site/user_settings/display_review1";
$route['account'] = "site/user_settings/dashboard_account";
$route['account-payout'] = "site/user_settings/dashboard_account_payout";
$route['account-trans'] = "site/user_settings/dashboard_account_trans";
$route['gross-earning'] = "site/user_settings/dashboard_account_trans";
$route['account-trans/(:any)'] = "site/user_settings/dashboard_account_trans/$1";
$route['account-trans/(:any)/(:any)/(:any)'] = "site/user_settings/dashboard_account_trans/$1/$2/$3";
$route['account-privacy'] = "site/user_settings/dashboard_account_privacy";
$route['account-security'] = "site/user_settings/dashboard_account_security";
$route['account-setting'] = "site/user_settings/dashboard_account_setting";
$route['users/edit/(:any)'] = "site/user_settings/user_edit/$1";
$route['users/show/(:any)'] = "site/user_settings/user_profile";
$route['list_space'] = "site/product/list_space";
$route['manage_listing/(:any)'] = "site/product/manage_listing/$1";
$route['space_listing/(:any)'] = "site/product/space_listing/$1";
$route['cancel_policy/(:any)'] = "site/product/cancel_policy/$1";
$route['cancel_policy_save/(:any)'] = "site/product/cancel_policy_save/$1";
$route['price_listing/(:any)'] = "site/product/price_listing/$1";
$route['overview_listing/(:any)'] = "site/product/overview_listing/$1";
$route['photos_listing/(:any)'] = "site/product/photos_listing/$1";
$route['amenities_listing/(:any)'] = "site/product/amenities_listing/$1";
$route['address_listing/(:any)'] = "site/product/address_listing/$1";
$route['detail_list/(:any)'] = "site/product/detail_list/$1";
$route['users/(:any)/wishlists'] = "site/wishlists";
$route['host-payment-success/(:any)'] = "site/product/hostpayment_success/$1";
$route['pages/(:num)/(:any)'] = "site/cms/page_by_id";
$route['pages/(:any)'] = "site/cms";
$route['order-review/(:num)/(:num)/(:any)'] = "site/user/order_review";
$route['order-review/(:num)'] = "admin/order/order_review";
$route['lang/(:any)'] = "site/product/language_change/$1";
$route['change-currency/(:any)'] = "site/product/change_currency/$1";
$route['payment-success'] = "admin/commission/display_payment_success";
$route['payment-failed'] = "admin/commission/display_payment_failed";
$route['invite-friends'] = "site/user/invite_friends";
$route['linkedinLogin'] = "site/invitefriend/login";
$route['cancel_request/(:any)'] = "site/bookings/cancel_request/$1";
$route['help'] = "site/help";
$route['help/(:any)'] = "site/help";
/*Web Controllers*/

/* Unwanted */
$route['user/(:any)/added'] = "site/user/display_user_added";
$route['user/(:any)/lists'] = "site/user/display_user_lists";
$route['user/(:any)/lists/(:num)'] = "site/user/display_user_lists_home";
$route['user/(:any)/lists/(:num)/followers'] = "site/user/display_user_lists_followers";
$route['user/(:any)/lists/(:num)/settings'] = "site/user/edit_user_lists";
$route['user/(:any)/wants'] = "site/user/display_user_wants";
$route['user/(:any)/owns'] = "site/user/display_user_owns";
$route['user/(:any)/following'] = "site/user/display_user_following/$1";
$route['user/(:any)/followers'] = "site/user/display_user_followers/$1";
$route['user/(:any)/things/(:any)/(:any)'] = "site/product/display_user_thing/$1/$2";
$route['user/(:any)/wishlists/(:any)/edit'] = "site/user/display_user_lists_edit";
$route['user/(:any)/wishlists/(:any)'] = "site/user/display_user_lists_home";
$route['user/(:any)/wishlistdelete/(:any)'] = "site/user/DeleteallWishList_New/$1/$2";
$route['user/(:any)'] = "site/user/display_user_profile/$1";
$route['contact-us'] = "site/cms/contactus_businesstravel";
$route['InsertProductImage'] = "site/product/InsertProductImage";
$route['city/search'] = "site/product/city_autocomplete";
$route['s/(:any)'] = "site/rentals/mapview/$1";
$route['search/search_text'] = 'site/product/search_text';
$route['undefinedsearch/search_text'] = 'site/product/search_text';
$route['send-confirm-mail'] = "site/user/send_quick_register_mail";
/* Unwanted */

/*Mobile Controllers*/
$route['json/currency_values'] = "site/mobile/currency_values";
$route['android/(:any)'] = "site/mobile/mobilePages";
$route['ios/(:any)'] = "site/mobile/mobilePages";
$route['json/list_values'] = "site/mobile/list_values";
$route['json/discover'] = "site/mobile/discoverfeatured";
$route['json/rental-list'] = "site/mobile/rental_list";
$route['json/mobile_wishlist'] = "site/mobile/mobile_wishlist";
$route['json/mobile_wishlistview'] = "site/mobile/mobile_wishlistview";
$route['json/mobile_listvalue'] = "site/mobile/mobile_list_value";
$route['json/mobile_update_list'] = "site/mobile/mobile_update_list";
$route['json/mobile_listview'] = "site/mobile/mobile_listview";
$route['json/country_list'] = "site/mobile/country_list";
$route['json/save_cancel_policy'] = "site/mobile/save_cancel_policy";
$route['json/save_minimum_stay'] = "site/mobile/save_minimum_stay";
$route['json/save_product_currency'] = "site/mobile/save_product_currency";
$route['json/language_list'] = "site/mobile/language_list";
$route['json/rental_detail'] = "site/mobile/rental_detail";
$route['json/search_detail'] = "site/mobile/search_detail";
$route['json/mobile_signup'] = "site/mobile/mobile_signup";
$route['json/mobile_login'] = "site/mobile/mobile_login";
$route['json/mobile_forgotpsd'] = "site/mobile/mobile_forgotpsd";
$route['json/search_filter'] = "site/mobile/search_filter";
$route['json/product_edit'] = "site/mobile/product_edit";
$route['json/mobile_updateprofile'] = "site/mobile/mobile_updateprofile";
$route['json/mobile_chat'] = "site/mobile/mobile_chat";
$route['json/mobile_chat_new'] = "site/mobile/mobile_chatnew";
$route['json/add_discussion_user'] = "site/mobile/add_discussion_user";
$route['json/mobile_chat_insert'] = "site/mobile/mobile_chat_insert";
$route['json/mobile_viewchat'] = "site/mobile/mobile_viewchat";
$route['json/mobile_viewchat_new'] = "site/mobile/mobile_viewchat_new";
$route['json/mobile_detailchat'] = "site/mobile/mobile_detailchat";
$route['json/mobile_detailchat_new'] = "site/mobile/mobile_detailchat_new";
$route['json/mobile_listspacetype'] = "site/mobile/mobile_listspacetype";
$route['json/mobile_hometype'] = "site/mobile/mobile_hometype";
$route['json/mobile_price_calculation'] = "site/mobile/mobile_price_calculation";
$route['json/mobile_host_request'] = "site/mobile/mobile_host_request";
$route['json/mobile_your_trips'] = "site/mobile/mobile_your_trips";
$route['json/mobile_your_reservation'] = "site/mobile/mobile_your_reservation";
$route['json/mobile_host_approval'] = "site/mobile/host_approval";
$route['json/mobile_host_decline'] = "site/mobile/host_decline";
$route['json/host_unlist_list'] = "site/mobile/host_unlist_list";
$route['json/host_delete_list'] = "site/mobile/host_delete_list";
$route['json/mobile_delete_image'] = "site/mobile/mobile_delete_image";
$route['json/transaction_history'] = "site/mobile/transaction_history_new";
$route['json/completed_trans_history'] = "site/mobile/completed_transaction_history";
$route['json/transaction_history_complete'] = "site/mobile/transaction_history_complete";
$route['json/add_to_favourite'] = "site/mobile/add_to_favourite";
$route['json/remove_from_favourite'] = "site/mobile/remove_from_favourite";
$route['json/get_payout'] = "site/mobile/get_payout";
$route['json/save_payout'] = "site/mobile/save_payout";
$route['json/verify_my_id'] = "site/mobile/verify_my_id";
$route['json/verify_my_mail'] = "site/mobile/verify_my_mail";
$route['json/list_space'] = "site/mobile/list_space_value";
$route['json/host_profile'] = "site/mobile/host_profile";
$route['json/credit_card_form'] = "site/mobilecart/credit_card_form";
$route['mobile/success/(:any)'] = "site/mobilecart/pay_success";
$route['mobile/property_success/(:any)'] = "site/mobilecart/property_success";
$route['mobile/failed/(:any)'] = "site/mobilecart/pay_failed";
$route['mobile/payment/(:any)'] = "site/mobilecart/payment_return";
$route['mobile/payment_complete/pay-completed'] = "site/mobilecart/payment_return";

/* wish list & review */
$route['json/review'] = "site/mobile/review";
$route['json/user_guide_review'] = "site/mobile/user_guide_review";
$route['json/add_to_review'] = "site/mobile/add_to_review";
$route['json/contact_host'] = "site/mobile/contact_host";
$route['json/add_review'] = "site/mobile/add_review";
$route['json/get_wishlist'] = "site/mobile/get_wishlist";
$route['json/create_wishlist'] = "site/mobile/create_wishlist";
$route['json/adding_to_wishlist'] = "site/mobile/adding_to_wishlist";
$route['json/edit_wishlist'] = "site/mobile/edit_wishlist";
$route['json/delete_wishlist'] = "site/mobile/delete_wishlist";
$route['json/remove_product'] = "site/mobile/remove_product";
$route['json/popular'] = "site/mobile/popular";
$route['json/user_wishlist_page'] = "site/mobile/user_wishlist_page";
$route['json/wishlist_detailpage'] = "site/mobile/wishlist_detailpage";
$route['json/confirmation_invoice'] = "site/mobile/confirmation_invoice";
$route['json/get_selected_lang'] = "site/mobile/get_selected_lang";
$route['json/calendar'] = "site/mobile/calendar";
$route['json/save_calendar'] = "site/mobile/save_calendar";
$route['json/change_password'] = "site/mobile/change_password";
$route['json/cancel_account'] = "site/mobile/cancel_account";
$route['json/property_payment'] = "site/mobile/property_payment";
$route['json/mobile_send_sms'] = "site/mobile/mobile_send_sms";
$route['json/mobile_phone_verification'] = "site/mobile/mobile_phone_verification";
$route['json/load_special_offer'] = "site/mobile/load_special_offer";
$route['json/send_special_offer'] = "site/mobile/send_special_offer";
$route['json/confirm_offer'] = "site/mobile/confirm_offer";
$route['json/delete_offer'] = "site/mobile/delete_offer";
$route['json/view_offer'] = "site/mobile/view_offer";
$route['json/timezone'] = "site/mobile/timezone";
/*Mobile Controllers*/
/* End of file routes.php */
/* Location: ./application/config/routes.php */
