<?php use BarnabyWalters\Mf2 ?>
<div class="row demo-row">
	<h1><span class="fui-new"></span> Publishing on the IndieWeb <small>Level 2</small></h1>

	<h2>1. Mark up your content (Profile, Notes, Articles, etc…) with <a href="http://microformats.org/" target="_blank">microformats2</a></h2>
	
	<p>Other humans can already understand your profile information, and the things you post on your site. By adding a few simple classnames to your HTML, other people’s software can understand it all too, and use it for things like <a href="http://indiewebcamp.com/reply-context">reply contexts</a>, <a href="http://indiewebcamp.com/comment">cross-site comments</a>, <a href="http://indiewebcamp.com/rsvp">event RSVPs</a> and more.</p>
	
	<h4>Check your <strong>homepage <a href="http://microformats.org/wiki/h-card" target="_blank">h-card</a></strong>:</h4>
	
	<?php if ($error or $hCard): ?>
	<div class="result alert <?php if ($error): ?>alert-warning<?php else: ?>alert-success<?php endif ?>">
		<?php if ($error): ?>
		<h4>Something Went Wrong!</strong></h4>
		<p>When fetching <code><?= $url ?></code>, we got this problem:</p>
		<p><?= $error['message'] ?></p>
		<?php elseif ($hCard): ?>
		<h4>Success!</h4>
		
		<p>We found the following <code>h-card</code> on your site:</p>
		
		<div class="preview-h-card preview-block">
			<?php if (Mf2\hasProp($hCard, 'photo')): ?>
			<img class="photo-block" src="<?= Mf2\getProp($hCard, 'photo')?>" alt="" />
			<?php else: ?>
			<div class="empty-property-block photo-block">
				<p>Add a photo!</p>
				<p><code>&lt;img class=&quot;u-photo&quot; src=&quot;…&quot /></code></p>
			</div>
			<?php endif ?>
			<p class="p-name"><?= Mf2\getProp($hCard, 'name') ?></p>
			
			<p class="property-block-name">URL</p>
			<?php if (Mf2\hasProp($hCard, 'url')): ?>
			<ul>
				<?php foreach ($hCard['properties']['url'] as $pUrl): ?>
				<li><a href="<?= $Url ?>"><?= $pUrl ?></a></li>
				<?php endforeach ?>
			</ul>
			<?php else: ?>
			<div class="empty-property-block">
				<p>Add your URLs! <code class="pull-right">&lt;a rel=&quot;me&quot; class=&quot;u-url&quot;>…&lt;/a></code></p>
			</div>
			<?php endif ?>
			
			<p class="property-block-name">Email</p>
			<?php if (Mf2\hasProp($hCard, 'email')): ?>
			<ul>
				<?php foreach ($hCard['properties']['email'] as $email): ?>
				<li><a href="<?= $email ?>"><?= $email ?></a></li>
				<?php endforeach ?>
			</ul>
			<?php else: ?>
			<div class="empty-property-block">
				<p>Add your Email! <code class="pull-right">&lt;a rel=&quot;me&quot; class=&quot;u-email&quot;>…&lt;/a></code></p>
			</div>
			<?php endif ?>
			
			<p class="property-block-name">Note</p>
			<?php if (Mf2\hasProp($hCard, 'note')): ?>
			<p><?= Mf2\getProp($hCard, 'note') ?></p>
			<?php else: ?>
			<div class="empty-property-block">
				<p>Add a note/bio! <code class="pull-right">&lt;p class=&quot;p-note&quot;>…&lt/p></code></p>
			</div>
			<?php endif ?>
			
		</div>
		<?php endif ?>
		
		<?= $render('silo-hint.html', array('url' => $url)) ?>
	</div>
	<?php endif ?>
	
	<form class="row" action="/validate-h-card/" method="get">
		<div class="span4">
			<input type="text" id="validate-h-card-url" name="url" value="<?= $url ?>" placeholder="http://yoursite.com" class="span4" />
		</div>
		<div class="span3">
			<button type="submit" id="validate-h-card" class="btn btn-large btn-block btn-primary">Validate h-card</button>
		</div>
	</form>
	
	<small>Want to be able to use h-card data in your code? Check out the open-source <a href="http://microformats.org/wiki/parsers">implementations</a>.</small>
</div>