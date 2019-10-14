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
      $current_path = \Drupal::request()->getRequestUri();
      $markup = '<p>Please login to view this page.</p>';
      $markup .= '<p><a class="link-button" href="/saml_login?destination='.$current_path.'">Login with your Cornell NetID</a></p>';
      $markup .= '<p><a class="link-button" href="/user/login?destination='.$current_path.'">Login for Non-Cornell users</a></p>';
      return $markup;
    }
    else {
      $current_path = \Drupal::request()->getRequestUri();
      $markup = '<p>You don\'t have access to this page.</p>';
      return $markup;
    }
  }
}
