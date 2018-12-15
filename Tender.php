<?php
		/**
		 *  This classs will handle all the tender defination .
		 */
		class Tender {
				/**
				 * @return array
				 */
				public function getKnownBrands () : array
				{
						return $this -> knownBrands;
				}
				
				/**
				 * @return array
				 */
				public function getWeightsArr () : array
				{
						return $this -> weights_arr;
				}
				
				
				/**
				 * @return float
				 */
				public function getPrice () : float
				{
						return $this -> price;
				}
				
				
				/**
				 * @return \ItemComponents
				 */
				public function getItemComponents () : \ItemComponents
				{
						return $this -> itemComponents;
				}
				
				
				/**
				 * @return float
				 */
				public function getProvisionTimePeriodInDays () : float
				{
						return $this -> provision_time_period_in_days;
				}
				
				
				/**
				 * @return \TenderProvider_Supplier
				 */
				public function getTenderProviderSupplier () : \TenderProvider_Supplier
				{
						return $this -> tenderProvider_Supplier;
				}
				
				
				
				/**
				 * @return float
				 */
				public function getItemsCount () : float
				{
						return $this -> itemsCount;
				}
				
				
				private $weights_arr;
				private $price;
				private $itemComponents;
				private $provision_time_period_in_days;
				private $tenderProvider_Supplier;
				private $itemsCount;
				private $knownBrands;
				
				function __construct ( array $weights_arr , float $price , ItemComponents $itemComponents , float $provision_time_period_in_days ,
				                       TenderProvider_Supplier $tenderProvider_Supplier , float $itemsCount =1 , array $knownBrands = array()) {
						$this -> weights_arr                   = $weights_arr;
						$this -> price                         = $price;
						$this -> itemComponents                = $itemComponents;
						$this -> provision_time_period_in_days = $provision_time_period_in_days;
						$this -> tenderProvider_Supplier       = $tenderProvider_Supplier;
						$this -> itemsCount                    = $itemsCount;
						$this -> knownBrands                    = $knownBrands;
						
						array_push (MultiCriteriaDecisionMaking::$thisObject , $this);
				}
				
				
				
				
				function scorePerformance ():void{
						$weight                               = .25;
						$itemComponents_result                = .53;
						$provision_time_period_in_days_result = .6;
						$tenderProvider_Supplier_result       = .7;
						$price_result                         = $this -> price * $weight;
						$final_performance_score              = $price_result + $itemComponents_result +
							  $provision_time_period_in_days_result + $tenderProvider_Supplier_result;
						array_push ( MultiCriteriaDecisionMaking ::$performance_score , $final_performance_score );
				}
				
				
		}