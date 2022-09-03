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
					$data['meta'][$metatag] = $this->filter_content($data['meta'][$metatag], $metatag); // Split it at the commas and wrap each element as a list item
				}
			}
		}
	}

	private function filter_content($content, $title) {
		if (!isset($content)) return null; // return nothing if no content is available for processing

		$list = '<'.$this->settings['wrap_element'].' class="'.$this->settings['wrap_class'].'">'; // Initial opening of the list group
		$list .= '<'.$this->settings['title_element'].' class="'.$this->settings['title_class'].'">'.$title.'</'.$this->settings['title_element'].'>'; // Adding a title element to the list using the metatag name

		$items = explode(',', $content); // Create array of items to be added to the list
		foreach($items as $item) {
			$list .= '<li class="'.$this->settings['item_class'].'>'.$item.'</li>'; // Add the items to the list
		}

		$list = '</'.$this->settings['wrap_element'].'>'; // Close out the list group

		return $list; // return processed data
	}
}
