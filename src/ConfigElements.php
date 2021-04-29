<?php

namespace ConfigGenerator;

class ConfigElements
{
    /**
     * DocumentHeader
     *
     * @return string
     */
    public static function DocumentHeader():string
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
     * DocumentFooter
     *
     * @return string
     */
    public static function DocumentFooter():string
    {
        $lRet = <<<EOD
            <!-- Bootstrap core JS-->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS-->
            <script src="js/scripts.js"></script>
            <!-- Init JS -->
            <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
            </script>
        </body>
        </html>
        EOD;

        return $lRet;
    }
    
    /**
     * Error
     *
     * @param  mixed $aError
     * @return string
     */
    public static function Error(string $aError):string
    {
        $lRet = <<<EOD
        <div class="alert alert-danger" role="alert">
            Error: $aError
        </div>
        EOD;

        return $lRet;
    }
    
    /**
     * FormHeader
     *
     * @return string
     */
    public static function FormHeader():string
    {
        $lRet = '<form>';
        return $lRet;
    }
    
    /**
     * FormFooter
     *
     * @return string
     */
    public static function FormFooter():string
    {
        $lRet = '</form>';
        return $lRet;
    }
        
    /**
     * TextField
     *
     * @param  mixed $aCode
     * @param  mixed $aName
     * @param  mixed $aDefault
     * @param  mixed $aDescription
     * @param  mixed $aBreaking
     * @return string
     */
    public static function TextField(string $aCode, string $aName, string $aDefault, string $aDescription, bool $aBreaking, string $aLink):string
    {
        $lMore = self::getMoreLink($aLink);
        
        $lRet = <<<EOD
        <div class="form-group">
            <label for="$aCode">%s $aName [$aCode]</label>
            <input type="text" class="form-control" id="$aCode" aria-describedby="$aCode.Help" placeholder="$aDefault">
            <small id="$aCode.Help" class="form-text text-muted">$aDescription $lMore</small>
        </div>
        EOD;

        return sprintf($lRet, self::BreakingInfo($aBreaking));
    }
    
    /**
     * SelectionField
     *
     * @param  mixed $aCode
     * @param  mixed $aName
     * @param  mixed $aDefault
     * @param  mixed $aDescription
     * @param  mixed $aBreaking
     * @param  mixed $aEnum
     * @return string
     */
    public static function SelectionField(string $aCode, string $aName, string $aDefault, string $aDescription, bool $aBreaking, array $aEnum, string $aLink):string
    {
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

        return sprintf($lRet, self::BreakingInfo($aBreaking));
    }
    
    /**
     * NumberField
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
    public static function NumberField(string $aCode, string $aName, string $aDefault, string $aDescription, string $aMin, string $aMax, string $aStep, $aBreaking, string $aLink):string
    {
        $lMore = self::getMoreLink($aLink);
        
        $lRet = <<<EOD
        <div class="form-group">
            <label for="$aCode">%s $aName [$aCode]</label>
            <input type="number" class="form-control" id="$aCode" aria-describedby="$aCode.Help" placeholder="$aDefault" min="$aMin" max="$aMax" step="$aStep">
            <small id="$aCode.Help" class="form-text text-muted">$aDescription $lMore</small>
        </div>
        EOD;
        
        
        return sprintf($lRet, self::BreakingInfo($aBreaking));
    }
    
    /**
     * BreakingInfo
     *
     * @param  mixed $aBreaking
     * @return string
     */
    public static function BreakingInfo(bool $aBreaking):string
    {
        if ($aBreaking) {
            return '<i class="bi bi-exclamation-triangle" data-toggle="tooltip" data-placement="top" title="Changes in this config could make your system unavailable."></i>';
        }

        return '';
    }

    public static function getMoreLink(string $aLink):string
    {
        if(!empty($aLink)) {
            return 'More Details: <a href="'.$aLink.'" target="_blank" rel="noreferrer">External Link</a>';
        }

        return '';
    }
}
