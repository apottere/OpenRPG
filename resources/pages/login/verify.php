<div style="text-align: center;">
<br /><br /><br />
<h1>
	Your e-mail address has not been verified yet.
</h1>
<p>You should have recieved an e-mail with a verification code.  Insert the code below, or request another e-mail.</p>
<p class="error"><?php echo $error?></p>
<br />
<table class="noborder" align="center">
<form method="post">
<tr>
	<td><p>Code: <input type="text" name="id" /></p></td>
</tr>
<tr>
	<td>
		<input type="submit" name="verify" value="Verify" />
		<input type="submit" name="requestemail" value="New E-mail" />
		<input type="submit" name="cancelverify" value="Cancel" />
	</td>
</tr>

</form>
</table>
</div>
