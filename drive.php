<?php
        require_once 'ItemComponents.php';
        require_once 'TenderProvider_Supplier.php';
        require_once 'MultiCriteriaDecisionMaking.php';
        require_once 'Tender.php';
       
        
        /*----------------------end of class-----------------------------------------------------*/
		
		/**
		 *
		 * 0.56
		 * 0.43
		* 0.42
		**/
		
        /*--------------------*/
		$savedBrands                   = array(
			  "Computex" => 3 , "Afrix" =>2 , "Commex" => 1
		);
		//rsort ($savedBrands);
		//print_r (max($savedBrands));exit;
        $weights_arr                   = array ( 0.14 , 0.14, 0.14, 0.14 ,0.14 ,0.14,  0.14);
        $price                         = 40000.00; // [0]
        $itemComponents                = new ItemComponents( [] );   // [1]
        $provision_time_period_in_days = 120; // [2]
        $providersName                 = new TenderProvider_Supplier( "Computex" , 4.6 );  // [3]  // [4]
        $itemsCount                    = 7.0;  // [5]
        $computer_1                    = new Tender(
				      $weights_arr , $price , $itemComponents , $provision_time_period_in_days , $providersName , $itemsCount , $savedBrands
				);
         /*--------------------*/
		$weights_arr                   = array ( 0.14 , 0.14, 0.14, 0.14 ,0.14 ,0.14,  0.14);
        $price                         = 521100;
        $itemComponents                = new ItemComponents( [] );
        $provision_time_period_in_days = 300;
        $providersName                 = new TenderProvider_Supplier( "Afrix" , 7.6 );
        $itemsCount                    = 7.0;
        $computer_1                    = new Tender(
	    $weights_arr , $price , $itemComponents , $provision_time_period_in_days , $providersName , $itemsCount , $savedBrands
        );
         /*--------------------*/
		$weights_arr                   = array ( 0.14 , 0.14, 0.14, 0.14 ,0.14 ,0.14,  0.14);
        $price                         = 132001;
        $itemComponents                = new ItemComponents( [] );
        $provision_time_period_in_days = 700;
        $providersName                 = new TenderProvider_Supplier( "Commex" , 1.6 );
        $itemsCount                    = 7.0;
        $computer_1                    = new Tender(
	    $weights_arr , $price , $itemComponents , $provision_time_period_in_days , $providersName , $itemsCount , $savedBrands
        );
        
        //$computer_1 -> scorePerformance ();
        //  print_r ( Tender ::$perfomance_score );
        /*print_r*/ // (MultiCriteriaDecisionMaking::normalise (FALSE));
        MultiCriteriaDecisionMaking::normalise ();
        MultiCriteriaDecisionMaking::getResultsFactory ();

?>