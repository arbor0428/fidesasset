<?
session_start();
/*
session_unregister("ses_member_id");
session_unregister("ses_member_name");
session_unregister("ses_member_type");
session_unregister("ses_member_pwd");
*/
unset($_SESSION["ses_member_id"]);
unset($_SESSION["ses_member_name"]);
unset($_SESSION["ses_member_type"]);
unset($_SESSION["ses_member_pwd"]);
unset($_SESSION["ses_member_userType"]);

if($next_url)		echo ("<script language='javascript'>location.href='$next_url';</script>");
else	header("Location:/");

?>
