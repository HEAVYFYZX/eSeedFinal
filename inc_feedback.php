<?php if (count($messages)) : ?>

	<div class="feedback">
		<h2>Feedback</h2>
		<ul>
			<?php foreach($messages as $message): ?>
				<li><?php echo $message; ?></li>
			<?php endforeach; ?>
		</ul>
	</div>

<?php endif; ?>