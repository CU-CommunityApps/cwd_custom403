<?php
/**
 * @file
 * Contains \Drupal\cwd_custom403\Controller\Cwd403Controller.
 */
namespace Drupal\cwd_custom403\Controller;
class Cwd403Controller {
  public function content() {
    return array(
      '#type' => 'markup',
      '#markup' => $this->get_markup(),
    );
  }

  protected function get_markup() {
    $not_logged_in = \Drupal::currentUser()->isAnonymous();
    if($not_logged_in) {
      $config = \Drupal::config('cwd_custom403.custom403_configuration');
      $message = $config->getRawData()['403_custom_text'];
      $current_path = \Drupal::request()->getRequestUri();
      $markup = '<p>'.$message.'</p>';
      if($config->getRawData()['403_use_cornell']) {
        $markup .= '<p><a class="link-button" href="/saml_login?destination='.$current_path.'">Login with your Cornell NetID</a></p>';
      }
      if($config->getRawData()['403_use_drupal']) {
        $markup .= '<p><a class="link-button" href="/user/login?destination='.$current_path.'">Login for Non-Cornell users</a></p>';
      }
      return $markup;
    }
    else {
      $current_path = \Drupal::request()->getRequestUri();
      $markup = '<p>You don\'t have access to this page.</p>';
      return $markup;
    }
  }
}
