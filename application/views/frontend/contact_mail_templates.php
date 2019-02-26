<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title></title>
    </head>

    <body style="background-color: #eee; padding: 20px">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"  style="font-family:Helvetica, Arial,serif;">

            <tr>
                <td>
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color: #fff; ">
                        <tr>
                            <td width="40"></td>
                            <td width="520">
                                <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">

                                    <tr><td height="30"></td></tr>

                                    <tr>
                                        <td valign="top">

                                            <div>
                                                <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                                                    <tr>
                                                        <td valign="top" align="center">
                                                            <div>
                                                                <div>
                                                                    <p style="text-align:center; margin: 0"><a href="<?= $site_url; ?>" target="_blank"><img src="<?= $logo_url; ?>" style="text-align: center; padding-bottom: 10px; background: #cf9b67 none repeat scroll 0 0;" title="" alt=""></a></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr><td height="10"></td></tr>
                                                    <tr><td  style="border-bottom:1px solid #DDDDDD;"></td></tr>
                                                </table>
                                            </div>

                                            <div>
                                                <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                                                    <tr><td height="15"></td></tr>
                                                    <tr>
                                                        <td align="left">
                                                            <div>
                                                                <div>
                                                                    <p style=";color:#464646; margin-bottom: 0">Hello,</p>
                                                                    <p style=";color:#464646; font-size: 14px; margin: 5px 0 15px; line-height: 18px">You have received an contact email from <strong><?php echo $name; ?></strong> with following information.</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <table cellpadding="" bgcolor="" align="left">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <h4 style="margin: 0; color:#464646;margin-bottom: 0px">Contact Info:</h4>												
                                                                                <p style="font-size: 14px; line-height: 20px; color:#464646; margin-top: 5px ">
                                                                                    <strong>Name :</strong> <?php echo $name; ?><br>
                                                                                    <!--<strong>Subject :</strong> <?php // echo $subject; ?><br>-->
                                                                                    <strong>Email :</strong> <?php echo $email; ?><br>
                                                                                    <strong>Mobile Number:</strong> <?php echo $phone; ?><br>
                                                                                    <strong>Message:</strong> <?php echo $message; ?>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class="clear"></div>

                                                        </td>
                                                    </tr>

                                                </table>
                                            </div>

                                            <div>
                                                <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                                                    <tr><td height="20"></td></tr>
                                                    <tr><td  style="border-bottom:1px solid #DDDDDD;"></td></tr>

                                                    <tr><td height="10"></td></tr>

                                                    <tr>
                                                        <td>
                                                            <div style="font-size: 12px">&copy; <?php echo date('Y'); ?> <a href="<?= $site_url; ?>" target="_blank" style="color: #007894; text-decoration: none "><?= $project_title; ?></a>&nbsp; All Rights Reserved.</div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                        </td>
                                    </tr>

                                </table>
                            </td>
                            <td width="40"></td>
                        </tr>
                        <tr><td width="60">&nbsp;</td></tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>