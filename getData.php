<?php
/* 
 * getData.php
 * Assignment4: get Data
 *
 * Revision History
 *       group8, 2017.07.20: Created
 */
	// const
	// list size
	define("LiST_SIZE", 8);

	// genre list
	$genreList = array(
		"Action", "Adventure", "Role-playing", "Simulation", "Sports"
	);

	// platform list
	$platformList = array(
		"Xbox", "PS", "PC", "Switch"
	);

	// provinceList
	$provinceList = array(
		array("provinceCD"=>"AB","provinceNM"=>"Alberta","tax"=>0.05),
		array("provinceCD"=>"BC","provinceNM"=>"British Columbia","tax"=>0.12),
		array("provinceCD"=>"MN","provinceNM"=>"Manitoba","tax"=>0.13),
		array("provinceCD"=>"NB","provinceNM"=>"New Brunswick","tax"=>0.15),
		array("provinceCD"=>"NL","provinceNM"=>"Newfoundland and Labrador","tax"=>0.15),
		array("provinceCD"=>"NS","provinceNM"=>"Nova Scotia","tax"=>0.15),
		array("provinceCD"=>"ON","provinceNM"=>"Ontario","tax"=>0.13),
		array("provinceCD"=>"PE","provinceNM"=>"Prince Edward Island","tax"=>0.15),
		array("provinceCD"=>"SC","provinceNM"=>"Saskatchewan","tax"=>0.11),
		array("provinceCD"=>"QC","provinceNM"=>"Quebec","tax"=>0.14975),
		array("provinceCD"=>"NT","provinceNM"=>"Northwest Territories","tax"=>0.05),
		array("provinceCD"=>"NU","provinceNM"=>"Nunavut","tax"=>0.05),
		array("provinceCD"=>"YT","provinceNM"=>"Yukon","tax"=>0.05)
	);
	
	// itemList
	$itemList = array(
		array( "itemID"=>"p019", "title"=>"NBA 2K18 Legend ", "price"=>"99.99", "genreCD"=>"5", "genre"=>"Sports", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP019.jpg", "detail"=>"The highest rated* annual sports title of this console generation returns with NBA 2K18, featuring unparalleled authenticity and improvements on the court."),
		array( "itemID"=>"p020", "title"=>"NBA 2K18 Legend ", "price"=>"99.99", "genreCD"=>"5", "genre"=>"Sports", "platformCD"=>"2", "platform"=>"PS", "rate"=>"3", "imgAddr"=>"img/itemImg/imgP020.jpg", "detail"=>"The highest rated* annual sports title of this console generation returns with NBA 2K18, featuring unparalleled authenticity and improvements on the court."),
		array( "itemID"=>"p021", "title"=>"NBA 2K18 Legend ", "price"=>"99.99", "genreCD"=>"5", "genre"=>"Sports", "platformCD"=>"4", "platform"=>"Switch", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP021.jpg", "detail"=>"The highest rated* annual sports title of this console generation returns with NBA 2K18, featuring unparalleled authenticity and improvements on the court."),
		array( "itemID"=>"p032", "title"=>"ARK: Survival Evolved", "price"=>"100.00", "genreCD"=>"2", "genre"=>"Adventure", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"4", "imgAddr"=>"img/itemImg/imgP032.jpg", "detail"=>"Survive Above All: Hunger, thirst, basic safety and protecting yourself from the weather are all part of the game. Run too far and not only will you be exhausted, but you will also quickly get hungry and thirsty. Weather effects are based on real-world climates, and so you'll need to hide out from rain and snow, while making the most of sunny days."),
		array( "itemID"=>"p033", "title"=>"ARK: Survival Evolved", "price"=>"100.00", "genreCD"=>"2", "genre"=>"Adventure", "platformCD"=>"2", "platform"=>"PS", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP033.jpg", "detail"=>"Survive Above All: Hunger, thirst, basic safety and protecting yourself from the weather are all part of the game. Run too far and not only will you be exhausted, but you will also quickly get hungry and thirsty. Weather effects are based on real-world climates, and so you'll need to hide out from rain and snow, while making the most of sunny days."),
		array( "itemID"=>"p007", "title"=>"FIFA 18", "price"=>"74.99", "genreCD"=>"5", "genre"=>"Sports", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP007.jpg", "detail"=>"REAL MADRID'S ALL-TIME TOP SCORER AND BACK-TO-BACK EUROPEAN CHAMPION, CRISTIANO RONALDO FUELS INNOVATION AND GRACES THE COVER OF FIFA 18."),
		array( "itemID"=>"p008", "title"=>"FIFA 18", "price"=>"74.99", "genreCD"=>"5", "genre"=>"Sports", "platformCD"=>"2", "platform"=>"PS", "rate"=>"3", "imgAddr"=>"img/itemImg/imgP008.jpg", "detail"=>"REAL MADRID'S ALL-TIME TOP SCORER AND BACK-TO-BACK EUROPEAN CHAMPION, CRISTIANO RONALDO FUELS INNOVATION AND GRACES THE COVER OF FIFA 18."),
		array( "itemID"=>"p001", "title"=>"Cities: Skylines", "price"=>"10.00", "genreCD"=>"4", "genre"=>"Simulation", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"4", "imgAddr"=>"img/itemImg/imgP001.jpg", "detail"=>"Cities: Skylines is a modern take on the classic city simulation. The game introduces new game play elements to realize the thrill and hardships of creating and maintaining a real city whilst expanding on some well-established tropes of the city building experience."),
		array( "itemID"=>"p002", "title"=>"Cities: Skylines", "price"=>"10.00", "genreCD"=>"4", "genre"=>"Simulation", "platformCD"=>"2", "platform"=>"PS", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP002.jpg", "detail"=>"Cities: Skylines is a modern take on the classic city simulation. The game introduces new game play elements to realize the thrill and hardships of creating and maintaining a real city whilst expanding on some well-established tropes of the city building experience."),
		array( "itemID"=>"p003", "title"=>"Destiny 2", "price"=>"15.00", "genreCD"=>"1", "genre"=>"Action", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"4", "imgAddr"=>"img/itemImg/imgP003.jpg", "detail"=>"From the makers of the acclaimed hit game Destiny, comes the much-anticipated sequel. An action shooter that takes you on an epic journey across the solar system."),
		array( "itemID"=>"p004", "title"=>"Fallout 4", "price"=>"50.01", "genreCD"=>"3", "genre"=>"Role-playing", "platformCD"=>"3", "platform"=>"PC", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP004.jpg", "detail"=>"Do whatever you want in a massive open world with hundreds of locations, characters, and quests. Join multiple factions vying for power or go it alone, the choices are all yours."),
		array( "itemID"=>"p005", "title"=>"Farming Simulator 18", "price"=>"18.35", "genreCD"=>"4", "genre"=>"Simulation", "platformCD"=>"2", "platform"=>"PS", "rate"=>"2", "imgAddr"=>"img/itemImg/imgP005.jpg", "detail"=>"Become a modern farmer in Farming Simulator 18! Immerse yourself in a huge open world and harvest many types of crops, take care of your livestock - cows, sheep, and pigs - take part in forestry, and sell your products on a dynamic market to expand your farm!"),
		array( "itemID"=>"p006", "title"=>"Farming Simulator 18", "price"=>"18.35", "genreCD"=>"4", "genre"=>"Simulation", "platformCD"=>"3", "platform"=>"PC", "rate"=>"4", "imgAddr"=>"img/itemImg/imgP006.jpg", "detail"=>"Become a modern farmer in Farming Simulator 18! Immerse yourself in a huge open world and harvest many types of crops, take care of your livestock - cows, sheep, and pigs - take part in forestry, and sell your products on a dynamic market to expand your farm!"),
//		array( "itemID"=>"p007", "title"=>"FIFA 18", "price"=>"74.99", "genreCD"=>"5", "genre"=>"Sports", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP007.jpg", "detail"=>"REAL MADRID'S ALL-TIME TOP SCORER AND BACK-TO-BACK EUROPEAN CHAMPION, CRISTIANO RONALDO FUELS INNOVATION AND GRACES THE COVER OF FIFA 18."),
//		array( "itemID"=>"p008", "title"=>"FIFA 18", "price"=>"74.99", "genreCD"=>"5", "genre"=>"Sports", "platformCD"=>"2", "platform"=>"PS", "rate"=>"3", "imgAddr"=>"img/itemImg/imgP008.jpg", "detail"=>"REAL MADRID'S ALL-TIME TOP SCORER AND BACK-TO-BACK EUROPEAN CHAMPION, CRISTIANO RONALDO FUELS INNOVATION AND GRACES THE COVER OF FIFA 18."),
		array( "itemID"=>"p009", "title"=>"Final Fantasy XII", "price"=>"89.99", "genreCD"=>"2", "genre"=>"Adventure", "platformCD"=>"2", "platform"=>"PS", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP009.jpg", "detail"=>"FINAL FANTASY® XII THE ZODIAC AGE improves upon the 2006 classic FINAL FANTASY XII, now more beautiful and easier to play than ever. The high-definition remaster introduces several modern advancements, including reconstructed battle design and a revamped job system."),
		array( "itemID"=>"p010", "title"=>"Gears of War4", "price"=>"45.45", "genreCD"=>"1", "genre"=>"Action", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"2", "imgAddr"=>"img/itemImg/imgP010.jpg", "detail"=>"A new saga begins for one of the most acclaimed video game franchises in history. After narrowly escaping an attack on their village, JD Fenix and his friends, Kait and Del, must rescue the ones they love and discover the source of a monstrous new enemy."),
		array( "itemID"=>"p011", "title"=>"Lego City Undercover", "price"=>"24.99", "genreCD"=>"2", "genre"=>"Adventure", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"1", "imgAddr"=>"img/itemImg/imgP011.jpg", "detail"=>"Join the Chase! LEGO® CITY Undercover is coming to current and new generation consoles for the first time. In one of the most expansive LEGO® videogames to date, players become Chase McCain, a police officer who goes undercover to hunt down the notorious – and recently escaped – criminal, Rex Fury, to put an end to his city-wide crime wave."),
		array( "itemID"=>"p012", "title"=>"Lego City Undercover", "price"=>"24.99", "genreCD"=>"2", "genre"=>"Adventure", "platformCD"=>"2", "platform"=>"PS", "rate"=>"0", "imgAddr"=>"img/itemImg/imgP012.jpg", "detail"=>"Join the Chase! LEGO® CITY Undercover is coming to current and new generation consoles for the first time. In one of the most expansive LEGO® videogames to date, players become Chase McCain, a police officer who goes undercover to hunt down the notorious – and recently escaped – criminal, Rex Fury, to put an end to his city-wide crime wave."),
		array( "itemID"=>"p013", "title"=>"Lego City Undercover", "price"=>"24.99", "genreCD"=>"2", "genre"=>"Adventure", "platformCD"=>"4", "platform"=>"Switch", "rate"=>"2", "imgAddr"=>"img/itemImg/imgP013.jpg", "detail"=>"LEGO® Star Wars: The Force Awakens marks the triumphant return of the No. 1 LEGO videogame franchise and immerses fans in the new Star Wars adventure like never before. Players can relive the epic action from the blockbuster film in a way that only LEGO can offer, featuring all of the storylines from Star Wars:"),
		array( "itemID"=>"p014", "title"=>"LEGO Star Wars: The Force Awakens", "price"=>"19.99", "genreCD"=>"1", "genre"=>"Action", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"4", "imgAddr"=>"img/itemImg/imgP014.jpg", "detail"=>"LEGO® Star Wars: The Force Awakens marks the triumphant return of the No. 1 LEGO videogame franchise and immerses fans in the new Star Wars adventure like never before. Players can relive the epic action from the blockbuster film in a way that only LEGO can offer, featuring all of the storylines from Star Wars:"),
		array( "itemID"=>"p015", "title"=>"Madden NFL 18", "price"=>"75.01", "genreCD"=>"5", "genre"=>"Sports", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP015.jpg", "detail"=>"Madden NFL 18 takes a significant visual leap with the power of the Frostbite engine. See stunning new stadium exteriors surrounded by vast cityscapes and watch the spectacle of NFL gameday come to life in the most photorealistic game to date."),
		array( "itemID"=>"p016", "title"=>"Madden NFL 18", "price"=>"75.01", "genreCD"=>"5", "genre"=>"Sports", "platformCD"=>"2", "platform"=>"PS", "rate"=>"4", "imgAddr"=>"img/itemImg/imgP016.jpg", "detail"=>"Madden NFL 18 takes a significant visual leap with the power of the Frostbite engine. See stunning new stadium exteriors surrounded by vast cityscapes and watch the spectacle of NFL gameday come to life in the most photorealistic game to date."),
		array( "itemID"=>"p017", "title"=>"Minecraft", "price"=>"25.00", "genreCD"=>"4", "genre"=>"Simulation", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"3", "imgAddr"=>"img/itemImg/imgP017.jpg", "detail"=>"Build with your imagination! Minecraft, the best-selling game on Xbox 360, is now available on Xbox One. Create and explore your very own world where the only limit is what you can imagine - just be sure to build a shelter before night comes to keep yourself safe from monsters. Play on your own, or with up to 4 players split screen, or 8 players online."),
		array( "itemID"=>"p018", "title"=>"Minecraft", "price"=>"25.00", "genreCD"=>"4", "genre"=>"Simulation", "platformCD"=>"2", "platform"=>"PS", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP018.jpg", "detail"=>"Build with your imagination! Minecraft, the best-selling game on Xbox 360, is now available on Xbox One. Create and explore your very own world where the only limit is what you can imagine - just be sure to build a shelter before night comes to keep yourself safe from monsters. Play on your own, or with up to 4 players split screen, or 8 players online."),
//		array( "itemID"=>"p019", "title"=>"NBA 2K18 Legend ", "price"=>"99.99", "genreCD"=>"5", "genre"=>"Sports", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP019.jpg", "detail"=>"The highest rated* annual sports title of this console generation returns with NBA 2K18, featuring unparalleled authenticity and improvements on the court."),
//		array( "itemID"=>"p020", "title"=>"NBA 2K18 Legend ", "price"=>"99.99", "genreCD"=>"5", "genre"=>"Sports", "platformCD"=>"2", "platform"=>"PS", "rate"=>"3", "imgAddr"=>"img/itemImg/imgP020.jpg", "detail"=>"The highest rated* annual sports title of this console generation returns with NBA 2K18, featuring unparalleled authenticity and improvements on the court."),
//		array( "itemID"=>"p021", "title"=>"NBA 2K18 Legend ", "price"=>"99.99", "genreCD"=>"5", "genre"=>"Sports", "platformCD"=>"4", "platform"=>"Switch", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP021.jpg", "detail"=>"The highest rated* annual sports title of this console generation returns with NBA 2K18, featuring unparalleled authenticity and improvements on the court."),
		array( "itemID"=>"p022", "title"=>"Rogue Stormers", "price"=>"36.55", "genreCD"=>"1", "genre"=>"Action", "platformCD"=>"2", "platform"=>"PS", "rate"=>"4", "imgAddr"=>"img/itemImg/imgP022.jpg", "detail"=>"Delve deep into the oil rig city of Ravensdale. A medieval metropolis that went bonkers after the people discovered goop - a raw fluid that provided energy, skin cream, bread spread and powered diesel engines. And it turned the people of Ravensdale into raging, bloodthirsty monsters. Lucky for them they have you, leading a pack of lunatic knights on a killing spree to save the city."),
		array( "itemID"=>"p023", "title"=>"South Park: The Fractured But Whole", "price"=>"25.01", "genreCD"=>"2", "genre"=>"Adventure", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"2", "imgAddr"=>"img/itemImg/imgP023.jpg", "detail"=>"In the quiet mountain town of South Park, darkness has spread across the land. A new power is rising to combat this evil. An entire squad of superheroes will rise, led by a nocturnal scavenger sworn to clean the trash can of South Park society."),
		array( "itemID"=>"p024", "title"=>"South Park: The Fractured But Whole", "price"=>"25.01", "genreCD"=>"2", "genre"=>"Adventure", "platformCD"=>"2", "platform"=>"PS", "rate"=>"3", "imgAddr"=>"img/itemImg/imgP024.jpg", "detail"=>"In the quiet mountain town of South Park, darkness has spread across the land. A new power is rising to combat this evil. An entire squad of superheroes will rise, led by a nocturnal scavenger sworn to clean the trash can of South Park society."),
		array( "itemID"=>"p025", "title"=>"South Park: The Fractured But Whole", "price"=>"25.01", "genreCD"=>"2", "genre"=>"Adventure", "platformCD"=>"3", "platform"=>"PC", "rate"=>"2", "imgAddr"=>"img/itemImg/imgP025.jpg", "detail"=>"In the quiet mountain town of South Park, darkness has spread across the land. A new power is rising to combat this evil. An entire squad of superheroes will rise, led by a nocturnal scavenger sworn to clean the trash can of South Park society."),
		array( "itemID"=>"p026", "title"=>"Super Mario Odyssey", "price"=>"49.99", "genreCD"=>"2", "genre"=>"Adventure", "platformCD"=>"4", "platform"=>"Switch", "rate"=>"4", "imgAddr"=>"img/itemImg/imgP026.jpg", "detail"=>"Join Mario on a massive, globe-trotting 3D adventure and use his incredible new abilities to collect Moons so you can power up your airship, the Odyssey, and rescue Princess Peach from Bowser’s wedding plans!"),
		array( "itemID"=>"p027", "title"=>"The Sims 4: Get Together", "price"=>"25.02", "genreCD"=>"4", "genre"=>"Simulation", "platformCD"=>"3", "platform"=>"PC", "rate"=>"3", "imgAddr"=>"img/itemImg/imgP027.jpg", "detail"=>"Get together with Clubs in The Sims 4 Get Together*!  Create Clubs for your Sims where you set the rules, define their look, and customize their exclusive hangouts.  Sims in each Club will follow your rules when they’re gathered together, regardless of how they would usually behave, giving you new ways to play with your Sims!"),
		array( "itemID"=>"p028", "title"=>"The Surge", "price"=>"50.00", "genreCD"=>"1", "genre"=>"Action", "platformCD"=>"2", "platform"=>"PS", "rate"=>"2", "imgAddr"=>"img/itemImg/imgP028.jpg", "detail"=>"Set in a heavily dystopian future as Earth nears the end of its life, those who remain in the overpopulated cities must work to survive as social programs become saturated by an ageing population and increasing environmental diseases."),
		array( "itemID"=>"p029", "title"=>"The Surge", "price"=>"50.00", "genreCD"=>"1", "genre"=>"Action", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP029.jpg", "detail"=>"Set in a heavily dystopian future as Earth nears the end of its life, those who remain in the overpopulated cities must work to survive as social programs become saturated by an ageing population and increasing environmental diseases."),
		array( "itemID"=>"p030", "title"=>"Valkyria Revolution", "price"=>"75.00", "genreCD"=>"3", "genre"=>"Role-playing", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP030.jpg", "detail"=>"The Valkyria who are the embodiment of death, is returning to the battlefield in Valkyria Revolution, and players will have to do—and sacrifice—whatever is necessary to liberate their homeland. With an engaging story full of political intrigue, a battle system that mixes real-time combat and tactical strategy, a gorgeous visual style, and more, the game will immerse players into the frontlines of a desperate war."),
		array( "itemID"=>"p031", "title"=>"Valkyria Revolution", "price"=>"75.00", "genreCD"=>"3", "genre"=>"Role-playing", "platformCD"=>"2", "platform"=>"PS", "rate"=>"4", "imgAddr"=>"img/itemImg/imgP031.jpg", "detail"=>"The Valkyria who are the embodiment of death, is returning to the battlefield in Valkyria Revolution, and players will have to do—and sacrifice—whatever is necessary to liberate their homeland. With an engaging story full of political intrigue, a battle system that mixes real-time combat and tactical strategy, a gorgeous visual style, and more, the game will immerse players into the frontlines of a desperate war.")
//		array( "itemID"=>"p032", "title"=>"ARK: Survival Evolved", "price"=>"100.00", "genreCD"=>"2", "genre"=>"Adventure", "platformCD"=>"1", "platform"=>"Xbox", "rate"=>"4", "imgAddr"=>"img/itemImg/imgP032.jpg", "detail"=>"Survive Above All: Hunger, thirst, basic safety and protecting yourself from the weather are all part of the game. Run too far and not only will you be exhausted, but you will also quickly get hungry and thirsty. Weather effects are based on real-world climates, and so you'll need to hide out from rain and snow, while making the most of sunny days."),
//		array( "itemID"=>"p033", "title"=>"ARK: Survival Evolved", "price"=>"100.00", "genreCD"=>"2", "genre"=>"Adventure", "platformCD"=>"2", "platform"=>"PS", "rate"=>"5", "imgAddr"=>"img/itemImg/imgP033.jpg", "detail"=>"Survive Above All: Hunger, thirst, basic safety and protecting yourself from the weather are all part of the game. Run too far and not only will you be exhausted, but you will also quickly get hungry and thirsty. Weather effects are based on real-world climates, and so you'll need to hide out from rain and snow, while making the most of sunny days.")
	);

	function GetItemList($genreCD, $platformCD, $begin, $end)
	{
		global $itemList;
		$resultList = array();
		$count = 0;
		$end = empty($end) ? ($begin + LiST_SIZE) : $end;

		foreach($itemList as $item)
		{

			if(!empty($genreCD) && $genreCD != $item["genreCD"])
			{
				continue;
			}

			if(!empty($platformCD) && $platformCD != $item["platformCD"])
			{
				continue;
			}
		
			if($count >= $end)
			{
				break;
			}
			
			if($count >= $begin)
			{
				array_push($resultList, $item);
			}
			
			$count++;
			
		}

		return $resultList;

	}

	
	
	function GetItemListCount($genreCD, $platformCD)
	{
		global $itemList;
		$resultList = array();
		$count = 0;
		
		if(empty($genreCD) && empty($platformCD))
		{
			return count($itemList);
		}
		
		foreach($itemList as $item)
		{

			if(!empty($genreCD) && $genreCD != $item["genreCD"])
			{
				continue;
			}

			if(!empty($platformCD) && $platformCD != $item["platformCD"])
			{
				continue;
			}

			$count++;
			
		}

		return $count;

	}

	function GetItemInfo($itemID)
	{
		global $itemList;
		$result;
		foreach($itemList as $item)
		{
			if($itemID == $item["itemID"])
			{
				$result = $item;
				break;
			}
		}
		
		return $result;
	}

	function GetItemInfoList($itemIDList)
	{

		global $itemList;
		$resultList = array();

		if(!empty($itemIDList) )
		{

			foreach($itemIDList as $itemID)
			{

				foreach($itemList as $item)
				{
						
					if($itemID == $item['itemID'])
					{
						array_push($resultList, $item);
					}
						
				}

			}
			
		}
		return $resultList;
		
	}

	
	function GetSummaryInfo($provinceCD, $itemTotal)
	{
		global $provinceList;

		$taxRate = 0.0;
		foreach($provinceList as $province)
		{
			if($provinceCD == $province["provinceCD"])
			{
				$taxRate = $province["tax"];
				break;
			}
		}
	
		$date = date("Y-m-d", time());
		$date1 = str_replace('-', '/', $date);
		
		if($itemTotal <= 25)
		{
			$deliveryDate = date('m-d-Y',strtotime($date1 . "+1 days"));
			$deliveryCost = 3.00;
		}
		elseif($itemTotal >= 25.01 && $itemTotal <= 50)
		{
			$deliveryDate = date('m-d-Y',strtotime($date1 . "+1 days"));
			$deliveryCost = 4.00;
		}
		elseif($itemTotal >= 50.01 && $itemTotal <= 75)
		{
			$deliveryDate = date('m-d-Y',strtotime($date1 . "+3 days"));
			$deliveryCost = 5.00;
		}
		elseif($itemTotal >= 75.01)
		{
			$deliveryDate = date('m-d-Y',strtotime($date1 . "+4 days"));
			$deliveryCost = 6.00;
		}	

		$totalPrice = $itemTotal + ($itemTotal*$taxRate) + $deliveryCost;
		
		$summaryInfo = array(
			"itemTotal"=>$itemTotal, 
			"taxRate"=>$taxRate, 
			"deliveryCost"=>$deliveryCost, 
			"totalPrice"=>$totalPrice, 
			"deliveryDate"=>$deliveryDate
		);
		
		return $summaryInfo;
	}
		
	
	function GetAssignedValue($param)
	{
		return empty($param) ? "" : $param;
	}
?>

