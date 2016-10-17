<?php
/**
 *
 * A class to create RSS feeds using DOM
 *
 * @Author Kevin Waterson
 *
 * @copyright 2009
 *
 * @author Kevin Waterson
 *
 * @license BSD
 *
 */
class Blog_RSS extends DomDocument
{
    /**
     * @ the RSS channel
     */
    private $channel;

    /**
     *
     * @Constructor, duh! Set up the DOM environment
     *
     * @access public
     *
     * @param string $title The site title
     *
     * @param string $link The link to the site
     *
     * @param string $description The site description
     *
     */
    public function __construct($title, $link, $description)
    {
        /*** call the parent constructor ***/
        parent::__construct("1.0", "UTF-8");

        /*** format the created XML ***/
        $this->formatOutput = true;

        /*** craete the root element ***/
        $root = $this->appendChild($this->createElement('rss'));

        /*** set to rss2 ***/
        $root->setAttribute('version', '2.0');

        /*** set the channel node **/
        $this->channel = $root->appendChild($this->createElement('channel'));

        /*** set the title link and description elements ***/
        $this->channel->appendChild($this->createElement('title', $title));
        $this->channel->appendChild($this->createElement('link', $link));
        $this->channel->appendChild($this->createElement('description', $description));
    }


    /**
     *
     * @Add Items to the RSS Feed
     *
     * @access public
     *
     * @param array $items
     *
     * @return object Instance of self for method chaining
     *
     */
    public function addItem($items)
    {
        /*** create an item ***/
        $item = $this->createElement('item');
        foreach($items as $element=>$value)
        {
            switch($element)
            {
                /*** create sub elements here ***/
                case 'image':
                case 'skipHour':
                case 'skipDay':
                $im = $this->createElement($element);
                $this->channel->appendChild($im);
                foreach( $value as $sub_element=>$sub_value )
                {
                    $sub = $this->createElement($sub_element, $sub_value);
                    $im->appendChild( $sub );
                }
                break;

                case 'title':
                case 'pubDate':
                case 'link':
                case 'description':
                case 'copyright':
                case 'managingEditor':
                case 'webMaster':
                case 'lastbuildDate':
                case 'category':
                case 'generator':
                case 'docs':
                case 'language':
                case 'cloud':
                case 'ttl':
                case 'rating':
                case 'textInput':
                case 'source':
                // $new = $item->appendChild($this->createElement($element, htmlentities($value, ENT_QUOTES, 'UTF-8')));
                $new = $item->appendChild($this->createElement(
                    $element,
                    htmlspecialchars($value, ENT_QUOTES, "UTF-8")
                    //filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH)
                ));
                break;
            }
        }
        /*** append the item to the channel ***/
        $this->channel->appendChild($item);

        /*** allow chaining ***/
        return $this;
    }

    /***
     *
     * @create the XML
     *
     * @access public
     *
     * @return string The XML string
     *
     */
    public function __toString()
    {
        return $this->saveXML();
    }
}
