<?php
		/**
		 * will handle the required parts for all  the components if there's is need <br>
		 * For example printer may have components of ink etc
		 */
		class ItemComponents {
				private $partsSupplier;
				
				function __construct ( array $partsSupplier ){
						$this -> partsSupplier = $partsSupplier;
				}
				
				/**
				 * @return array
				 */
				public function getPartsSupplier () : array	{
						return $this -> partsSupplier;
				}
				
		}