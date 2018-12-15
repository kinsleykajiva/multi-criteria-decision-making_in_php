<?php
		/**
		 * Will handle tender suppleir names or details
		 */
		class TenderProvider_Supplier {
				
				private $companyName;
				private $yearsExperience;
				
				function __construct ( string $companyName , float $yearsExperience )
				{
						$this -> companyName     = $companyName;
						$this -> yearsExperience = $yearsExperience;
				}
				
				/**
				 * @return string
				 */
				public function getCompanyName () : string
				{
						return $this -> companyName;
				}
				
				/**
				 * @return float
				 */
				public function getYearsExperience () : float
				{
						return $this -> yearsExperience;
				}
				
		}