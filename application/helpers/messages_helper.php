<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Wrapped Validation Errors
 *
 * Determines whether or not validation errors are present. If they are, the errors are wrapped
 * in the appropriate HTML container and returned.
 *
 * @author Sean Ephraim
 * @access	public
 * @return	mixed	depends on the presence of errors
 */
if ( ! function_exists('wrapped_validation_errors')) {
	function wrapped_validation_errors() {
    if (validation_errors()) {
      // Wrap errors
      $html  = '<div class="error rounded">';
      $html .= '  <a class="close" data-dismiss="alert" href="#">&times;</a>';
      $html .=    validation_errors();
      $html .= '</div>';

      return $html;
    }

    return NULL;
	}
}

/**
 * Wrapped Flashdata Errors
 *
 * Determines whether or not errors are present in the flashdata. If they are, 
 * the errors are wrapped the appropriate HTML container and returned.
 *
 * NOTE: before using, you must set flashdata 'error', i.e.
 *   $this->session->set_flashdata('error', '<p>Incorrect password or username.</p>');
 *
 * @author Sean Ephraim
 * @access	public
 * @param 	string The flashdata key where the errors are stored
 * @return	mixed	depends on the presence of errors
 */
if ( ! function_exists('wrapped_flashdata_errors')) {
	function wrapped_flashdata_errors($error = NULL) {
    if ($error === NULL) {
      $error = get_instance()->session->flashdata('error');
    }

    if ($error) {
      // Add <p> tags if missing
      if ( ! strstr($error, '<p>')) {
        $error = '<p>'.$error.'</p>';
      }
      // Wrap errors
      $html  = '<div class="error rounded">';
      $html .= '  <a class="close" data-dismiss="alert" href="#">&times;</a>';
      $html .=    $error;
      $html .= '</div>';

      return $html;
    }

    return NULL;
	}
}

/**
 * Wrapped Flashdata Successes
 *
 * Determines whether or not success messages are present in the flashdata. If they are, 
 * the messages are wrapped in the appropriate HTML container and returned.
 *
 * NOTE: before using, you must set flashdata 'success', i.e.
 *   $this->session->set_flashdata('success', '<p>Login successful!</p>');
 *
 * @author Sean Ephraim
 * @access	public
 * @param string The flashdata key where the success messages are stored
 * @return	mixed	depends on the presence of success messages
 */
if ( ! function_exists('wrapped_flashdata_successes')) {
	function wrapped_flashdata_successes($success = NULL) {
    if ($success === NULL) {
      $success = get_instance()->session->flashdata('success');
    }

    if ($success) {
      // Add <p> tags if missing
      if ( ! strstr($success, '<p>')) {
        $success = '<p>'.$success.'</p>';
      }

      // Wrap successes
      $html  = '<div class="success rounded">';
      $html .= '  <a class="close" data-dismiss="alert" href="#">&times;</a>';
      $html .=    $success;
      $html .= '</div>';

      return $html;
    }

    return NULL;
	}
}

/**
 * Wrapped Flashdata Warnings
 *
 * Determines whether or not warning messages are present in the flashdata. If they are, 
 * the messages are wrapped in the appropriate HTML container and returned.
 *
 * NOTE: before using, you must set flashdata 'warning', i.e.
 *   $this->session->set_flashdata('warning', 'Unsupported browser!');
 *
 * @author  Sean Ephraim
 * @access	public
 * @param   string   The flashdata key where the warning messages are stored
 * @return	string	 Proper HTML
 */
if ( ! function_exists('wrapped_flashdata_warnings')) {
	function wrapped_flashdata_warnings($warning = NULL) {
    if ($warning === NULL) {
      $warning = get_instance()->session->flashdata('warning');
    }

    if ($warning) {
      // Add <p> tags if missing
      if ( ! strstr($warning, '<p>')) {
        $warning = '<p>'.$warning.'</p>';
      }

      // Wrap warnings
      $html  = '<div class="warning rounded">';
      $html .= '  <a class="close" data-dismiss="alert" href="#">&times;</a>';
      $html .=    $warning;
      $html .= '</div>';

      return $html;
    }

    return NULL;
	}
}

/**
 * Unsupported Browser Warning
 *
 * Determines whether or not the user's browser is supported or not.
 * The message will display only if the user is using Internet Explorer 8 or less
 * and is using the editor (not the public site).
 *
 * @author  Sean Ephraim
 * @access	public
 * @return	string	 Proper HTML
 */
if ( ! function_exists('unsupported_browser_warning')) {
	function unsupported_browser_warning() {
    if (get_instance()->agent->is_browser('Internet Explorer') &&
         get_instance()->agent->version() < 9) {
      $html  = '<div class="warning rounded">';
      $html .= '  You are using an old version of Internet Explorer which could cause this website to act abnormally. Please use a modern browser like <a href="http://www.chrome.com/">Chrome</a>, <a href="http://www.firefox.com/">Firefox</a>, or <a href="http://www.opera.com/">Opera</a> instead.';
      $html .= '</div>';
  
      return $html;
    }
    return NULL;
	}
}

/**
 * All Messages
 *
 * Retrives all messages stored in validation_errors(), flashdata('error'), and
 * flashdata('success'), flashdata('warning') wraps them in the appropriate containers
 * and returns the prettified HTML. This should really only need to be called in the
 * header.php layout file.
 * 
 * @author Sean Ephraim
 * @access public
 * @return string
 */
if ( ! function_exists('all_messages')) {
	function all_messages() {
    $html  = unsupported_browser_warning();
    $html .= wrapped_flashdata_successes();
    $html .= wrapped_flashdata_warnings();
    $html .= wrapped_flashdata_errors();
    $html .= wrapped_validation_errors();

    return $html;
  }
}

/**
 * First Time Visitor Message
 *
 * This message is displayed on the public site when a new visitor is detected.
 *
 * @author Sean Ephraim
 * @access	public
 * @return	string	Proper HTML
 */
if ( ! function_exists('first_time_visitor_message')) {
	function first_time_visitor_message() {
    if ( ! isset($_COOKIE['mdb_visited'])) {
      $html  = '<div id="first-time">';
      $html .= '  Looks like you&#8217;re a first-time visitor! We strongly recommend <a href="'.site_url('help').'" title="How to use the site">reading through our help page</a> to get started. You can always find a link to that page in the sidebar.';
      $html .= '</div>';
      return $html;
    }

    return NULL;
	}
}

/**
 * Email Message
 *
 * This message is displayed on the public site when a user sends
 * an email via the contact form.
 *
 * @author Sean Ephraim
 * @access	public
 * @return	string	Proper HTML
 */
if ( ! function_exists('email_message')) {
	function email_message() {
    $email_success = get_instance()->session->flashdata('email_success');
    $email_error = get_instance()->session->flashdata('email_error');
    if ($email_error === TRUE) {
      // Error message
      $html  = '<div class="error rounded">'
             . '  <a href="#" class="close">x</a>'
             . '  There was a problem sending your request. Please try again.'
             . '</div>';
      return $html;
    }
    else if ($email_success === TRUE) {
      // Success message
      $html  = '<div class="success rounded">'
             . '  <a href="#" class="close">x</a>'
             . '  Thank you! We will get in touch with you shortly.'
             . '</div>';
      return $html;
    }

    return NULL;
	}
}
