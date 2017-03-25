<?php $message .= '<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"640\" bgcolor=\"#7da2c1\">
<tbody>
<tr>
<td style=\"padding: 40px;\">
<table style=\"border: #1d4567 1px solid; font-family: Arial, Helvetica, sans-serif;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"610\">
<tbody>
<tr>
<td><a href=\"'.base_url().'\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"'.base_url().'images/logo/'.$logo.'\" alt=\"'.$meta_title.'\" /></a></td>
</tr>
<tr>
<td valign=\"top\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#FFFFFF\">
<tbody>
<tr>
<td colspan=\"2\">
<h3 style=\"padding: 10px 15px; margin: 0px; color: #0d487a;\">Hi '.$first_name.' '.$last_name.', Your Rental request has been reviewed and booked.</h3>
<p style=\"padding: 0px 15px 10px 15px; font-size: 12px; margin: 0px;\">&nbsp;</p>
</td>
</tr>
<tr>
<td style=\"font-size: 12px; padding: 10px 15px;\" width=\"50%\" valign=\"top\">
<p><strong>Rental ID:</strong>'.$prd_id.'</p>
<p><strong>Rental Name:</strong>'.$rental_name.'</p>
<p><span><strong>Date of Arrival:</strong></span>'.$checkin.'</p>
<p><label id=\"InqArrDate-label\" class=\"inquiry-form-col is-quarter is-first\"><strong>Date of&nbsp;Departure:</strong>'.$checkout.'</label></p>
<p><label class=\"inquiry-form-col is-quarter is-first\"><strong>No of Days:</strong>'.$numofdates.'</label></p>
<p><label class=\"inquiry-form-col is-quarter is-first\"><strong>No of Guest:</strong>'.$NoofGuest.'</label></p>
<p><strong>Booking Status:</strong>'.$booking_status.'</p>
<p><label class=\"inquiry-form-col is-quarter is-first\"><strong>Owner Name:</strong>'.$renter_fname.' '.$renter_lname.'</label></p>
<p><label class=\"inquiry-form-col is-quarter is-first\"><strong>Owner Email:</strong>'.$owner_email.'</label></p>
<p><label class=\"inquiry-form-col is-quarter is-first\"><strong>Owner Phone Number:</strong>'.$owner_phone.'</label></p>
<p><strong>Message to owner:</strong></p>
<p>'.$Enquiry.'<strong><span><br /></span></strong></p>
<p>&nbsp;</p>
</td>
<td style=\"font-size: 12px; padding: 10px 15px;\" width=\"50%\" valign=\"top\">
<p><img src=\"'.$rental_image.'\" alt=\"\" width=\"100\" height=\"100\" /></p>
<p><strong>- '.$email_title.' Team</strong></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>';  ?>