<?php $message .= '<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"'.base_url().'images/logo/'.$logo.'\" alt=\"logo\" width=\"200\" />&nbsp; &nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Great news! You have a reservation request from '.$travellername.'.</td>
</tr>
<tr>
<td height=\"40\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">'.$travellername.' would like to stay at '.$product_name.' from '.$checkindate.' through '.$checkoutdate.'</td>
</tr>
<tr>
<td height=\"40\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">
<h4>Based on your rate of <span>'.$symbol.'</span> '.$price.' per night along with Renters fees, your potential payout for this reservation is <span>'.$symbol.'&nbsp;</span>'.$totalprice.'.</h4>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"'.base_url().'inbox\">Accept /  Decline</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<p style=\"margin: 0px; padding: 8px 10px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; background: #f1f1f1;\">Reservation Request</p>
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">'.$checkindate.'</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">'.$checkoutdate.'</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style=\"margin-top: 19px; display: block; padding: 0px 20px;\">
<td style=\"color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 12px;\" align=\"left\" valign=\"middle\"><span>'.$travellername.'</span>\'s reservation request will expire after 24 hours if you don\'t officially accept or decline it.</td>
</tr>
<tr style=\"margin-top: 19px; display: block; padding: 0px 20px;\">
<td style=\"color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 12px;\" align=\"left\" valign=\"middle\">We encourage you to respond as quickly as possible so your guest can begin to plan their adventure!</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"middle\"><a style=\"color: #0094aa; text-decoration: none;\" href=\"#\">(Remember: Not responding to this booking will result in your listing being ranked lower.)</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
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
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>';  ?>