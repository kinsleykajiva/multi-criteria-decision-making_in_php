<?php
		/**
		 *
		 */
		class MultiCriteriaDecisionMaking{
				public static $performance_score = array ();
				public static $thisObject = array ();
				
				/**
				 * This will normalise the non-bebeficial or Beneficial aspects of the matrix or data
				 *
				 * @param bool $isBeneficial
				 *
				 * @return void [type] [description]
				 */
				
				public  static function normalise ( ) :void{
						$temp = $performanceVals = $tempProvision_time_period_in_days = $TenderProviderSupplier_yearsExperienceMaxVal = array();
						
						foreach (self::$thisObject as $object){
								$price = $object->  getPrice  ();
								array_push ($temp , $price );
								array_push ($tempProvision_time_period_in_days , $object->  getProvisionTimePeriodInDays() );
								array_push ($TenderProviderSupplier_yearsExperienceMaxVal ,$object ->getTenderProviderSupplier ()->getYearsExperience() );
						}
						$mostMinVal = min($temp);
						$provision_time_period_in_daysMaxVal = max($tempProvision_time_period_in_days);
						$TenderProviderSupplier_yearsExperienceMaxVal =  max($TenderProviderSupplier_yearsExperienceMaxVal);
						foreach (self::$thisObject as $object){
								$price = $object->  getPrice  ();
								
								$nonBeneficial = $mostMinVal /  $price;
								$temp_Weight = !isset( $object -> getWeightsArr ()[0] ) ? 1 : $object -> getWeightsArr ()[0] ;
								$nonBeneficial =  $temp_Weight * $nonBeneficial ;
								
								$beneficiaries_time_period_in_days = $object->  getProvisionTimePeriodInDays() / $provision_time_period_in_daysMaxVal  ;
								
								$temp_Weight = !isset( $object -> getWeightsArr ()[2] ) ? 1 : $object -> getWeightsArr ()[2] ;
								
								$beneficiaries_time_period_in_days =  $beneficiaries_time_period_in_days  * $temp_Weight ;
								
								
								
								//var_dump  ($object ->getTenderProviderSupplier ()->getYearsExperience()) ;
								$beneficiaries_TenderProviderSupplier_yearsExperience = $object ->getTenderProviderSupplier ()->getYearsExperience()  /  $TenderProviderSupplier_yearsExperienceMaxVal ;
								$temp_Weight = ! isset( $object -> getWeightsArr ()[ 4 ] ) ? 1 : $object -> getWeightsArr ()[ 4 ] ;
								$beneficiaries_TenderProviderSupplier_yearsExperience = $beneficiaries_TenderProviderSupplier_yearsExperience *   $temp_Weight;
								
								
								$temp_knownbrands = $object ->getKnownBrands ();
								
								$selectedCompany  = $object ->getTenderProviderSupplier ()->getCompanyName() ;
								$beneficiaries_TenderProviderSupplier_Name = 0;
								if(!empty($temp_knownbrands)) {
										$beneficiaries_TenderProviderSupplier_Name = $temp_knownbrands [ $selectedCompany ]  / max($temp_knownbrands);
										
										//print "\n *=> $beneficiaries_TenderProviderSupplier_Name = ".$temp_knownbrands [ $selectedCompany ] .'/' . max($temp_knownbrands) . " \n";
										$temp_Weight = ! isset( $object -> getWeightsArr ()[ 3 ] ) ? 1 : $object -> getWeightsArr ()[ 3 ] ;
										//print "\n *=> $beneficiaries_TenderProviderSupplier_Name = ".$beneficiaries_TenderProviderSupplier_Name .' *' . $temp_Weight . " \n";
										$beneficiaries_TenderProviderSupplier_Name = $beneficiaries_TenderProviderSupplier_Name * $temp_Weight ;
										
										
										
								}
								//var_dump ($nonBeneficial +   $beneficiaries_time_period_in_days + $beneficiaries_TenderProviderSupplier_yearsExperience +  $beneficiaries_TenderProviderSupplier_Name  );
								$rowResult =  $nonBeneficial +   $beneficiaries_time_period_in_days + $beneficiaries_TenderProviderSupplier_yearsExperience +  $beneficiaries_TenderProviderSupplier_Name    ;
								//print $rowResult  . " = ".$nonBeneficial. " + " . $beneficiaries_time_period_in_days . " + " .$beneficiaries_TenderProviderSupplier_yearsExperience . " + " .$beneficiaries_TenderProviderSupplier_Name;
								//exit;
								//$rowResult = number_format  ($rowResult, 2, '.', ' '); //771
								print "\n".$rowResult  . " = ".$nonBeneficial. " + " . $beneficiaries_time_period_in_days . " + " .$beneficiaries_TenderProviderSupplier_yearsExperience . " + " .$beneficiaries_TenderProviderSupplier_Name;
								//exit;
								array_push ( self ::$performance_score ,
								             array (
									               "weights_arr"                   => $object -> getWeightsArr () ,
									               "price"                         => $nonBeneficial ,
									               "itemComponents"                => $object -> getItemComponents () ,
									               "provision_time_period_in_days" => $beneficiaries_time_period_in_days ,
									               "tenderProvider_Supplier"       => array(
									               	                                            "experience_score" => $beneficiaries_TenderProviderSupplier_yearsExperience
									                                                    ),
									               "itemsCount"                    => $object -> getItemsCount () ,
									               "rowResult"                     => $rowResult ,
								             )
								);
						}
				}
				
				
				
				public static function getResultsFactory(){
						$temp = array();
						foreach (self::$performance_score as $tender){
								array_push ($temp ,$tender['rowResult']  ) ;
						}
						//arsort ($temp , SORT_NUMERIC) ;
						
						foreach ($temp as $tender){
								
								print "\n".$tender .  " " . PHP_EOL;
								
						}
						self::resetArrayData ();
				}
				
				public static function fetch():array{
						$data = array() ;
						
						return $data;
				}
				public static function resetArrayData():void{
						self::$performance_score = array();
				}
		}