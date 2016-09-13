
<div id="whoby-section">
	<div class="container">
        <div class="half">
        &nbsp;&nbsp;&copy; Copyright PublishForce Limited, 2016. All Rights Reserved.
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


<script>
		(function () {
		
		    // Create mobile element
		    var mobile = document.createElement('div');
		    mobile.className = 'nav-mobile';
		    document.querySelector('.nav').appendChild(mobile);
		
		    // hasClass
		    function hasClass(elem, className) {
		        return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
		    }
		
		    // toggleClass
		    function toggleClass(elem, className) {
		        var newClass = ' ' + elem.className.replace(/[\t\r\n]/g, ' ') + ' ';
		        if (hasClass(elem, className)) {
		            while (newClass.indexOf(' ' + className + ' ') >= 0) {
		                newClass = newClass.replace(' ' + className + ' ', ' ');
		            }
		            elem.className = newClass.replace(/^\s+|\s+$/g, '');
		        } else {
		            elem.className += ' ' + className;
		        }
		    }
		
		    // Mobile nav function
		    var mobileNav = document.querySelector('.nav-mobile');
		    var toggle = document.querySelector('.nav-list');
		    mobileNav.onclick = function () {
		        toggleClass(this, 'nav-mobile-open');
		        toggleClass(toggle, 'nav-active');
		    };
		})();
		</script>