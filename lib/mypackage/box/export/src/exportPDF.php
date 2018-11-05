<?php
namespace Box\Export;
require_once ('exportfpdf.php');
class ExportPDF extends \ExportFPDF
{
    /*
   * font family get font from font
     font size type interger
     font style get in array ['B','I']
   */
    public function __construct($font_family = 'Arial', $font_size = 16, $font_style = 'B')
    {
        parent::__construct();
        $this->font_family = $font_family;
        $this->font_size = $font_size;
        $this->font_style = $font_style;
    }

    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';

    function WriteHTML($html)
    {
        // HTML parser
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                // Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            }
            else
            {
                // Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    // Extract attributes
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        // Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        // Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable)
    {
        // Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt)
    {
        // Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
    public function printPDF($content)
    {
        $html = '<div>You can now easily print text mixing different styles: <b>bold</b>, <i>italic</i>,
<u>underlined</u>, or <b><i><u>all at once</u></i></b>!<br><br>You can also insert links on
text, such as <a href="http://www.fpdf.org">www.fpdf.org</a>, or on an image: click on the logo.</div>';
        // First page
        $this->AddPage();
        $this->SetFont('Arial','',20);
        $this->Write(5,"To find out what's new in this tutorial, click ");
        $this->SetFont('','U');
        $link = $this->AddLink();
        $this->Write(5,'here',$link);
        $this->SetFont('');
// Second page
        $this->AddPage();
        $this->SetLink($link);
        $this->Image('D:\logo.png',10,12,30,0,'','http://www.fpdf.org');
        $this->SetLeftMargin(45);
        $this->SetFontSize(14);
        $this->WriteHTML($html);
        $this->Output();
    }
}