<?php
/**
 * This file contains the Template Class for the Configuration Form
 *
 * Php version 7.4
 * 
 * @package ConfigGenerator
 * @author Peter Dohmen <pdohmen91@gmail.com>
 * @category Template
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 */
namespace ConfigGenerator;

/**
 * ConfigTemplate
 * @package ConfigCreator
 * @author Peter Dohmen <pdohmen91@gmail.com>
 */
class ConfigTemplate
{
    /**
     * This method renders the beginning of the document.
     *
     * @return string
     */
    public static function documentHeader():string
    {
        $lRet = <<<EOD
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Config Builder</title>
            <!-- Favicon-->
            <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        </head>
        <body style="padding:15px;">
        <header>
            <div class="jumbotron">
                <h1 class="display-4">Config Builder</h1>
                <p class="lead">This is a simple interface which can help setting up your config file.</p>
                <hr class="my-4">
                <p>It uses the configIn.json File to create this form.</p>
            </div>
        </header>
        EOD;

        return $lRet;
    }
    
    /**
     * This method renders the end of the document.
     *
     * @return string
     */
    public static function documentFooter():string
    {
        $lRet = <<<EOD
            <a id="back-to-top" href="#" class="btn btn-dark btn-lg back-to-top" role="button" style="display:none;">Back to Top</a>

            <!-- Bootstrap core JS-->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Init JS -->
            <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });

            $(document).ready(function(){
              $(window).scroll(function () {
                      if ($(this).scrollTop() > 50) {
                          $('#back-to-top').fadeIn();
                      } else {
                          $('#back-to-top').fadeOut();
                      }
                  });
                  $('#back-to-top').click(function () {
                      $('body,html').animate({
                          scrollTop: 0
                      }, 400);
                      return false;
                  });
          });
          </script>
        </body>
        </html>
        EOD;

        return $lRet;
    }
    
    /**
     * This method renders errors which might appear inside the form.
     *
     * @param  mixed $aError
     * @return string
     */
    public static function error(string $aError):string
    {
        $lRet = <<<EOD
        <div class="alert alert-danger" role="alert">
            Error: $aError
        </div>
        EOD;

        return $lRet;
    }
    
    /**
     * This method renders the beginning of the config form.
     *
     * @return string
     */
    public static function formHeader():string
    {
        $lRet = '<form>';
        return $lRet;
    }
    
    /**
     * This method renders the end of the config form.
     *
     * @return string
     */
    public static function formFooter():string
    {
        $lRet = '</form>';
        return $lRet;
    }
    
    /**
     * This method renders the headline of a new section.
     * Sectons can be created by nesting configs deeper in the given json.
     * Each section will be displayed with a headline and the given text. 
     * The headline will be a html h1 to h6. Levels higher than 6 will be rendered as h6.
     * @example
     * <code>
     * {
     * "section1": {
     *   "nested-section": {
     *       "config": { ... }
     *     }
     *   }
     * }
     * </code>
     *
     * @param  mixed $aName
     * @param  mixed $aLevel
     * @return string
     */
    public static function sectionHeadline(string $aName, int $aLevel):string
    {
        $lSectionName = ucfirst($aName);
        $lLevel = ($aLevel >= 6) ? 6 : $aLevel;
        
        $lRet = <<<EOD
        <h$lLevel>$lSectionName</h$lLevel>
        EOD;

        return $lRet;
    }
        
    /**
     * This method renders a complete form group element for text configurations.
     *
     * @param  mixed $aCode
     * @param  mixed $aName
     * @param  mixed $aDefault
     * @param  mixed $aDescription
     * @param  mixed $aBreaking
     * @return string
     */
    public static function textField(
        string $aCode,
        string $aName,
        string $aDefault,
        string $aDescription,
        bool $aBreaking,
        string $aLink
    ):string
    {
        $lMore = self::getMoreLink($aLink);
        
        $lRet = <<<EOD
        <div class="form-group">
            <label for="$aCode">%s $aName [$aCode]</label>
            <input type="text" class="form-control" id="$aCode" aria-describedby="$aCode.Help" placeholder="$aDefault">
            <small id="$aCode.Help" class="form-text text-muted">$aDescription $lMore</small>
        </div>
        EOD;

        return sprintf($lRet, self::breakingInfo($aBreaking));
    }
    
    /**
     * This method renders a complete form group element for selection fields
     *
     * @param  mixed $aCode
     * @param  mixed $aName
     * @param  mixed $aDefault
     * @param  mixed $aDescription
     * @param  mixed $aBreaking
     * @param  mixed $aEnum
     * @return string
     */
    public static function selectionField(
        string $aCode,
        string $aName,
        string $aDefault,
        string $aDescription,
        bool $aBreaking,
        array $aEnum,
        string $aLink
    ):string {
        $lMore = self::getMoreLink($aLink);
        
        $lRet = <<<EOD
        <div class="form-group">
            <label for="$aCode">%s $aName [$aCode]</label>
            <select class="form-control" id="$aCode" aria-describedby="$aCode.Help">
        EOD;

        foreach ($aEnum as $lKey => $lOption) {
            if ($lKey == $aDefault) {
                $lSelected = 'selected="selected"';
            } else {
                $lSelected = '';
            }

            $lRet .= '<option value="'.$lKey.'" '.$lSelected.'>'.$lOption.'</option>';
        }
        $lRet .= '</select>';
        $lRet .= '<small id="'.$aCode.'.Help" class="form-text text-muted">'.$aDescription.' '.$lMore.'</small>';
        $lRet .= '</div>';

        return sprintf($lRet, self::breakingInfo($aBreaking));
    }
    
    /**
     * This method renders a complete form group element for number configurations
     *
     * @param  mixed $aCode
     * @param  mixed $aName
     * @param  mixed $aDefault
     * @param  mixed $aDescription
     * @param  mixed $aMin
     * @param  mixed $aMax
     * @param  mixed $aStep
     * @param  mixed $aBreaking
     * @return string
     */
    public static function numberField(
        string $aCode,
        string $aName,
        string $aDefault,
        string $aDescription,
        string $aMin,
        string $aMax,
        string $aStep,
        $aBreaking,
        string $aLink
    ):string {
        $lMore = self::getMoreLink($aLink);
        
        $lRet = <<<EOD
        <div class="form-group">
            <label for="$aCode">%s $aName [$aCode]</label>
            <input type="number" class="form-control" id="$aCode" aria-describedby="$aCode.Help" placeholder="$aDefault" min="$aMin" max="$aMax" step="$aStep">
            <small id="$aCode.Help" class="form-text text-muted">$aDescription $lMore</small>
        </div>
        EOD;
        
        
        return sprintf($lRet, self::breakingInfo($aBreaking));
    }
    
    /**
     * This method defines how an info icon will look like which tells the user that the config might break the system when it is changed.
     *
     * @param  mixed $aBreaking
     * @return string
     */
    public static function breakingInfo(bool $aBreaking):string
    {
        if ($aBreaking) {
            return '<i class="bi bi-exclamation-triangle" data-toggle="tooltip" data-placement="top" title="Changes in this config could make your system unavailable."></i>';
        }

        return '';
    }
    
    /**
     * This method defines how a link with additional information for the current config will look like.
     *
     * @param  mixed $aLink
     * @return string
     */
    public static function getMoreLink(string $aLink):string
    {
        if (!empty($aLink)) {
            return 'More Details: <a href="'.$aLink.'" target="_blank" rel="noreferrer">External Link</a>';
        }

        return '';
    }
}