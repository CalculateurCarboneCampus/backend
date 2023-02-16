<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Cms\Site;
use Kirby\Cms\User;

/**
 * @var App   $kirby
 * @var Site  $site
 * @var Pages $pages
 * @var Page  $page
 */

$userPublic  = $kirby->user('public@public.com');

$userPublic->login('publicKey');

/**
 * @param mixed $newUserName
 * @param mixed $newUserMail
 * @param mixed $newUserPassword
 * @return null[]|User[]|Exception[]
 */
function createUser(mixed $newUserName, mixed $newUserMail, mixed $newUserPassword) {

  if(! $newUserName)      return ['error' => new Exception("le nom d'utilisateur est vide")];
  if(! $newUserMail)      return ['error' => new Exception("le nom mail est vide")];
  if(! $newUserPassword)  return ['error' => new Exception("le nom mot de passe est vide")];

  try {
    return [
      'error' => null,
      'user'  =>     User::create([
        'name'      => $newUserName,
        'email'     => $newUserMail,
        'password'  => $newUserPassword,

        'role'      => 'editor',
        'language'  => 'fr',
      ])
    ];
  } catch(Exception $createUserError) {
    return [
      'error' => $createUserError,
    ];
  }
}

$newUser = createUser(get('newUserName'), get('newUserMail'), get('newUserPassword'));



echo get('newUserName');
echo get('newUserMail');
echo get('newUserPassword');


if(! $newUser['error']) {
    $newUserName = get('newUserName');
    $newUserMail = get('newUserMail');

    echo json_encode([
        'status'    => 'success',
        'message'   => "le compte de $newUserName, $newUserMail, à été créé avec succès!",
    ]);
    return;
}

else echo json_encode([
    'status'    => 'error',
    'message'   => $newUser['error']->getMessage(),
]);
return;


?>
