<?php
use backend\models\Profile;

$profile = Profile::find()->orderBy('id ASC')->limit(1)->one();
?>
<div class="footer-dark">
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-push-6 item text">
					<h3>Forkea este sitio</h3>
					<p>Desarrollado con pasión y gallo pinto para una mejor web, <a href="https://github.com/josechavarriacr/justblog" target="_blank">¡Forkealo!</a></p>
					<p>Code licensed <a href="https://github.com/josechavarriacr/justblog/blob/master/LICENSE.md" target="_blank" rel="license">MIT</a>, docs <a href="https://creativecommons.org/licenses/by/3.0/" target="_blank" rel="license">CC BY 3.0</a></p>
				</div>
				<div class="col-md-3 col-md-pull-6 col-sm-4 item text">
					<h3>Acerca de</h3>
					<p><a href="about">Sobre este sitio</a></p>
					<p><a href="privacy">Aviso de Privacidad</a></p>
				</div>
				<?php if (!is_null($profile)): ?>
					<div class="col-md-12 col-sm-4 item social">
						<a href="<?=$profile->facebook;?>" target="_blank"><i class="fa fa-facebook"></i></a>
						<a href="<?=$profile->twitter;?>" target="_blank"><i class="fa fa-twitter"></i></a>
						<a href="<?=$profile->linkedin;?>" target="_blank"><i class="fa fa-linkedin"></i></a>
						<a href="<?=$profile->github;?>" target="_blank"><i class="fa fa-github"></i></a>
					</div>
				<?php endif;?>
			</div>
			<p class="copyright">&copy; Jose Chavaría <?= date('Y') ?></p>
		</div>
	</div>
</footer>
</div>