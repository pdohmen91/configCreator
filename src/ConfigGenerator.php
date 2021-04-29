<?php

namespace ConfigGenerator;

use ConfigGenerator\ConfigRenderer;
use ConfigGenerator\ErrorRenderer;

/**
 * ConfigGenerator
 */
class ConfigGenerator {

    /**
     * run
     *
     * @return void
     */
    public function run(): void {
        //Read Config Input File
        $lConfigInput = $this->readFile('configIn.json');
        if(empty($lConfigInput)) {
            $lConfigRenderer = new ErrorRenderer("configIn.json is empty, was not found or could not be opened");
        }
        $lConfigInputArray = $this->parseConfigurationInput($lConfigInput);
        asort($lConfigInputArray);

        //Render Config Form
        $lConfigRenderer = new ConfigRenderer($lConfigInputArray);
        $lConfigRenderer->render();
    }
    
    /**
     * parseConfigurationInput
     *
     * @param  mixed $aInput
     * @return array
     */
    private function parseConfigurationInput(string $aInput): array {
        $lJson =  json_decode($aInput, true);

        if ($lJson === null && json_last_error() !== JSON_ERROR_NONE) {
            $lConfigRenderer = new ErrorRenderer("json structure not valid");
        }
        
        return $lJson;
    }
    
    /**
     * readFile
     *
     * @param  mixed $aFilePath
     * @return string
     */
    private function readFile(string $aFilePath): string {
        if(!is_file($aFilePath)) {
            return '';
        }

        return mb_convert_encoding(file_get_contents($aFilePath), 'HTML-ENTITIES', "UTF-8");
    }
}