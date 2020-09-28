    </div>
                </section>
            </div>
        </div>
    </article>

<?php endwhile; ?>

    <script>
			function onPlayerReady(event) {
				const videoId = document.getElementById('player').dataset.video;

		  <?php if ( $player_type === 'playlist' ) { ?>
				event.target.loadPlaylist({
					listType: 'playlist',
					list: videoId,
					suggestedQuality: 'large'
				});
		  <?php } else { ?>
				event.target.loadVideoById({
					videoId: videoId,
					'suggestedQuality': 'large'
				});
		  <?php } ?>

			}
    </script>