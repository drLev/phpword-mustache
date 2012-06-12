<?php
/**
 * Description of PHPWord_Template_Mustache
 *
 * @author dr_Lev
 */
class PHPWord_TemplateMustache {
    
    /**
     * Mustache template object
     * @var Mustache
     */
    protected $templator = null;
    
    /**
     * Create a new Template Object
     * 
     * @param type $strFilename
     * @param Mustache $templator 
     */
    public function __construct($strFilename, Mustache $templator){
        
        parent::__construct($strFilename);
        $this->templator = $templator;
    }
    
	/**
	 * Render the given template and view object.
	 *
	 * Defaults to the template and view passed to the class constructor unless a new one is provided.
	 * Optionally, pass an associative array of partials as well.
	 *
	 * @access public
	 * @param string $template (default: null)
	 * @param mixed $view (default: null)
	 * @param array $partials (default: null)
	 * @return string Rendered Mustache template.
	 */
    public function render() {
                
        $patternMustache = '/(?<=\{\{)(.)*?(?=\}\})/i';
        $patternTags = '/(?<=<)(.)*?(?=>)/i';

        preg_match_all($patternMustache, $this->_documentXML, $mustaches);

        foreach ($mustaches[0] as $mustache){
            $clearMustache = str_replace('<>', '', preg_replace($patternTags, '', $mustache));
            $this->_documentXML = str_replace("{{{$mustache}}}", "{{{$clearMustache}}}", $this->_documentXML);
        }

        $this->_documentXML = $this->templator->render($this->_documentXML);
    }
}

?>
