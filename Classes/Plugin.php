<?php
/**
 * Plugin class
 */

namespace Phile\Plugin\An7\MetaList;
use Phile\Exception;

/**
  * MetaList
  * version 0.1 modified 2019.09.07
  *
  * Meta tags:
  * 	"tools" = commas converted into list items
  * 	"team" = commas converted into list items
  *
  * @author		John Einselen
  * @link		http://iaian7.com
  * @license	http://opensource.org/licenses/MIT
  * @package	Phile\Plugin\An7\MetaList
  *
  */

class Plugin extends \Phile\Plugin\AbstractPlugin implements \Phile\Gateway\EventObserverInterface {

	public function __construct() {
		\Phile\Event::registerEvent('after_read_file_meta', $this); // May want to use this instead of changing the raw content, should be safer and allows creation of new meta data.
	}

	public function on($eventKey, $data = null) {
		if ($eventKey == 'after_read_file_meta') { // If preview or media meta data exists, start processing!
			$metatags = explode(',', $this->settings['meta_tags']);

			foreach($metatags as $metatag) {
				if (isset($data['meta'][$metatag])) { // If this specific metatag exists
					$data['meta'][$metatag] = $this->filter_content($data['meta'][$metatag]); // Split it at the commas and wrap each element as a list item
				}
			}
		}
	}

	private function filter_content($content) {
		if (!isset($content)) return null; // return nothing if no content is available for processing

		$list = '';
		$items = explode(',', $content);
		foreach($items as $item) {
			$list = $list.'<li>'.$item.'</li>';
		}

		$content = '<'.$this->settings['wrap_element'].' class="'.$this->settings['wrap_class'].'">'.$list.'</'.$this->settings['wrap_element'].'>';
		return $content; // return processed data
	}
}