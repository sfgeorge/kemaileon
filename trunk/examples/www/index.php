<?php

$masked_email = '';
if (isset($_POST['email']))
{
    /** include the Kemaileon class **/
    @include_once('../../src/includes/Kemaileon.class.php');
    if (!class_exists('Kemaileon'))
    {
        die("Error: Kemaileon could not be found.");
    }

    $email = getPostVar('email');


    //mask the e-mail using Kemaileon.  'class="boxedstyle"' will be added to the A tag.
    //Kemaileon::setShowPHPHint(true);
	$masked_email = Kemaileon::mask($email, 'class="cssboxedstyle"');
}


// This function simply strips slashes (\') from form data.
function getPostVar($varname)
{
    if (get_magic_quotes_runtime() == 0)
    {
        return $_POST[$varname];
    }
    return stripslashes($_POST[$varname]);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Kemaileon Example #1</title>
<meta http-equiv="Content-Type" content="text/HTML; charset=iso-8859-1" />
<meta name="Description" content="An email address obfuscator that works without requiring JavaScript" />
<meta name="Keywords" content="email, obfuscation, email address, javascript, spam, bots, crawlers" />
<meta name="author" content="Stephen F. George" />
<style type="text/css"><!--
.cssboxedstyle
{
    background-color: #e6e6e6;
    padding: 3px;
    border: 1px solid #999;
}

a { text-decoration: none }
a:link { color: #0000ff }
a:active { color: #990000 }
a:hover { color: #000066 }
a:visited {  color: #336699 }
body, td, p, ul, li { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: normal; color: #000000 }
h3 { font-size: 13pt }
h3 { font-size: 11pt }

--></style>
</head>
<body>

 	<h3 align="center">Kemaileon Example #1</h3>

<p>&nbsp;</p>

	<form id="emailform" name="emailform" action="" method="post">
		<p><b>Enter an e-mail address:</b>&nbsp;&nbsp; <input type="text" size="30" id="email" name="email" />
			<br />&nbsp;
			<br /><input type="submit" size="30" value="Submit" /></p>

<?php
if ($masked_email)
{
	$html_safe_masked_email = htmlspecialchars($masked_email);

echo <<<HEREDOC
		<hr />

		<h4 align="center">Result:</h4>

		<p align="center">{$masked_email}</p>
		<p align="center"><b>Copy html:</b>&nbsp;&nbsp; <input type="text" id="result" name="result" size="75" value="{$html_safe_masked_email}" /></p>
HEREDOC;
}
?>

	</form>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


<script language="JavaScript" type="text/javascript"><!--
    if (document.forms['emailform'])
    {
        if (document.forms['emailform'].result)
        {
            document.forms['emailform'].result.focus();
            document.forms['emailform'].result.select();
        }
        else if (document.forms['emailform'].email)
        {
            document.forms['emailform'].email.focus();
        }
    }
// --></script>

</body>
</html>
