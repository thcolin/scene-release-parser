<?php

  namespace thcolin\SceneReleaseParser;

  use InvalidArgumentException;

  class Release{

    const MOVIE = 'movie';
    const TVSHOW = 'tvshow';

    const ORIGINAL_RELEASE = 1;
    const GENERATED_RELEASE = 2;

    const SOURCE = 'source';
    const SOURCE_DVDRIP = 'DVDRip';
    const SOURCE_DVDSCR = 'DVDScr';
    const SOURCE_WEB_DL = 'WEB-DL';
    const SOURCE_BRRIP = 'BRRip';
    const SOURCE_BDRIP = 'BDRip';
    const SOURCE_DVD_R = 'DVD-R';
    const SOURCE_R5 = 'R5';
    const SOURCE_HDRIP = 'HDRip';
    const SOURCE_BLURAY = 'BLURAY';
    const SOURCE_PDTV = 'PDTV';
    const SOURCE_SDTV = 'SDTV';

    const ENCODING = 'encoding';
    const ENCODING_XVID = 'XviD';
    const ENCODING_DIVX = 'DivX';
    const ENCODING_X264 = 'x264';
    const ENCODING_X265 = 'x265';
    const ENCODING_H264 = 'h264';

    const RESOLUTION = 'resolution';
    const RESOLUTION_SD = 'SD';
    const RESOLUTION_720P = '720p';
    const RESOLUTION_1080P = '1080p';

    const DUB = 'dub';
    const DUB_DUBBED = 'DUBBED';
    const DUB_AC3 = 'AC3';
    const DUB_MD = 'MD';
    const DUB_LD = 'LD';

    const LANGUAGE_MULTI = 'MULTI';
    const LANGUAGE_DEFAULT = 'VO';

    public static $sourceStatic = [
      self::SOURCE_DVDRIP => [
        'dvdrip',
        'dvd-rip'
      ],
      self::SOURCE_DVDSCR => [
        'dvdscr',
        'dvd-scr',
        'dvdscreener'
      ],
      self::SOURCE_WEB_DL => [
        'webtv',
        'web-tv',
        'webdl',
        'web-dl',
        'webrip',
        'webhd',
        'web'
      ],
      self::SOURCE_BRRIP => [
        'brrip',
        'br-rip'
      ],
      self::SOURCE_BDRIP => [
        'bdrip',
        'bd-rip'
      ],
      self::SOURCE_DVD_R => [
        'dvd',
        'dvd-r'
      ],
      self::SOURCE_R5 => [
        'r5'
      ],
      self::SOURCE_HDRIP => [
        'hdtv',
        'hdtvrip',
        'hdtv-rip',
        'hdrip',
        'hdlight',
        'mhd',
        'hd'
      ],
      self::SOURCE_BLURAY => [
        'bluray',
        'blu-ray'
      ],
      self::SOURCE_PDTV => [
        'pdtv'
      ],
      self::SOURCE_SDTV => [
        'sdtv'
      ]
    ];

    public static $encodingStatic = [
      self::ENCODING_DIVX => [
        'divx'
      ],
      self::ENCODING_XVID => [
        'xvid'
      ],
      self::ENCODING_X264 => [
        'x264',
        'x.264'
      ],
      self::ENCODING_X265 => [
        'x265',
        'x.265'
      ],
      self::ENCODING_H264 => [
        'h264',
        'h.264'
      ]
    ];

    public static $resolutionStatic = [
      self::RESOLUTION_SD => [
        'sd'
      ],
      self::RESOLUTION_720P => [
        '720p'
      ],
      self::RESOLUTION_1080P => [
        '1080p'
      ]
    ];

    public static $dubStatic = [
      self::DUB_DUBBED => [
        'dubbed'
      ],
      self::DUB_AC3 => [
        'ac3.dubbed',
        'ac3'
      ],
      self::DUB_MD => [
        'md',
        'microdubbed',
        'micro-dubbed'
      ],
      self::DUB_LD => [
        'ld',
        'linedubbed',
        'line-dubbed'
      ]
    ];

    public static $languageStatic = [
      'FRENCH' => [
        'FRENCH',
        'Français',
        'Francais',
        'FR'
      ],
      'TRUEFRENCH' => [
        'TRUEFRENCH',
        'VFF'
      ],
      'VFQ' => 'VFQ',
      'VOSTFR' => [
        'STFR',
        'VOSTFR',
      ],
      'PERSIAN' => 'PERSIAN',
      'AMHARIC' => 'AMHARIC',
      'ARABIC' => 'ARABIC',
      'CAMBODIAN' => 'CAMBODIAN',
      'CHINESE' => 'CHINESE',
      'CREOLE' => 'CREOLE',
      'DANISH' => 'DANISH',
      'DUTCH' => 'DUTCH',
      'ENGLISH' => [
        'ENGLISH',
        'EN',
        'VOA'
      ],
      'ESTONIAN' => 'ESTONIAN',
      'FILIPINO' => 'FILIPINO',
      'FINNISH' => 'FINNISH',
      'FLEMISH' => 'FLEMISH',
      'GERMAN' => 'GERMAN',
      'GREEK' => 'GREEK',
      'HEBREW' => 'HEBREW',
      'INDONESIAN' => 'INDONESIAN',
      'IRISH' => 'IRISH',
      'ITALIAN' => 'ITALIAN',
      'JAPANESE' => 'JAPANESE',
      'KOREAN' => 'KOREAN',
      'LAOTIAN' => 'LAOTIAN',
      'LATVIAN' => 'LATVIAN',
      'LITHUANIAN' => 'LITHUANIAN',
      'MALAY' => 'MALAY',
      'MALAYSIAN' => 'MALAYSIAN',
      'MAORI' => 'MAORI',
      'NORWEGIAN' => 'NORWEGIAN',
      'PASHTO' => 'PASHTO',
      'POLISH' => 'POLISH',
      'PORTUGUESE' => 'PORTUGUESE',
      'ROMANIAN' => 'ROMANIAN',
      'RUSSIAN' => 'RUSSIAN',
      'SPANISH' => 'SPANISH',
      'SWAHILI' => 'SWAHILI',
      'SWEDISH' => 'SWEDISH',
      'SWISS' => 'SWISS',
      'TAGALOG' => 'TAGALOG',
      'TAJIK' => 'TAJIK',
      'THAI' => 'THAI',
      'TURKISH' => 'TURKISH',
      'UKRAINIAN' => 'UKRAINIAN',
      'VIETNAMESE' => 'VIETNAMESE',
      'WELSH' => 'WELSH',
       self::LANGUAGE_MULTI => 'MULTI'
    ];

    public static $flagsStatic = [
      'PROPER' => 'PROPER',
      'FASTSUB' => 'FASTSUB',
      'LIMITED' => 'LIMITED',
      'SUBFRENCH' => 'SUBFRENCH',
      'SUBFORCED' => 'SUBFORCED',
      'LIMITED' => 'LIMITED',
      'EXTENDED' => 'EXTENDED',
      'THEATRICAL' => 'THEATRICAL',
      'WORKPRINT' => 'WORKPRINT',
      'FANSUB' => 'FANSUB',
      'REPACK' => 'REPACK',
      'UNRATED' => 'UNRATED',
      'NFOFIX' => 'NFOFIX',
      'NTSC' => 'NTSC',
      'PAL' => 'PAL',
      'INTERNAL' => 'INTERNAL',
      'FESTIVAL' => 'FESTIVAL',
      'STV' => 'STV',
      'LIMITED' => 'LIMITED',
      'RERIP' => 'RERIP',
      'RETAIL' => 'RETAIL',
      'REMASTERED' => 'REMASTERED',
      'UNRATED' => 'UNRATED',
      'RATED' => 'RATED',
      'CHRONO' => 'CHRONO',
      'HDLIGHT' => 'HDLIGHT',
      'UNCUT' => 'UNCUT',
      'UNCENSORED' => 'UNCENSORED',
      'DUBBED' => 'DUBBED',
      'SUBBED' => 'SUBBED',
      'REMUX' => 'REMUX',
      'DUAL' => 'DUAL',
      'FINAL' => 'FINAL',
      'COLORIZED' => 'COLORIZED',
      'DOLBY DIGITAL' => 'DOLBY DIGITAL',
      'DTS' => 'DTS',
      'AAC' => 'AAC',
      'DTS-HD' => 'DTS-HD',
      'DTS-MA' => 'DTS-MA',
      'TRUEHD' => 'TRUEHD',
      '3D' => '3D',
      'HSBS' => 'HSBS',
      'DOC' => 'DOC',
      'RERIP' => [
        'rerip',
        're-rip'
      ],
      'DD5.1' => [
        'dd5.1',
        'dd51',
        'dd5-1',
        '5.1',
        '5-1'
      ],
      'READNFO' => [
        'READ.NFO',
        'READ-NFO',
        'READNFO'
      ]
    ];

    protected $release = null;
    protected $type = null;
    protected $title = null;
    protected $year = 0;
    protected $language = null;
    protected $resolution = null;
    protected $source = null;
    protected $dub = null;
    protected $encoding = null;
    protected $group = null;
    protected $flags = [];

    protected $season = 0;
    protected $episode = 0;

    public function __construct($name){
      // CLEAN
      $cleaned = $this -> clean($name);

      $this -> original = $name;
      $this -> release = $cleaned;
      $title = $cleaned;

      // LANGUAGE
      $language = $this -> parseLanguage($title);
      $this -> setLanguage($language);

      // SOURCE
      $source = $this -> parseSource($title);
      $this -> setSource($source);

      // ENCODING
      $encoding = $this -> parseEncoding($title);
      $this -> setEncoding($encoding);

      // RESOLUTION
      $resolution = $this -> parseResolution($title);
      $this -> setResolution($resolution);

      // DUB
      $dub = $this -> parseDub($title);
      $this -> setDub($dub);

      // YEAR
      $year = $this -> parseYear($title);
      $this -> setYear($year);

      // FLAGS
      $flags = $this -> parseFlags($title);
      $this -> setFlags($flags);

      // TYPE
      $type = $this -> parseType($title);
      $this -> setType($type);

      // GROUP
      $group = $this -> parseGroup($title);
      $this -> setGroup($group);

      // TITLE
      $title = $this -> parseTitle($title);
      $this -> setTitle($title);
    }

    public function __toString(){
      $arrays = [];
      foreach([
        $this -> getTitle(),
        $this -> getYear(),
        ($this -> getSeason() ? 'S'.sprintf('%02d', $this -> getSeason()):'').
        ($this -> getEpisode() ? 'E'.sprintf('%02d', $this -> getEpisode()):''),
        $this -> getLanguage(),
        $this -> getResolution(),
        $this -> getSource(),
        $this -> getEncoding(),
        $this -> getDub()
      ] as $array){
        if(is_array($array)){
          $arrays[] = implode('.', $array);
        } else if($array){
          $arrays[] = $array;
        }
      }
      return preg_replace('#\s+#', '.', implode('.', $arrays)).'-'.($this -> getGroup() ? $this -> getGroup():'NOTEAM');
    }

    public function getRelease($mode = self::ORIGINAL_RELEASE){
      switch($mode){
        case self::GENERATED_RELEASE:
          return $this -> __toString();
        break;
        default:
          return $this -> release;
        break;
      }
    }

    private function clean($name){
      $release = str_replace(['[', ']', '(', ')', ',', ';', ':', '!'], ' ', $name);
      $release = preg_replace('#[\s]+#', ' ', $release);
      $release = str_replace(' ', '.', $release);

      return $release;
    }

    public function guess(){
      $release = $this;
      
      if(!isset($release -> year)){
        $release -> setYear($release -> guessYear());
      }

      if(!isset($release -> resolution)){
        $release -> setResolution($release -> guessResolution());
      }

      if(!isset($release -> language)){
        $release -> setLanguage($release -> guessLanguage());
      }

      return $release;
    }

    private function parseAttribute(&$title, $attribute){
      if(!in_array($attribute, [self::SOURCE, self::ENCODING, self::RESOLUTION, self::DUB])){
        throw new InvalidArgumentException();
      }

      $attributes = $attribute.'Static';

      foreach(Release::$$attributes as $key => $patterns){
        if(!is_array($patterns)){
          $patterns = [$patterns];
        }

        foreach($patterns as $pattern){
          $title = preg_replace('#[\.|\-]'.preg_quote($pattern).'([\.|\-]|$)#i', '$1', $title, 1, $replacements);
          if($replacements > 0){
            return $key;
          }
        }
      }

      return null;
    }

    public function getType(){
      return $this -> type;
    }

    private function parseType(&$title){
      $type = null;

      $title = preg_replace_callback('#[\.\-]S(\d+)[\.\-]?(E(\d+))?([\.\-])#i', function($matches) use (&$type){
        $type = self::TVSHOW;
        // 01 -> 1 (numeric)
        $this -> setSeason(intval($matches[1]));

        if($matches[3]){
          $this -> setEpisode(intval($matches[3]));
        }
        return $matches[4];
      }, $title, 1, $count);

      if($count == 0){
        // Not a Release
        if(
          !isset($this -> resolution) &&
          !isset($this -> source) &&
          !isset($this -> dub) &&
          !isset($this -> encoding)
        ){
          throw new InvalidArgumentException('This is not a correct Scene Release name');
        }

        // movie
        $type = self::MOVIE;
      }

      return $type;
    }

    public function setType($type){
      $this -> type = $type;
    }

    public function getTitle(){
      return $this -> title;
    }

    private function parseTitle(&$title){
      $array = [];
      $return = '';
      $title = preg_replace('#\.?\-\.#', '.', $title);
      $title = preg_replace('#\(.*?\)#', '', $title);
      $title = preg_replace('#\.+#', '.', $title);
      $positions = explode('.', $this -> release);

      foreach(array_intersect($positions, explode('.', $title)) as $key => $value){
        $last = isset($last) ? $last:0;

        if($key - $last > 1){
          $return = implode(' ', $array);
          break;
        }

        $array[] = $value;
        $return = implode(' ', $array);
        $last = $key;
      }

      $return = ucwords(strtolower($return));
      $return = trim($return);

      return $return;
    }

    public function setTitle($title){
      $this -> title = $title;
    }

    public function getSeason(){
      return $this -> season;
    }

    public function setSeason($season){
      $this -> season = $season;
    }

    public function getEpisode(){
      return $this -> episode;
    }

    public function setEpisode($episode){
      $this -> episode = $episode;
    }

    public function getLanguage(){
      return $this -> language;
    }

    private function parseLanguage(&$title){
      $languages = [];

      foreach(Release::$languageStatic as $langue => $patterns){
        if(!is_array($patterns)){
          $patterns = [$patterns];
        }

        foreach($patterns as $pattern){
          $title = preg_replace('#[\.|\-]'.preg_quote($pattern).'([\.|\-]|$)#i', '$1', $title, 1, $replacements);
          if($replacements > 0){
            $languages[] = $langue;
            break;
          }
        }
      }

      if(count($languages) == 1){
        return $languages[0];
      } else if(count($languages) > 1){
        return self::LANGUAGE_MULTI;
      } else{
        return null;
      }
    }

    public function guessLanguage(){
      return self::LANGUAGE_DEFAULT;
    }

    public function setLanguage($language){
      $this -> language = $language;
    }

    public function getResolution(){
      return $this -> resolution;
    }

    private function parseResolution(&$title){
      return $this -> parseAttribute($title, self::RESOLUTION);
    }

    public function guessResolution(){
      return 'SD';
    }

    public function setResolution($resolution){
      $this -> resolution = $resolution;
    }

    public function getSource(){
      return $this -> source;
    }

    private function parseSource(&$title){
      return $this -> parseAttribute($title, self::SOURCE);
    }

    public function setSource($source){
      $this -> source = $source;
    }

    public function getDub(){
      return $this -> dub;
    }

    private function parseDub(&$title){
      return $this -> parseAttribute($title, self::DUB);
    }

    public function setDub($dub){
      $this -> dub = $dub;
    }

    public function getEncoding(){
      return $this -> encoding;
    }

    private function parseEncoding(&$title){
      return $this -> parseAttribute($title, self::ENCODING);
    }

    public function setEncoding($encoding){
      $this -> encoding = $encoding;
    }

    public function getYear(){
      return $this -> year;
    }

    private function parseYear(&$title){
      $year = null;

      $title = preg_replace_callback('#[\.|\-](\d{4})([\.|\-])?#', function($matches) use (&$year){
        if(isset($matches[1])){
          $year = $matches[1];
        }

        return (isset($matches[2]) ? $matches[2]:'');
      }, $title, 1);

      return $year;
    }

    public function guessYear(){
      return date('Y');
    }

    public function setYear($year){
      $this -> year = $year;
    }

    public function getGroup(){
      return $this -> group;
    }

    private function parseGroup(&$title){
      $group = null;

      $title = preg_replace_callback('#\-([a-zA-Z0-9_\.]+)$#', function($matches) use (&$group){
        if(strlen($matches[1]) > 12){
          preg_match('#(\w+)#', $matches[1], $matches);
        }

        $group = preg_replace('#^\.+|\.+$#', '', $matches[1]);
        return '';
      }, $title);

      return $group;
    }

    public function setGroup($group){
      $this -> group = $group;
    }

    public function getFlags(){
      return $this -> flags;
    }

    private function parseFlags(&$title){
      $flags = [];

      foreach(Release::$flagsStatic as $key => $patterns){
        if(!is_array($patterns)){
          $patterns = [$patterns];
        }

        foreach($patterns as $pattern){
          $title = preg_replace('#[\.|\-]'.preg_quote($pattern).'([\.|\-]|$)#i', '$1', $title, 1, $replacements);
          if($replacements > 0){
            $flags[] = $key;
          }
        }
      }

      return $flags;
    }

    public function setFlags($flags){
      $this -> flags = (is_array($flags) ? $flags:[$flags]);
    }

    public function getScore(){
      $score = 0;

      $score += ($this -> getTitle() ? 1:0);
      $score += ($this -> getYear() ? 1:0);
      $score += ($this -> getLanguage() ? 1:0);
      $score += ($this -> getResolution() ? 1:0);
      $score += ($this -> getSource() ? 1:0);
      $score += ($this -> getEncoding() ? 1:0);
      $score += ($this -> getDub() ? 1:0);

      return $score;
    }

  }

?>
