class SA_SwiftMenu {
	  constructor(wrapper, radius, menu, tabs) {	  	
	    this.wrapper = wrapper;
	    this.radius = radius;
	    this.menu = menu;
	    this.tabs = tabs;
	    this.stateDataShow = false;
	  }
	  switf() {	  		  	
	    var $vm = this;
	    
		  	var radius = $vm.radius;
			var fields = $vm.tabs,
			container = $vm.menu, 
			width = container.width(),
			height = container.height();

		  this.wrapper.on('click', function(){

		if ($vm.stateDataShow === false) {

			fields.css('display','block');
			$vm.stateDataShow = true;

			if (fields.length <4) {				
				//determining interval of menus if less dan 4 they should come closer
				var angle = -20, step = (2*Math.PI) / 6;			
			}else{
				//determining interval of menus
				var angle = 0, step = (2*Math.PI) / fields.length;
			}

			fields.each(function() {
			    var x = Math.round(width/2 + width * Math.cos(angle) - $(this).width()/2);
			    var y = Math.round(height/2 + width * Math.sin(angle) - $(this).height()/2);
			    /*if(window.console) {
			        //console.log($(this).text(), x, y);
			    }*/
			    $(this).css({
			        left: x + 'px',
			        top: y + 'px'
			    });
			    angle += step;
			})
		}else if ($vm.stateDataShow === true) {
			//return menu back to ==> hide splitted menu
			fields.each(function() {			    
			    $(this).css({
			        left: '0px',
			        top: '0px'
			    });
			})
			setTimeout(function() {
				$vm.stateDataShow = false;
				fields.css('display','none');

			}, 100);

		}
		});
		 
	
	  	/*
	  	*/
		
	  }
	 	clickOutside(){
	 		var $vm = this;
	 		$('.swift').parents().click(function(e){
		  		$vm.tabs.each(function() {			    
				    $(this).css({
				        left: '0px',
				        top: '0px'
				    });
				})
				setTimeout(function() {
					$vm.stateDataShow = false;
					$vm.tabs.css('display','none');

				}, 100);
		  	}).children().click(function(event){
		  		event.stopPropagation();
		  	});

		  	$vm.tabs.on('click', function(){
		  		$vm.tabs.each(function() {			    
				    $(this).css({
				        left: '0px',
				        top: '0px'
				    });
				})
				setTimeout(function() {
					$vm.stateDataShow = false;
					$vm.tabs.css('display','none');

				}, 100);
		  	})
	 		/*$("body").click(function(e) { 
		 	if($(e.target).is('.swift')){ 
		 		 
		 	}else{
		 		
		 	}
		 });*/
	 	}

	}