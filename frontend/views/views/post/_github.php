<?php

use kartik\social\GithubXPlugin;
use backend\models\Profile;


$profile = Profile::find()->orderBy('id ASC')->limit(1)->one();
$profile = explode('https://github.com/',$profile->github);
$name = implode($profile);

if(!empty($repo) && !empty($profile)){
echo GithubXPlugin::widget(['type'=>GithubXPlugin::WATCH, 'user'=>$name, 'repo'=>$repo]);
echo GithubXPlugin::widget(['type'=>GithubXPlugin::STAR, 'user'=>$name, 'repo'=>$repo]);
echo GithubXPlugin::widget(['type'=>GithubXPlugin::FORK, 'user'=>$name, 'repo'=>$repo]);
echo GithubXPlugin::widget(['type'=>GithubXPlugin::FOLLOW, 'user'=>$name, 'repo'=>$repo]);
}