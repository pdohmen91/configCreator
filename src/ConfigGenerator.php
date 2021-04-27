<?php

namespace ConfigGenerator;

use ConfigGenerator\ConfigRenderer;

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
        $lConfigInputArray = $this->parseConfigurationInput($lConfigInput);
        
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
        return json_decode($aInput, true);
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

        return file_get_contents($aFilePath);
    }
}