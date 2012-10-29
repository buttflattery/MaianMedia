$(document).ready(function(){
	jQuery.noConflict();
	jQuery('.jp-audio').each(function(index, obj){
	    //you can use this to access the current item

		var div =jQuery(this).attr('id');

		var id = div.substring(13);

		var jp_mp3 = jQuery("#mp3_"+id).val();
		var jp_m4a = jQuery("#m4a_"+id).val();
		var jp_ogg = jQuery("#ogg_"+id).val();

		jQuery("#jquery_jplayer_"+id).jPlayer({

			ready: function () {
				$(this).jPlayer("setMedia", {
					mp3:jp_mp3,
					m4a:jp_m4a,
					oga:jp_ogg
				});
			},
			play: function() { // To avoid both jPlayers playing together.
				$(this).jPlayer("pauseOthers");
			},
			swfPath: "/components/com_maianmedia/players/JPlayer/js",
			supplied: "mp3,m4a, oga",
			solution:"flash, html",
			wmode: "window"
		});
		
	});
	
});