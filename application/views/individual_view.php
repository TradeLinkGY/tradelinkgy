<?php
	//VARIABLES
	$style = 'style.css';
	$title = 'TradeLinkGY.com | Your Premier Listings Resource'; // REPLACE with page title per page
	
	//ROUTES
	$link_category = 'category/'; // category listings
	$link_individual = 'display/individual/'; // individual listings
	
	$img_dir = base_url().'assets/img/';

	//POPULATED VARS (to be passed into view)
	$user = array('contact' => '(592) 123-4567', 'name' => 'John James', 'image' => '');
	
	$listing = array('category' => 'Automobiles', 'listing-id' => '1', 'name' => 'Listed Item Name', 'image' => '', 'price' => '$15,000', 'summary' => 'new listed item', 'location' => 'Georgetown, Guyana', 'description' => "Onestior ernatec atquis aut molor ab idebitiorum quasperum, ne exercia cum vit quis sit audi dolo quo cori as dolectae simusandis ut aut quam aut alic tem. Nam reritis simolum volupta porerita pe sitatum adiore, con con cusant expe exerci cusapernam et essunt rem consequi int abo. Nam, alicium quatem sed quaecae.\n Alic to berio endiore cullupis aut omnis maximus, sum aut everchi cillenisto exceario quibeat aut odite mo ipis dunt eum fugia eossus. Parum debit dolupta aped quamenda eri aut eos.");
	
	$related_lsts = array(
		array('date' => '1308594513', 'listing-id' => '1', 'name' => 'Listed Item Name', 'image' => '', 'price' => '$15,000', 'summary' => 'new listed item', 'location' => 'Georgetown, Guyana', 'description' => 'Onestior ernatec atquis aut molor ab idebitiorum quasperum, ne exercia cum vit quis sit audi dolo quo cori as dolectae simusandis ut aut quam aut alic tem. Nam reritis simolum volupta porerita pe sitatum adiore, con con cusant expe exerci cusapernam et essunt rem consequi int abo. Nam, alicium quatem sed quaecae. Alic to berio endiore cullupis aut omnis maximus, sum aut everchi cillenisto exceario quibeat aut odite mo ipis dunt eum fugia eossus. Parum debit dolupta aped quamenda eri aut eos.'),
		array('date' => '1308594513', 'listing-id' => '1', 'name' => 'Listed Item Name', 'image' => '', 'price' => '$15,000', 'summary' => 'new listed item', 'location' => 'Georgetown, Guyana', 'description' => 'Onestior ernatec atquis aut molor ab idebitiorum quasperum, ne exercia cum vit quis sit audi dolo quo cori as dolectae simusandis ut aut quam aut alic tem. Nam reritis simolum volupta porerita pe sitatum adiore, con con cusant expe exerci cusapernam et essunt rem consequi int abo. Nam, alicium quatem sed quaecae. Alic to berio endiore cullupis aut omnis maximus, sum aut everchi cillenisto exceario quibeat aut odite mo ipis dunt eum fugia eossus. Parum debit dolupta aped quamenda eri aut eos.'),
		array('date' => '1308594513', 'listing-id' => '1', 'name' => 'Listed Item Name', 'image' => '', 'price' => '$15,000', 'summary' => 'new listed item', 'location' => 'Georgetown, Guyana', 'description' => 'Onestior ernatec atquis aut molor ab idebitiorum quasperum, ne exercia cum vit quis sit audi dolo quo cori as dolectae simusandis ut aut quam aut alic tem. Nam reritis simolum volupta porerita pe sitatum adiore, con con cusant expe exerci cusapernam et essunt rem consequi int abo. Nam, alicium quatem sed quaecae. Alic to berio endiore cullupis aut omnis maximus, sum aut everchi cillenisto exceario quibeat aut odite mo ipis dunt eum fugia eossus. Parum debit dolupta aped quamenda eri aut eos.'),
		array('date' => '1308594513', 'listing-id' => '1', 'name' => 'Listed Item Name', 'image' => '', 'price' => '$15,000', 'summary' => 'new listed item', 'location' => 'Georgetown, Guyana', 'description' => 'Onestior ernatec atquis aut molor ab idebitiorum quasperum, ne exercia cum vit quis sit audi dolo quo cori as dolectae simusandis ut aut quam aut alic tem. Nam reritis simolum volupta porerita pe sitatum adiore, con con cusant expe exerci cusapernam et essunt rem consequi int abo. Nam, alicium quatem sed quaecae. Alic to berio endiore cullupis aut omnis maximus, sum aut everchi cillenisto exceario quibeat aut odite mo ipis dunt eum fugia eossus. Parum debit dolupta aped quamenda eri aut eos.'),
		array('listing-id' => '2', 'name' => 'Listed Item Name', 'image' => '', 'price' => '$15,000', 'summary' => 'new listed item', 'location' => 'Georgetown, Guyana', 'description' => 'Onestior ernatec atquis aut molor ab idebitiorum quasperum, ne exercia cum vit quis sit audi dolo quo cori as dolectae simusandis ut aut quam aut alic tem. Nam reritis simolum volupta porerita pe sitatum adiore, con con cusant expe exerci cusapernam et essunt rem consequi int abo. Nam, alicium quatem sed quaecae. Alic to berio endiore cullupis aut omnis maximus, sum aut everchi cillenisto exceario quibeat aut odite mo ipis dunt eum fugia eossus. Parum debit dolupta aped quamenda eri aut eos.'),
		array('listing-id' => '3','name' => 'Listed Item Name', 'image' => '', 'price' => '$15,000', 'summary' => 'new listed item', 'location' => 'Georgetown, Guyana', 'description' => 'Onestior ernatec atquis aut molor ab idebitiorum quasperum, ne exercia cum vit quis sit audi dolo quo cori as dolectae simusandis ut aut quam aut alic tem. Nam reritis simolum volupta porerita pe sitatum adiore, con con cusant expe exerci cusapernam et essunt rem consequi int abo. Nam, alicium quatem sed quaecae. Alic to berio endiore cullupis aut omnis maximus, sum aut everchi cillenisto exceario quibeat aut odite mo ipis dunt eum fugia eossus. Parum debit dolupta aped quamenda eri aut eos.'));
?>

		<div id="content" class="clearfix">
			<div class="area-type noborder clearfix">
				<h2><?php echo(anchor($link_category,$listing['category'])); ?> <span>&raquo;</span> For Sale: Listed Item Name</h2>
				<?php 
					if($listing['image'] != '') {
						list($width,$height,$type,$attr) = getimagesize($listing['image']);
						echo(anchor($link_imgs,'<img alt="" class="img-listing-item" src="'.$listing['image'].'" '.$attr.' />'));
					}
				?>
				<div class="listing-info">
					<h4>Price: <?php echo($listing['price']); ?></h4>
					<p class="listing-label"><span>Summary:</span> <?php echo($listing['name']) ?></p>
					<p class="listing-label"><span>Location:</span> <?php echo($listing['location']) ?></p>
					<p class="listing-label"><span>Telephone:</span> <?php echo($user['contact']) ?></p>
					<p id="description"><span>Description:</span></p>
					<p><?php echo (str_replace("\n",'</p><p>',$listing['description'])); ?></p>
				</div>
			</div>
			
		</div>
		
		<div id="secondary" class="clearfix">
			<a class="button" href="#">Make an Offer</a>
			<div class="area-secondary">
				<?php 
					if($user['image'] != '') {
						list($width,$height,$type,$attr) = getimagesize($img_dir.$user['image']);
						echo ('<img id="img-profile-pic" alt="user profile pic" src="'.$img_dir.$user['image'].'" />');
					}
				?>
				<h4><?php echo($user['name']); ?></h4>
				<p>Contact me if you have any questions</p>
				<p class="listing-active-link"><a href="#">Active Listings (1)</a></p>
				<p><a href="#">View Previous Listings</a></p>
			</div>
		</div>
		
		<div id="related-listings" class="clearfix">
			<h2>Related Listings</h2>
			
			<?php foreach($related_listings as $listing): ?>
			
			<div class="area-related-listing">
				<p><span><a href="">Listed item number one</a></span></p>
				<p class="related-listings-price">Price: $15,000</p>
				<p>Georgetown</p>
				<p>Posted 05/06/2011</p>
			</div>
                        <?php endforeach; ?>
			
		</div>