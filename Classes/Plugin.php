<?php
/**
 * Plugin class
 */

namespace Phile\Plugin\An7\MetaList;

use Phile\Gateway\EventObserverInterface;
use Phile\Plugin\AbstractPlugin;
use Phile\Exception;

/**
  * MetaList
  * version 0.5 modified 2020.12.12
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

class Plugin extends AbstractPlugin implements EventObserverInterface
{

	protected $events = ['after_read_file_meta' => 'processMeta'];

	protected function processMeta($data)
	{
		$metatags = explode(',', $this->settings['meta_tags']);

		foreach($metatags as $metatag) {
			if (isset($data['meta'][$metatag])) { // If this specific metatag exists
				$data['meta'][$metatag] = $this->filter_content($data['meta'][$metatag], $metatag); // Split it at the commas and wrap each element as a list item
			}
		}
	}

	private function filter_content($content, $title) {
		if (!isset($content)) return null; // return nothing if no content is available for processing

		if ($this->settings['title_element']) $title = ucfirst($title);
		$title .= $this->settings['title_character'];

		$list = '<'.$this->settings['title_element'].' class="'.$this->settings['title_class'].'">'.$title.'</'.$this->settings['title_element'].'>';
		$items = explode(',', $content);
		foreach($items as $item) {
			$list .= '<li class="'.$this->settings['item_class'].'">'.$item.'</li>';
		}

		$content = '<'.$this->settings['list_element'].' class="'.$this->settings['list_class'].'">'.$list.'</'.$this->settings['list_element'].'>';

		return $content; // return processed data
	}
}
