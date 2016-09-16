<div id="footer-section">
	<div class="container">
    	<strong>Our address</strong>: 
    	92 Langbourne Place, London E14 3WW, UK<br />
		<strong>Email:</strong> <a href="mailto:pfsales@publishforce.com">pfsales@publishforce.com</a> 
		&nbsp;&nbsp;&nbsp; <strong>Phone:</strong> +44 (0) 20 3667 3069
    </div>
</div>

<div id="whoby-section">
	<div class="container">
    	<div class="group section">
        	<div class="half">
            	&copy; Copyright PublishForce Limited, 2016. All Rights Reserved.
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript">
	
$(document).ready(function() {
	
	var bannerslider = $("#banner-slider");

	$(bannerslider).owlCarousel({
		items : 1,
		singleItem: true,
		autoPlay : 6000,
		stopOnHover : true,
	});
 	 
	$("#right_banner_arrow").click(function(){
		bannerslider.trigger('owl.next');
	})
	$("#left_banner_arrow").click(function(){
		bannerslider.trigger('owl.prev');
	})
	
	
})

</script>