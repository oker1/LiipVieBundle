<?php

namespace Liip\VieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\View\ViewHandlerInterface,
    FOS\RestBundle\View\View;

/**
 * TODO this controller should eventually be removed
 * Or at most an example optional service using the FS could be offered
 *
 * Instead a REST API should be defined
 */
class AssetsController
{
    /**
     * @var FOS\RestBundle\View\ViewHandlerInterface
     */
    private $viewHandler;

    public function __construct(ViewHandlerInterface $viewHandler)
    {
        $this->viewHandler = $viewHandler;
    }

    /**
     * Search for assets matching the query
     *
     * This function currently only returns some fixture data to try the editor
     *
     */
    public function searchAction(Request $request)
    {
        $data = array(
            array(
                'url' => 'http://www.perfectoutdoorweddings.com/wp-content/uploads/2011/06/beach.jpg',
                'alt' => 'Crazy beach, but no girls'
            ),
            array(
                'url' => 'http://www.photosnewportbeach.com/artwork/newport-beach-sunset.jpg',
                'alt' => 'Sunset from my balconey'
            ),
            array(
                'url' => 'http://www.capetowndailyphoto.com/uploaded_images/Beach_Girl_IMG_3563-761741.jpg',
                'alt' => 'My sister in Capetown'
            ),
            array(
                'url' => 'http://news.fullorissa.com/wp-content/uploads/2011/06/PuriBeach.jpg',
                'alt' => 'New Dehli chatting'
            ),
            array(
                'url' => 'http://www.ouramazingplanet.com/images/stories/pattaya-beach-110201-02.jpg',
                'alt' => 'Amazing view from my plane'
            ),
            array(
                'url' => 'http://www.hotelplan.ch/CMS/1/1823506/4/ferien_auf_den_malediven.jpg',
            ),
            array(
                'url' => 'http://stuckincustoms.smugmug.com/Portfolio-The-Best/your-favorites/3410783929310572ed16o/742619149_CYkrj-750x750.jpg',
                'alt' => 'Blue mountains'
            ),
            array(
                'url' => 'http://media.smashingmagazine.com/images/fantastic-hdr-pictures/hdr-10.jpg',
                'alt' => 'Sun, Clouds, Stuff'
            ),
            array(
                'url' => 'http://farm3.static.flickr.com/2139/1524795919_62631ab870.jpg',
                'alt' => 'Two lone trees'
            ),
            array(
                'url' => 'http://www.bigpicture.in/wp-content/uploads/2010/12/HDR-Photography-By-Paul-21-660x494.jpg',
                'alt' => 'Bridge'
            )
        );

        $page = (int)$request->query->get('page', 1);
        if ($page < 1) {
            $page = 1;
        }

        $length = (int)$request->query->get('length', 8);
        if ($length < 1) {
            $length = 8;
        }

        $data = array(
            'page' => $page,
            'length' => $length,
            'total' => count($data),
            'assets' => array_slice($data, ($page-1)*$length, $length)
        );

        $view = View::create($data);
        return $this->viewHandler->handle($view);
    }
}
