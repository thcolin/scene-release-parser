<?php

  use thcolin\SceneReleaseParser\Release;
  use PHPUnit\Framework\TestCase;
  use PHPUnit\Framework\Error\Notice;
  use PHPUnit\Framework\Error\Error;

  class ReleaseTest extends TestCase{

    public static function setUpBeforeClass(){
      if(PHP_OS === 'Darwin'){
        define('__MEDIAINFO_BIN__', '/usr/local/bin/mediainfo');
      } else{
        define('__MEDIAINFO_BIN__', '/usr/bin/mediainfo');
      }
    }

    public function setUp(){
      $json = file_get_contents(__DIR__.'/../utils/releases.json');
      $array = json_decode($json, true);

      foreach($array as $key => $element){
        $element['object'] = new Release($key);
        $this -> elements[] = $element;
      }
    }

    public function testAnalyseSuccess(){
      $elements = [
        'https://www.quirksmode.org/html5/videos/big_buck_bunny.mp4' => [
          'encoding' => Release::ENCODING_H264,
          'resolution' => Release::RESOLUTION_SD,
          'language' => 'ENGLISH'
        ],
        'https://samples.mplayerhq.hu/V-codecs/h264/bbc-africa_m720p.mov' => [
          'encoding' => Release::ENCODING_H264,
          'resolution' => Release::RESOLUTION_720P,
          'language' => 'ENGLISH'
        ],
        'https://cinelerra-cv.org/footage/rassegna2.avi' => [
          'encoding' => Release::ENCODING_DIVX,
          'resolution' => Release::RESOLUTION_SD,
          'language' => 'VO'
        ],
        'https://samples.mplayerhq.hu/V-codecs/XVID/old/green.avi' => [
          'encoding' => Release::ENCODING_XVID,
          'resolution' => Release::RESOLUTION_SD,
          'language' => 'VO'
        ],
        'http://samples.mplayerhq.hu/Matroska/x264_no-b-frames.mkv' => [
          'encoding' => Release::ENCODING_X264,
          'resolution' => Release::RESOLUTION_720P,
          'language' => 'VO'
        ],
        'https://s3.amazonaws.com/x265.org/video/Tears_400_x265.mp4' => [
          'encoding' => Release::ENCODING_X265,
          'resolution' => Release::RESOLUTION_1080P,
          'language' => 'VO'
        ],
      ];

      foreach($elements as $url => $element){
        $basename = basename($url);

        if(!is_dir(__DIR__.'/tmp/')){
          mkdir(__DIR__.'/tmp/');
        }

        if(!is_file(__DIR__.'/tmp/'.$basename)){
          file_put_contents(__DIR__.'/tmp/'.$basename, fopen($url, 'r'));
        }

        $config = [];

        if(defined('__MEDIAINFO_BIN__')){
          $config['command'] = __MEDIAINFO_BIN__;
        }

        $release = Release::analyse(__DIR__.'/tmp/'.$basename, $config);

        $this -> assertEquals($element['encoding'], $release -> getEncoding(), $url);
        $this -> assertEquals($element['resolution'], $release -> getResolution(), $url);
        $this -> assertEquals($element['language'], $release -> getLanguage(), $url);
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

    public function testConstructStrictFail(){
      $this -> expectException(InvalidArgumentException::class);
      $release = new Release('This is not a good scene release name');
    }

    public function testConstructStrictSuccess(){
      $release = new Release('This is not a good scene release name', false);
      $this->assertInstanceOf('thcolin\SceneReleaseParser\Release', $release);
    }

    public function testConstructDefaultsSuccess(){
      $release = new Release('This is not a good scene release name', false, ['language' => 'FRENCH']);
      $this -> assertEquals($release -> guessLanguage(), 'FRENCH');
    }

    public function testConstructDefaultsNotice(){
      $this -> expectException(Notice::class);
      $release = new Release('This is not a good scene release name', false, ['language' => 'UNKNOWN']);
    }

  }

?>
