<?php
define('TAX_RATES',
	array(
	'Single' => array(
	  'Rates' => array(10,15,25,28,33,35,39.6),
	  'Ranges' => array(0,9275,37650,91150,190150,413350,415050),
	  'MinTax' => array(0,927.50,5183.75,18558.75,46278.75,119934.75,120529.75)
	  ),
	'Married_Jointly' => array(
	  'Rates' => array(10,15,25,28,33,35,39.6),
	  'Ranges' => array(0,18550,75300,151900,231450,413350,466950),
	  'MinTax' => array(0,1855.00,10367.50,29517.50,51791.50,111818.50,130578.50)
	  ),
	'Married_Separately' => array(
	  'Rates' => array(10,15,25,28,33,35,39.6),
	  'Ranges' => array(0,9275,37650,75950,115725,206675,233475),
	  'MinTax' => array(0,927.50,5183.75,14758.75,25895.75,55909.25,65289.25)
	  ),
	'Head_Household' => array(
	  'Rates' => array(10,15,25,28,33,35,39.6),
	  'Ranges' => array(0,13250,50400,130150,210800,413350,441000),
	  'MinTax' => array(0,1325.00,6897.50,26835.00,49417,116258.50,125936)
	  )
  )
);
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
    <?php
	//PrintTaxTables();
	PrintTheTax($TaxableIncome);

	PrintTheTable($TaxableIncome);

    displayTaxTables();

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
						<td>".incomeTax('Single', $TaxableIncome)."</td>
					</tr>
					<tr>
						<td>Married Filing Jointly</td>
						<td>".incomeTax('Married_Jointly', $TaxableIncome)."</td>
					</tr>
					<tr>
						<td>Married Filing Separately</td>
						<td>".incomeTax('Married_Separately', $TaxableIncome)."</td>
					</tr>
					<tr>
						<td>Head of Household</td>
						<td>".incomeTax('Head_Household', $TaxableIncome)."</td>
					</tr>
				</table>";
	}

	function PrintTheTax($TaxableIncomeIn)
	{
		if($TaxableIncomeIn != null)
			echo "With a net taxable income of $".$TaxableIncomeIn;

		return;
	}
	function incomeTax($filingStatus,$TaxableIncomeIn)
	{
		$RangeHigh = 0.0;
		$RangeLow = 0.0;
		$SelectedIndex = -1;
		$returnTaxes = 0.0;

		for( $index = 0; $index < 7; $index++)
		{

			if($index == 6)
			{
				if( $TaxableIncomeIn >= $RangeLow )
				{
					$SelectedIndex = $index;
					break;
				}
			}
			else if($index == 0)
			{
				$RangeHigh = TAX_RATES[$filingStatus]['Ranges'][$index+1];
				$RangeLow = TAX_RATES[$filingStatus]['Ranges'][$index];
				if( $TaxableIncomeIn >= $RangeLow && $TaxableIncomeIn <= $RangeHigh)
				{
					$SelectedIndex = $index;
					break;
				}
				$RangeLow = $RangeHigh + 1.0;
			}
			else
			{
				$RangeHigh = TAX_RATES[$filingStatus]['Ranges'][$index+1];
				if( $TaxableIncomeIn >= $RangeLow && $TaxableIncomeIn <= $RangeHigh)
				{
					$SelectedIndex = $index;
					break;
				}

				$RangeLow = $RangeHigh + 1.0;
			}

		}

		if( $SelectedIndex > -1)
			$returnTaxes = CalculateTax($TaxableIncomeIn, TAX_RATES[$filingStatus]['MinTax'][$SelectedIndex],
															  TAX_RATES[$filingStatus]['Ranges'][$SelectedIndex],
																  TAX_RATES[$filingStatus]['Rates'][$SelectedIndex]);

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

    function displayTaxTables(){

        echo "<h2>2016 Tax Tables</h2><br>";

        foreach( TAX_RATES as $keyFilingStatus => $FilingStatus )
        {

            echo "<h3>".$keyFilingStatus."</h3><br>";
            echo "<table>
					<tr>
						<th>Taxable Income</th>
						<th>Tax Rate</th>
					</tr>";
            $dataCount = count(TAX_RATES[$keyFilingStatus]['Rates']);
            for($indexRow=0; $indexRow < $dataCount;$indexRow++ )
            {
                echo "<tr> <td>";

                if($indexRow == 0)
                {
                    echo "$".TAX_RATES[$keyFilingStatus]['Ranges'][0]." - $".TAX_RATES[$keyFilingStatus]['Ranges'][1]."</td>";
                    echo "<td>".TAX_RATES[$keyFilingStatus]['Rates'][0]."%</td>";
                }
                else if($indexRow == $dataCount-1)
                {
                    $bottRangeValue = TAX_RATES[$keyFilingStatus]['Ranges'][$indexRow] + 1;
                    echo "$".$bottRangeValue." or more </td>";
                    echo "<td>$".TAX_RATES[$keyFilingStatus]['MinTax'][$indexRow]." plus "
                    .TAX_RATES[$keyFilingStatus]['Rates'][$indexRow]."% of the amount over $".TAX_RATES[$keyFilingStatus]['Ranges'][$indexRow]."</td>";
                }
                else
                {
                    $bottRangeValue = TAX_RATES[$keyFilingStatus]['Ranges'][$indexRow] + 1;
                    echo "$".$bottRangeValue." - $".TAX_RATES[$keyFilingStatus]['Ranges'][$indexRow+1]."</td>";
                    echo "<td>$".TAX_RATES[$keyFilingStatus]['MinTax'][$indexRow]." plus "
                        .TAX_RATES[$keyFilingStatus]['Rates'][$indexRow]."% of the amount over $".TAX_RATES[$keyFilingStatus]['Ranges'][$indexRow]."</td>";

                }

                echo "</tr>";

            }

            echo "</table>";

        }//end foreach( TAX_RATES as $keyFilingStatus => $FilingStatus )

    }


    ?>
</body>
</html>
