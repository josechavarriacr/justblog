<?php
Yii::$app->site->getMetaTags();
?>

<div class="site-index">

	<div class="jumbotron">
		<h1>Blog de Jose</h1>
		<p class="lead">
			<span class="label label-info">Cloud</span>
			<span class="label label-success">Big Data</span>
			<span class="label label-primary">Machine Learning</span>
			<span class="label label-danger">Cybersecurity</span>
		</p>
	</div>

	<div class="body-content">

		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<?php
				Yii::$app->sc->setStart(__LINE__);
				// ...in one move!
				echo "<h2>How it works</h2>";
				echo "<ol>";
				echo "<li>Write your code</li>";
				echo "<li>Show your code</li>";
				echo "</ol>";
				Yii::$app->sc->collect('php', Yii::$app->sc->getSourceToLine(__LINE__, __FILE__));
				Yii::$app->sc->renderSourceBox();
				?>
			</div>

			<div class="col-sm-6 col-sm-offset-3">
			<div class="col-lg-10 col-lg-offset-1">
					<img src="uploads/meta/screen.gif" alt="">
				</div>
			</div>

		</div>
		<div class="row">
			<div class="col-lg-4">
				<h2>Heading</h2>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
					dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
					ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
					fugiat nulla pariatur.</p>

					<p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
				</div>
				<div class="col-lg-4">
					<h2>Heading</h2>

					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
						dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
						ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
						fugiat nulla pariatur.</p>

						<p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
					</div>
					<div class="col-lg-4">
						<h2>Heading</h2>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
							dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
							ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
							fugiat nulla pariatur.</p>

							<p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
						</div>
					</div>

				</div>
			</div>
