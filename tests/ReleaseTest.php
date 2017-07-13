<?php

  use thcolin\SceneReleaseParser\Release;
  use PHPUnit\Framework\TestCase;

  class ReleaseTest extends TestCase {

    private $elements;

    public function setUp(){
      $json = file_get_contents(__DIR__.'/../utils/releases.json');
      $array = json_decode($json, true);

      foreach($array as $key => $element){
        $element['object'] = new Release($key);
        $this -> elements[] = $element;
      }
    }

    public function testGetType(){
      foreach($this -> elements as $element){
        $this -> assertEquals($element['type'], $element['object'] -> getType(), json_encode($element));
      }
    }

    public function testGetTitle(){
      foreach($this -> elements as $element){
        $this -> assertEquals($element['title'], $element['object'] -> getTitle(), json_encode($element));
      }
    }

    public function testGetGeneratedRelease(){
      foreach($this -> elements as $element){
        if(isset($element['generated'])){
          $this -> assertEquals($element['generated'], $element['object'] -> getRelease(Release::GENERATED_RELEASE), json_encode($element));
          $this -> assertEquals($element['generated'], $element['object'] -> __toString(), json_encode($element));
        }
      }
    }

    public function testGetOriginalRelease(){
      foreach($this -> elements as $element){
        if(isset($element['generated'])){
          $this -> assertEquals($element['original'], $element['object'] -> getRelease(), json_encode($element));
        }
      }
    }

    public function testGetYear(){
      foreach($this -> elements as $element){
        if(isset($element['year'])){
          $this -> assertEquals($element['year'], $element['object'] -> getYear(), json_encode($element));
        }
      }
    }

    public function testGetLanguage(){
      foreach($this -> elements as $element){
        if(isset($element['language'])){
          $this -> assertEquals($element['language'], $element['object'] -> getLanguage(), json_encode($element));
        }
      }
    }

    public function testGetResolution(){
      foreach($this -> elements as $element){
        if(isset($element['resolution'])){
          $this -> assertEquals($element['resolution'], $element['object'] -> getResolution(), json_encode($element));
        }
      }
    }

    public function testGetSource(){
      foreach($this -> elements as $element){
        if(isset($element['source'])){
          $this -> assertEquals($element['source'], $element['object'] -> getSource(), json_encode($element));
        }
      }
    }

    public function testGetDub(){
      foreach($this -> elements as $element){
        if(isset($element['dub'])){
          $this -> assertEquals($element['dub'], $element['object'] -> getDub(), json_encode($element));
        }
      }
    }

    public function testGetEncoding(){
      foreach($this -> elements as $element){
        if(isset($element['encoding'])){
          $this -> assertEquals($element['encoding'], $element['object'] -> getEncoding(), json_encode($element));
        }
      }
    }

    public function testGetGroup(){
      foreach($this -> elements as $element){
        if(isset($element['group'])){
          $this -> assertEquals($element['group'], $element['object'] -> getGroup(), json_encode($element));
        }
      }
    }

    public function testGetFlags(){
      foreach($this -> elements as $element){
        if(isset($element['flags'])){
          $this -> assertEquals($element['flags'], $element['object'] -> getFlags(), json_encode($element));
        }
      }
    }

    public function testGetSeason(){
      foreach($this -> elements as $element){
        if(isset($element['season'])){
          $this -> assertEquals($element['season'], $element['object'] -> getSeason(), json_encode($element));
        }
      }
    }

    public function testGetEpisode(){
      foreach($this -> elements as $element){
        if(isset($element['episode'])){
          $this -> assertEquals($element['episode'], $element['object'] -> getEpisode(), json_encode($element));
        }
      }
    }

    public function testGetScore(){
      foreach($this -> elements as $element){
        if(isset($element['score'])){
          $this -> assertEquals($element['score'], $element['object'] -> getScore(), json_encode($element));
        }
      }
    }

    public function testUnitGuess(){
      foreach($this -> elements as $element){
        if(isset($element['guess'])){
          foreach($element['guess'] as $guess => $value){
            switch($guess){
              case 'year':
                $this -> assertEquals(date('Y'), $element['object'] -> guessYear(), json_encode($element));
              break;
              case 'language':
                $this -> assertEquals($value, $element['object'] -> guessLanguage(), json_encode($element));
              break;
              case 'resolution':
                $this -> assertEquals($value, $element['object'] -> guessResolution(), json_encode($element));
              break;
            }
          }
        }
      }
    }

    public function testGlobalGuess(){
      foreach($this -> elements as $element){
        if(isset($element['guess'])){
          foreach($element['guess'] as $guess => $value){
            switch($guess){
              case 'year':
                $this -> assertEquals(null, $element['object'] -> getYear(), json_encode($element));
              break;
              case 'language':
                $this -> assertEquals(null, $element['object'] -> getLanguage(), json_encode($element));
              break;
              case 'resolution':
                $this -> assertEquals(null, $element['object'] -> getResolution(), json_encode($element));
              break;
            }
          }

          foreach($element['guess'] as $guess => $value){
            switch($guess){
              case 'year':
                $this -> assertEquals(date('Y'), $element['object'] -> guessYear(), json_encode($element));
                $this -> assertEquals(date('Y'), $element['object'] -> guess() -> getYear(), json_encode($element));
              break;
              case 'language':
                $this -> assertEquals($value, $element['object'] -> guessLanguage(), json_encode($element));
                $this -> assertEquals($value, $element['object'] -> guess() -> getLanguage(), json_encode($element));
              break;
              case 'resolution':
                $this -> assertEquals($value, $element['object'] -> guessResolution(), json_encode($element));
                $this -> assertEquals($value, $element['object'] -> guess() -> getResolution(), json_encode($element));
              break;
            }
          }
        }
      }
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructFail(){
      $release = new Release('This is not a good scene release name');
    }

  }

?>
