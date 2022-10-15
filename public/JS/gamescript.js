(function(){
	
	var Memory = {

		init: function(cards){
			this.$game = $(".game");
			this.$modal = $(".modal");
			this.$overlay = $(".modal-overlay");
			this.$restartButton = $("button.restart");
			this.cardsArray = $.merge(cards, cards);
			this.shuffleCards(this.cardsArray);
			this.setup();
		},

		shuffleCards: function(cardsArray){
			this.$cards = $(this.shuffle(this.cardsArray));
		},

		setup: function(){
			this.html = this.buildHTML();
			this.$game.html(this.html);
			this.$memoryCards = $(".card");
			this.paused = false;
     	this.guess = null;
			this.binding();
		},

		binding: function(){
			this.$memoryCards.on("click", this.cardClicked);
			this.$restartButton.on("click", $.proxy(this.reset, this));
		},
		// kinda messy but hey
		cardClicked: function(){
			var _ = Memory;
			var $card = $(this);
			if(!_.paused && !$card.find(".inside").hasClass("matched") && !$card.find(".inside").hasClass("picked")){
				$card.find(".inside").addClass("picked");
				if(!_.guess){
					_.guess = $(this).attr("data-id");
				} else if(_.guess == $(this).attr("data-id") && !$(this).hasClass("picked")){
					$(".picked").addClass("matched");
					_.guess = null;
				} else {
					_.guess = null;
					_.paused = true;
					setTimeout(function(){
						$(".picked").removeClass("picked");
						Memory.paused = false;
					}, 600);
				}
				if($(".matched").length == $(".card").length){
					_.win();
				}
			}
		},

		win: function(){
			this.paused = true;
			setTimeout(function(){
				Memory.showModal();
				Memory.$game.fadeOut();
			}, 1000);
		},

		showModal: function(){
			this.$overlay.show();
			this.$modal.fadeIn("slow");
		},

		hideModal: function(){
			this.$overlay.hide();
			this.$modal.hide();
		},

		reset: function(){
			this.hideModal();
			this.shuffleCards(this.cardsArray);
			this.setup();
			this.$game.show("slow");
		},

		// Fisher--Yates Algorithm -- https://bost.ocks.org/mike/shuffle/
		shuffle: function(array){
			var counter = array.length, temp, index;
	   	// While there are elements in the array
	   	while (counter > 0) {
        	// Pick a random index
        	index = Math.floor(Math.random() * counter);
        	// Decrease counter by 1
        	counter--;
        	// And swap the last element with it
        	temp = array[counter];
        	array[counter] = array[index];
        	array[index] = temp;
	    	}
	    	return array;
		},

		buildHTML: function(){
			var frag = '';
			this.$cards.each(function(k, v){
				frag += '<div class="card" data-id="'+ v.id +'"><div class="inside">\
				<div class="front"><img src="'+ v.img +'"\
				alt="'+ v.name +'" /></div>\
				<div class="back"><img src="public/Medias/LOGO OFFICIEL TRISTAN (Transparent).png"\
				alt="Codepen" /></div></div>\
				</div>';
			});
			return frag;
		}
	};

	var cards = [
		{
			name: "F1JP",
			img: "Admin/files/Japan F1.jpg",
			id: 1,
		},
		{
			name: "Girl-neon",
			img: "Admin/files/Girl neon.png",
			id: 2
		},
		{
			name: "Samus",
			img: "Admin/files/Samus.jpg",
			id: 3
		},
		{
			name: "Yoshi Nike",
			img: "Admin/files/Yoshi Nike.png",
			id: 4
		}, 
		{
			name: "Dragon Squad",
			img: "Admin/files/Dragon Squad.png",
			id: 5
		},
		{
			name: "Nicki Lauda",
			img: "Admin/files/Nicki Lauda.jpg",
			id: 6
		},
		{
			name: "Toons_F1",
			img: "Admin/files/Toons_F1.jpg",
			id: 7
		},
		{
			name: "BMW",
			img: "Admin/files/Bmw.jpg",
			id: 8
		},
		{
			name: "Red wolf blue girl0000",
			img: "Admin/files/Red wolf blue girl0000.jpg",
			id: 9
		},
		{
			name: "Samouraï",
			img: "Admin/files/Tiger Samouraï0000.jpg",
			id: 10
		},
		{
			name: "sublime",
			img: "Admin/files/Templar x wolf.png",
			id: 11
		},
		{
			name: "Planète logo",
			img: "Admin/files/Planète logo.png",
			id: 12
		},
	];
    
	Memory.init(cards);


})();