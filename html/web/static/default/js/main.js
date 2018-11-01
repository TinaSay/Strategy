
(function() {

var navComponent = {
	navResize: true,
	animateIeFlag: true,
	animIESide: 'down',
	ellArrWidth: [],
	currentEll: 0,
	listWidth : 0,
	init: function(){
		this.navbar = document.getElementById('navbar');
		this.listShow = this.navbar.getElementsByClassName('list-show')[0];
		this.listHide = this.navbar.getElementsByClassName('list-hide')[0];
		this.workWrap = this.navbar;
		this.ellAnimateIE = {
			logo: this.navbar.getElementsByClassName('logo-anim-icon')[0],
			button: this.navbar.getElementsByClassName('nav-btn')[0]
		};

		for (var i = 0; i < this.listShow.children.length; i++) {
			this.ellArrWidth.push(this.listShow.children[i].offsetWidth);
			this.listWidth += this.listShow.children[i].offsetWidth;
		}
		this.listWidth += 20;

		(this.listHide.children.length === 0) ? this.listShow.lastElementChild.style.display = 'none' : this.listShow.lastElementChild.style.display = 'inline-block';

		this.adaptNav();

		window.addEventListener('resize', function (){
			navComponent.adaptNav();

			// 	вызов с задержкой (вариант для оптимизации)
			// 	if(navComponent.navResize) {
			//		navComponent.navResize = false;
			//		setTimeout(function(){
			//			navComponent.adaptNav();
			//			navComponent.navResize = true;
			//		}, 500);
			// 	}

		}, false);
	},
	checkNav: function(){
		var workWidth = this.workWrap.clientWidth,
				listShow = this.listShow.children,
		    listHide = this.listHide.children;

		if(this.listWidth >= workWidth){
			this.currentEll += 1;
			this.listWidth -= this.ellArrWidth[this.ellArrWidth.length - this.currentEll - 1];
			if(listHide.length === 0) listShow[listShow.length - 1].style.display = 'inline-block';
			this.ellReplaceToHide(listShow[listShow.length - 2]);
			this.checkNav();			
		} else if(this.listWidth + this.ellArrWidth[this.ellArrWidth.length - this.currentEll - 1] <  workWidth && listHide[0]) {
			this.listWidth += this.ellArrWidth[this.ellArrWidth.length - this.currentEll - 1];
			this.currentEll -= 1;
			this.ellReplaceToShow(listHide[0]);					
			if(listHide.length === 0) listShow[listShow.length - 1].style.display = 'none';
			this.checkNav();
		}
	},
	ellReplaceToShow: function(ellement){
		this.listShow.insertBefore(ellement, this.listShow.lastElementChild);
	},
	ellReplaceToHide: function(ellement){
		(this.listHide.firstElementChild) ? this.listHide.insertBefore(ellement, this.listHide.firstElementChild) : this.listHide.appendChild(ellement);	
	},
	adaptNav: function(){	
		if(window.innerWidth <= 768 && this.navbar.classList && !this.navbar.classList.contains('mobile-conf') || window.innerWidth <= 768 && !/\bmobile-conf\b/g.test(this.navbar.className)){
			if(this.navbar.classList) {
				this.navbar.classList.add('mobile-conf');
			} else{
				this.navbar.className = this.navbar.className + " mobile-conf";
				this.animIESide = 'down';
				this.animateScrollIe();
			} 
			for (var i = this.listShow.children.length - 1; i > 0; i--) {
				this.currentEll += 1;
				this.listWidth -= this.ellArrWidth[this.ellArrWidth.length - this.currentEll - 1];
				if(this.listHide.children.length === 0) this.listShow.children[this.listShow.children.length - 1].style.display = 'inline-block';
				this.ellReplaceToHide(this.listShow.children[i - 1]);
				if(this.listWidth < this.ellArrWidth[this.ellArrWidth.length - 1]) this.listWidth = this.ellArrWidth[this.ellArrWidth.length - 1];
			}	
		} else if(window.innerWidth > 1024) {
			if(this.navbar.classList && this.navbar.classList.contains('mobile-conf')){
				this.navbar.classList.remove('mobile-conf');
			} else if(/\bmobile-conf\b/g.test(this.navbar.className)){
				this.navbar.className = this.navbar.className.replace(/\b mobile-conf\b/g, "");
			}
			this.checkNav();	
		}
	}
};

window.addEventListener('load', function (){
	navComponent.init();	
}, false);



//sheare
$('.sheare-list-wrap .sheare-btn').on('click', function(){
  $(this).toggleClass('active');
  $(this).parent().find('.sheare-list').toggleClass('active');
});

//more block
for (var i = 0; i < $('.more-link').length; i++) {
	var that = $('.more-link')[i];
    var heightData = $(that).parent().find('.more-block__text').data('hei');
    var heightEll = $(that).parent().find('.more-block__text').height();
    console.log(heightEll);
    console.log(heightData);
    if (heightEll > heightData + 50) {
        console.log('show');
        $(that).parent().find('.more-block').height(heightData);
    } else {
        console.log('hide');
        $(that).css('display', 'none');
    }

}

$('.more-link').on('click', function(){
	if($(this).hasClass('open')) {
		var height = $(this).parent().find('.more-block__text').data('hei');
		$(this).removeClass('open');
		$(this).text('Читать далее')
		$(this).parent().find('.more-block').height(height);
	} else {
		var height = $(this).parent().find('.more-block__text').height();
		$(this).addClass('open');
		$(this).text('Свернуть')
		$(this).parent().find('.more-block').height(height);
	}
});


//slick

$('.slider-discus').slick({
  dots: false,
  infinite: true,
  speed: 500,
  cssEase: 'linear',
  prevArrow: $('.slider-discus').parent().find('.slide-prew'),
  nextArrow: $('.slider-discus').parent().find('.slide-next'),
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$('.slider-maind').slick({
  dots: false,
  infinite: true,
  speed: 500,
  cssEase: 'linear',
  prevArrow: $('.slider-maind').parent().find('.slide-prew'),
  nextArrow: $('.slider-maind').parent().find('.slide-next'),
  slidesToShow: 2,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      }
    }
  ]
});



})();
