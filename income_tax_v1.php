<?php
	if(isset($_POST['Submit'])){ //check if form was submitted
		$TaxableIncome = $_POST['inputTaxableIncome']; //get input text

	}
?>

<html>

    <head>
        <link rel="stylesheet" type="text/css" href="income_tax_v2.css" />
    </head>

	<body>

		<form action="#" method="post">
			<h4>Income Tax Calculator</h4>
			Your Net Income:
			<input type="text" name="inputTaxableIncome" />
			<br />
			<br />
			<input type="submit" name="Submit" />
		</form>
		<br />
		<?php PrintTheTax($TaxableIncome);

		  PrintTheTable($TaxableIncome);

		  function PrintTheTable($TaxableIncome)
		  {
			  if($TaxableIncome == null)
				  return;
			  echo "
				<table>
					<tr>
						<th>Status</th>
						<th>Tax</th>
					</tr>
					<tr>
						<td>Single</td>
						<td>".incomeTaxSingle($TaxableIncome)."</td>
					</tr>
					<tr>
						<td>Married Filing Jointly</td>
						<td>".incomeTaxMarriedJointly($TaxableIncome)."</td>
					</tr>
					<tr>
						<td>Married Filing Separately</td>
						<td>".incomeTaxMarriedSeparately($TaxableIncome)."</td>
					</tr>
					<tr>
						<td>Head of Household</td>
						<td>".incomeTaxHeadOfHousehold($TaxableIncome)."</td>
					</tr>
				</table>";
		  }

		  function PrintTheTax($TaxableIncomeIn)
		  {
			  if($TaxableIncomeIn != null)
				  echo "With a net taxable income of $".$TaxableIncomeIn;
			  return;
		  }

		  function incomeTaxSingle($TaxableIncomeIn)
		  {
			  if($TaxableIncomeIn == null)return 0.0;
			  $returnTaxes = 0.0;
			  if( $TaxableIncomeIn >= 0 && $TaxableIncomeIn <= 9275 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 0, 0, 10);

			  else if( $TaxableIncomeIn >= 9276 && $TaxableIncomeIn <= 37650 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 927.50, 9275, 15);

			  else if( $TaxableIncomeIn >= 37651 && $TaxableIncomeIn <= 91150 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 5183.75, 37650, 25);

			  else if( $TaxableIncomeIn >= 91151 && $TaxableIncomeIn <= 190150 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 18558.75, 91150, 28);

			  else if( $TaxableIncomeIn >= 190151 && $TaxableIncomeIn <= 413350 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 46278.75, 190150, 33);

			  else if( $TaxableIncomeIn >= 413351 && $TaxableIncomeIn <= 415050 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 119934.75, 413350, 35);

			  else if( $TaxableIncomeIn >= 415051)
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 120529.75, 415050, 39.6);

			  return $returnTaxes;
		  }

		  function incomeTaxMarriedJointly($TaxableIncomeIn)
		  {
			  if($TaxableIncomeIn == null)return 0.0;
			  $returnTaxes = 0.0;
			  if( $TaxableIncomeIn >= 0 && $TaxableIncomeIn <= 18550 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 0, 0, 10);

			  else if( $TaxableIncomeIn >= 18551 && $TaxableIncomeIn <= 75300 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 1855, 18550, 15);

			  else if( $TaxableIncomeIn >= 75301 && $TaxableIncomeIn <= 151900 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 10367.50, 75300, 25);

			  else if( $TaxableIncomeIn >= 151901 && $TaxableIncomeIn <= 231450 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 29517.50, 151900, 28);

			  else if( $TaxableIncomeIn >= 231451 && $TaxableIncomeIn <= 413350 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 51791.50, 231450, 33);

			  else if( $TaxableIncomeIn >= 413351 && $TaxableIncomeIn <= 466950 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 111818.50, 413350, 35);

			  else if( $TaxableIncomeIn >= 466951)
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 130578.50, 466950, 39.6);

			  return $returnTaxes;
		  }

		  function incomeTaxMarriedSeparately($TaxableIncomeIn)
		  {
			  if($TaxableIncomeIn == null)return 0.0;
			  $returnTaxes = 0.0;
			  if( $TaxableIncomeIn >= 0 && $TaxableIncomeIn <= 9275 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 0, 0, 10);

			  else if( $TaxableIncomeIn >= 9276 && $TaxableIncomeIn <= 37650 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 927.50, 9275, 15);

			  else if( $TaxableIncomeIn >= 37651 && $TaxableIncomeIn <= 75950 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 5183.75, 37650, 25);

			  else if( $TaxableIncomeIn >= 75951 && $TaxableIncomeIn <= 115725 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 14758.75, 75950, 28);

			  else if( $TaxableIncomeIn >= 115726 && $TaxableIncomeIn <= 206675 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 25895.75, 115725, 33);

			  else if( $TaxableIncomeIn >= 206676 && $TaxableIncomeIn <= 233475 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 55909.25, 206675, 35);

			  else if( $TaxableIncomeIn >= 233476)
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 65289.25, 233475, 39.6);

			  return $returnTaxes;
		  }

		  function incomeTaxHeadOfHousehold($TaxableIncomeIn)
		  {
			  if($TaxableIncomeIn == null)return 0.0;
			  $returnTaxes = 0.0;
			  if( $TaxableIncomeIn >= 0 && $TaxableIncomeIn <= 13250 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 0, 0, 10);

			  else if( $TaxableIncomeIn >= 13251 && $TaxableIncomeIn <= 50400 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 1325, 13250, 15);

			  else if( $TaxableIncomeIn >= 50401 && $TaxableIncomeIn <= 130150 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 6897.50, 50400, 25);

			  else if( $TaxableIncomeIn >= 130151 && $TaxableIncomeIn <= 210800 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 26835, 130150, 28);

			  else if( $TaxableIncomeIn >= 210801 && $TaxableIncomeIn <= 413350 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 49417, 210800, 33);

			  else if( $TaxableIncomeIn >= 413351 && $TaxableIncomeIn <= 441000 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 116258.50, 413350, 35);

			  else if( $TaxableIncomeIn >= 441001 )
				  $returnTaxes = CalculateTax($TaxableIncomeIn, 125936, 441000, 39.6);

			  return $returnTaxes;
		  }


		  function CalculateTax( $TaxableIncomeIn,  $MinValueIn,  $MaxValueIn,  $PercentIn)
		  {
			  settype($TaxableIncomeIn, double);
			  settype($MinValueIn, double);
			  settype($MaxValueIn, double);
			  settype($PercentIn, double);

			  $DiffValue=$TaxableIncomeIn - $MaxValueIn;
			  if($DiffValue < 0.0)$DiffValue = 0.0;
			  return ($DiffValue*($PercentIn/100.0) + $MinValueIn);

		  }
		?>
	</body>
</html>
