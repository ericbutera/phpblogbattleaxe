<?php
class Blog_Pingback {

    /**
     * @var baxe_App_Abstract
     */
    private $app;

    /**
     * Result of parse_url on our local sites hostname.  Eg: http://example.com/
     *
     * @var array
     */
    private $localUrl;

    private $logger;

    /**
     * @param baxe_App_Abstract $app
     */
    public function __construct(baxe_App_Abstract $app) {
        $this->app      = $app;
        $this->localUrl = parse_url($this->app->getConfig()->config['site.host']);
        $this->logger   = $app->getLogger();
    }

    /**
     * Use this to send pingback notices to external sites
     *
     * @param Blog_Post_VO $post
     */
    public function send(Blog_Post_VO $post) {
        $this->logger->debug("sending pingback for post {$post->postId}");

        $base = $this->app->getConfig()->config['site.host'];

        // loop through all found links.  ignore links that belong to this site
        foreach ($this->getLinksFromHtml($post->copy) as $link) {
            /* @var $link DOMElement */
            $href       = $link->getAttribute('href');
            $parsedUrl  = parse_url($href);

            $this->logger->debug(sprintf(
                "href(%s) label(%s) \n", $link->getAttribute('href'), $link->nodeValue
            ));

            if (!strlen($href) ||
                !isset($parsedUrl['host']) ||
                $parsedUrl['host'] == $this->localUrl['host']
            ) {
                $this->logger->debug("pingback ignoring {$href}");
                continue;
            }

            $source = $base . $post->getPermalink();
            $this->sendPingbackToRemote($href, $source);
        }
    }

    /**
     * Notify a remote server that we want to link w/ them
     *
     * @param string $remoteUrl Remote url to link to
     * @param string $self      Local url we're linking from
     * @return bool
     */
    private function sendPingbackToRemote($remoteUrl, $source) {
        $this->logger->debug("trying to pingback {$remoteUrl} with {$source}");

        try {
            $pingbackUrl = $this->discoverPingbackUrl($remoteUrl);
        } catch (Exception $e) {
            $this->logger->debug("remote url {$remoteUrl} does not seem to support pingbacks");
            return;
        }

        $this->logger->debug("discovered pingback url {$pingbackUrl}");

        $data = sprintf(
            '<?xml version="1.0"?><methodCall><methodName>pingback.ping</methodName><params><param><value><string>%s</string></value></param><param><value><string>%s</string></value></param></params></methodCall>',
            $source,
            $remoteUrl
        );
        $ch = curl_init();

        $this->logger->debug(sprintf("sending pingback: [%s]", $data));

        curl_setopt($ch, CURLOPT_VERBOSE, true);

        curl_setopt($ch, CURLOPT_URL, $pingbackUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $result = curl_exec($ch);
        if (false === $result) {
            return false;
        }

        // TODO parse pingback result of success or fail and save so we dont keep spamming people

        $this->logger->debug("pingback result: [%s]", (string)$result);
        return true;
    }

    /**
     * to send a pingback first we have to send a request to the remote url
     * to see if they have a x-pingback or a meta tag indicating the
     * pingback url.  if not, exit
     *
     * send another remote request to their pingback with the pingback.ping
     * xmlrpc call.
     */
    private function discoverPingbackUrl($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD');
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $result = curl_exec($ch);
        if (strlen($result) &&
            preg_match('/X-Pingback: (.+?)\s/', $result, $m) // stolen from wordcraft @TODO make my own
        ) {
            return $m[1];
        }

        throw new Exception("Unable to discover pingback url.");
    }

    /**
     * This is used to receive pingbacks towards our blog from external sites.
     *
     * @return unknown_type
     */
    public function receive() {

    }

    /**
     * @param string $html
     * @return DOMNodeList<DOMElement>
     */
    public function getLinksFromHtml($html) {
        libxml_use_internal_errors(true);
        $d = DOMDocument::loadHTML($html);
        libxml_clear_errors();
        return $d->getElementsByTagName('a');
    }

}
