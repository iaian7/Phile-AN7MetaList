an7metaList
================

A plugin for [Phile](https://github.com/PhileCMS/Phile) that takes comma separated meta tags and turns them into HTML lists.

### 1.1 Installation (composer)
```
php composer.phar require an7/meta-list:*
```

### 1.2 Installation (Download)

* Install the latest version of [Phile](https://github.com/PhileCMS/Phile)
* Clone this repo into `plugins/an7/metaList`

### 2. Activation

After you have installed the plugin. You need to add the following line to your `config.php` file:

```
$config['plugins']['an7\\metaList'] = array('active' => true);
```

### Usage

Some example markdown input:

```markdown
Title: Page Title
Tools: Photoshop,Illustrator,Textastic,CSSedit
Template: post
```

With the following option set in your config:

```markdown
  'meta_tags' => 'tools'
```

This is what will be output:

```html
<ul>
  <li>Photoshop</li>
  <li>Illustrator</li>
  <li>Textastic</li>
  <li>CSSedit</li>
</ul>
```

### Config

This is the default `config.php` file. It explains what each key => value does.

```php
return array(
  'meta_tags' => 'list1,list2', // list of the meta tags that should be converted from comma separated into html lists
  'list_element' => 'ul', // this can be changed between 'ul' for unordered and 'ol' for ordered lists
  'list_class' => 'list', // the class applied to the list object
  'title_element' => 'h3', // this can be changed between 'ul' for unordered and 'ol' for ordered lists
  'title_class' => 'list_title', // the class applied to the header of the list object (auto populated using the metatag title)
  'title_case' => 'true', // metatags are always set to lowercase, so this will change the first letter back to uppercase if desired
  'title_character' => ':', // adds additional characters to the end of the list title
  'item_class' => 'list_item' // the class applied to the individual objects of the list object
);
```
