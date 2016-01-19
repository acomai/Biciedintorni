<form id="opzioni" method="post" action="<?php echo $path;?>" name="opzioni">
<table border="1" align="center">
  <tr>
    <td colspan="2" bgcolor="#CCFFCC">Seleziona quali soci vuoi includere</td>
  </tr>
  <tr>
	<td>
		<input type="radio" name="approvati" value="1"/>Approvati<br>
		<input type="radio" name="approvati" value="2"/>Non Approvati<br>
		<input type="radio" name="approvati" value="3"/>Entrambi<br>
	</td>
	<td>
		<div><?php echo $stranni; ?></div>
<?php
$intSep = 0;
for ($i = 2007; $i <= date("Y"); $i++) 
{
	$intSep++;
    echo "		<input type=\"checkbox\" name=\"a".$i."\" value=\"1\"/>".$i;
	if ($intSep == 3)
	{
		echo "<br>";
		$intSep = 0;
	}
}	
?>
	</td>
  </tr>
  <tr>
	<td align="right" colspan="2">
		<input type="submit" value="Invia"/>
	</td>
  </tr>
</table>
</form>