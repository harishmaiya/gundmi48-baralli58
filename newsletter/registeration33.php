<?php $message .= '<table class=\"ui-sortable-handle currentTable\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"'.base_url().'images/logo/'.$logo.'\" alt=\"'.$meta_title.'\" width=\"200\" /></td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that '.$first_name.' '.$last_name.' just booked '.$rental_name.', for the booking # '.$bookingNo.' with '.$renter_fname.' '.$renter_lname.'</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"'.base_url().'rental/'.$prd_id.'\"><img style=\"width: 300px;\" src=\"'.$rental_image.'\" alt=\"\" /> '.$rental_name.'</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th>
<th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">'.$checkin.'</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">'.$checkout.'</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"5\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">'.$first_name.' '.$last_name.'</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">'.$ph_no.'</td>
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
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" align=\"left\" valign=\"top\" width=\"300px\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">USD&nbsp;'.$price.'*'.$noofnights.' Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\">'.$symbol.'&nbsp;'.$amount.'</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\">'.$symbol.'&nbsp;'.$serviceFee.'</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Discount Amount(-)</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">'.$symbol.' '.$discount_amount.'</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">'.$symbol.'&nbsp;'.$netamount.'</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"50\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>';  ?>