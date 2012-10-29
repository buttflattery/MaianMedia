<div id="home-message">
<?php echo $tplDisplayHome['HOME_MESSAGE'] ?>
</div>

<div id="popular_list">
<?php if($tplDisplayHome['show_track'] == '1'){ ?>
	<div id="most_popular_tracks_list">
		<div id="most_popular_tracks">
		<?php echo $tplDisplayHome['MOST_POPULAR_TRACKS'] ?>
		</div>
		<br> <br>
		<div class="popular">
		<?php echo $tplDisplayHome['MOST_POPULAR_TRACKS_LIST'] ?>
		</div>
	</div>
	<?php }

	if($tplDisplayHome['show_latest_track'] == '1'){ ?>
	<div id="latest_tracks_list">
		<div id="latest_tracks">
		<?php echo $tplDisplayHome['LATEST_TRACKS'] ?>
		</div>
		<br> <br>
		<div class="popular">
		<?php echo $tplDisplayHome['LATEST_TRACKS_LIST'] ?>
		</div>
	</div>
	<?php }

	if($tplDisplayHome['show_albums'] == '1'){ ?>
	<div id="most_popular_albums_list">
		<div id="most_popular_albums">
		<?php echo $tplDisplayHome['MOST_POPULAR_ALBUMS'] ?>
		</div>
		<br> <br>
		<div class="popular">
		<?php echo $tplDisplayHome['MOST_POPULAR_ALBUMS_LIST'] ?>
		</div>
	</div>
	<?php }

	if($tplDisplayHome['show_latest_albums'] == '1'){ ?>
	<div id="latest_albums_list">
		<div id="latest_albums">
		<?php echo $tplDisplayHome['LATEST_ALBUMS'] ?>
		</div>
		<br> <br>
		<div class="popular">
		<?php echo $tplDisplayHome['LATEST_ALBUMS_LIST'] ?>
		</div>
	</div>
	<?php } ?>
</div>



