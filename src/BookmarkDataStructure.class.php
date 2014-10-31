<?php
class BookmarkDataStructure {
  private $structure = array();
  private $timestamp;
  private $notes;





  public function __construct($timestamp) {
    $this->timestamp = $timestamp;
  }





  public function addBookmark($name, $hyperlink, $description, $tags, $isFeed = false) {
    $bookmark = array();
    $bookmark['name'] = $name;
    $bookmark['hyperlink'] = $hyperlink;
    $bookmark['description'] = $description;
    $bookmark['tags'] = $tags;
    $bookmark['isFeed'] = $isFeed;
    $this->structure []= $bookmark;
  }





  public function addNotes($notes) {
    $this->notes = $notes;
  }





  public function renderHTML() {
    $result = '';

    foreach ($this->notes as $index => $note) {
      $result .= '<li class="unsaved"><div class="title">Unsaved bookmark</div><div class="description">' . $note . '</div></li>' . "\n";
    }

    foreach ($this->structure as $item) {

      $result .= '<li' . ($item['isFeed'] ? ' class="feed"' : '') . '>' . "\n";
      $result .= '  <div class="title">' .  $item['name'] . "</div>\n";
      $result .= '  <div class="hyperlink"><a href="' . $item['hyperlink'] . '"  class="newtabbablehref" target="_blank">' . $item['hyperlink'] . "</a></div>\n";
      $result .= '  <ul class="tags">' . "\n";
      if (count($item['tags']) > 0) {
        foreach ($item['tags'] as $tag) {
          $result .= '    <li class="tag">' . $tag . "</li>\n";
        }
      }
      $result .= "  </ul>\n";
      $result .= '  <div class="description">' . $item['description'] . "</div>\n";
      $result .= "</li>\n";
    }
    return $result;
  }





  public function getTimestamp() {
    return strftime('%c', $this->timestamp);
  }
}
?>
