(function() {
	
	// use the thumbnail as a background on it's parent
	var postThumbnails = document.querySelectorAll('.post-thumbnail');
	for ( var i in postThumbnails ) {
		var children = postThumbnails[i].children;
		for ( var ii in children ) {
			if ( children[ii].tagName == 'IMG' ) {
				//get its src
				var src = children[ii].getAttribute('src');
				//set .post-thumbnail's background to the img's src url
				postThumbnails[i].style.backgroundImage = 'url('+src+')';
			}
		}
	}
	
	// set up the article transition
	var featuredImage = document.getElementById('featured-image');
	var currentArticle = document.getElementById('main');
	var nextArticle = document.getElementById('next');
	var nextArticleId = nextArticle.getAttribute('data-post-id');
	
	featuredImage.addEventListener("click", function(){
		
		// prevent scrolling
		document.body.style.overflow = "hidden";
		document.addEventListener('touchstart', function(e){
			e.preventDefault();
		});
		
		//transition the articles
		var translationValue = featuredImage.getBoundingClientRect().top - 50;
		classie.add( currentArticle, 'fade-up-out' );
		classie.remove( nextArticle, 'content-hidden' );
		classie.add( nextArticle, 'easing-upward' );
		nextArticle.style.webkitTransform = "translate3d(0, -"+ translationValue +"px, 0)";
		nextArticle.style.mozTransform = "translate3d(0, -"+ translationValue +"px, 0)";
		nextArticle.style.oTransform = "translate3d(0, -"+ translationValue +"px, 0)";
		nextArticle.style.transform = "translate3d(0, -"+ translationValue +"px, 0)";
		
		//load the next article
		window.setTimeout(function(){
			if (window.innerWidth <= 1024) {
				location.replace( "index.php?p=" + nextArticleId );
			} else {
				location.assign( "index.php?p=" + nextArticleId );
			}
		}, 800);
	});
})();