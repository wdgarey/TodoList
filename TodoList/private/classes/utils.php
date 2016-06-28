<?php
/**
 * The validation pattern for a valid e-mail address.
 */
define ("VALID_EMAIL_PATTERN", "/^[^@]*@[^@]*\.[^@]*$/");

class Utils
{

  /**
   * Creates a session if one does not already exist.
   */
  public static function TrackSession ()
  {
    if (session_id () == '')
    {
      session_start ();
    }
  }

  /**
   * Destroys a session if one exists.
   */
  public static function DestroySession ()
  {
    if (session_id () != '')
    {
      session_destroy ();
    }
  }
    
  /**
   * Redirects to a new page.
   * @param string $url The relative or absolute url of the page to go to.
   */
  public static function Redirect ($url)
  {
    header ("Location:" . $url);
    
    exit ();
  }
    
  /**
   * Gets the script for an action.
   * @param string $action The action to request from the controller.
   * @return The script to perform the given action.
   */
  public static function GetScript ($action)
  {
    $script = '../public/index.php' . '?' . 'Action' . '=' . $action;

    return $script;
  }
    
  /**
   * Get the requested URI.
   * @return string The requested URI.
   */
  public static function GetRequestedURI ()
  {
    $uri = urlencode ($_SERVER['REQUEST_URI']);
        
    return $uri;
  }
    
  /**
   * Converts a date string to the convientional format.
   * @param string $dateIn The current date string.
   * @return string The reformated date string.
   */
  public static function ToDisplayDate ($dateIn)
  {
    $phpDate = strtotime ($dateIn);
        
    if ($phpDate == FALSE)
    {
      return "";
    }
    else
    {
      return date ('m/d/Y', $phpDate);
    }		
  }
    
  /**
   * Converts a date string to the mySQL format.
   * @param string $dateIn The date string.
   * @return string The mySQL fomrated date string.
   */
  public static function ToMySQLDate ($dateIn)
  {
    $phpDate = strtotime ($dateIn);
        
    if ($phpDate == FALSE)
    {
      return "";
    }
    else
    {
      return date ('Y-m-d', $phpDate);
    }		
  }
    
  /**
   * Removes all special character slashes from information collected from the server.
   */
  public static function AdjustQuotes ()
  {
    if (get_magic_quotes_gpc () == true)
    {
      array_walk_recursive ($_GET, 'StripSlashes_GPC');
      array_walk_recursive ($_POST, 'StripSlashes_GPC');
      array_walk_recursive ($_COOKIE, 'StripSlashes_GPC');
      array_walk_recursive ($_REQUEST, 'StripSlashes_GPC');
    }
  }
    
  /**
   * Removes all special character slashes from a string.
   * @param string $value The string to remove slashes.
   */
  public static function StripSlashes_GPC (&$value)
  {
    $value = stripslashes ($value);
  }
    
  /**
   * Redircts the user through a secured connection.
   */
  public static function SecureConnection ()
  {
    if (!isset ($_SERVER['HTTPS']))
    {
      $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

      Utils::Redirect ($url);
    }
  }
    
  /**
   * Redirects the user through an un-secure connection.
   */
  public static function UnsecureConnection ($requestedPage = "")
  {
    if (isset ($_SERVER['HTTPS']))
    {
      $url = "";
            
      if (empty ($requestedPage))
      {
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      }
      else
      {
        $url = 'http://' . $_SERVER['HTTP_HOST'] .$requestedPage;
      }
            
      Utils::Redirect ($url);
    }
  }

  /**
   * Gets html-safe text.
   * @param string $text The raw text
   * @return string The html-safe text.
   */
  public static function GetHtmlSafe($text)
  {
    $safeText = htmlspecialchars($text);
            
    return $safeText;
  }
}
?>
