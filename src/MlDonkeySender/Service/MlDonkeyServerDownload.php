<?php


namespace MlDonkeySender\MlDonkeySender\Service;


use MlDonkeySender\MlDonkeySender\Data\MlDonkeyServerData;
use Curl\Curl;

class MlDonkeyServerDownload
{
    private MlDonkeyServerData $mldonkeyServerData;

    /**
     * UserMldonkeyAuth constructor.
     *
     * @param MlDonkeyServerData $mldonkeyServerData
     */
    public function __construct(MlDonkeyServerData $mldonkeyServerData)
    {
        $this->mldonkeyServerData = $mldonkeyServerData;
    }

    /**
     * Download ed2kLinks.
     *
     * @param array $ed2kLinks
     */
    public function download(array $ed2kLinks)
    {
        $url = 'http://'.$this->mldonkeyServerData->ip;
        $url .= ':'.$this->mldonkeyServerData->port.'/submit?q=';

        $curl = new Curl();
        $curl->setBasicAuthentication($this->mldonkeyServerData->username, $this->mldonkeyServerData->password);
        foreach ($ed2kLinks as $ed2kLink) {
            $curl->get($url.urlencode($ed2kLink));
        }
        $curl->close();
    }
}