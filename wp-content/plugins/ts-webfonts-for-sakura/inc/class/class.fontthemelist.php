<?php

class TypeSquare_ST_Fontthemelist {
  private static $instance;

	private function __construct(){}

  public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			$c = __CLASS__;
			self::$instance = new $c();
		}
		return self::$instance;
	}

  public function get_fonttheme_list()
    {
      return array(
        "basic" => [
          "name" => "ベーシック",
          "fonts" => [
            "title" => "見出ゴMB31",
            "lead" => "カクミン R",
            "content" => "新ゴ R",
            "bold" => "新ゴ M"
          ]
        ],
        "news" => [
          "name" => "ニュース",
          "fonts" => [
            "title" => "ゴシックMB101 B",
            "lead" => "カクミン R",
            "content" => "UD新ゴ R",
            "bold" => "UD新ゴ M"
          ]
        ],
        "fashion" => [
          "name" => "ファッション",
          "fonts" => [
            "title" => "解ミン 宙 B",
            "lead" => "丸フォーク M",
            "content" => "フォーク R",
            "bold" => "フォーク M"
          ]
        ],
        "pop" => [
          "name" => "ポップ",
          "fonts" => [
            "title" => "新丸ゴ 太ライン",
            "lead" => "はるひ学園",
            "content" => "じゅん 201",
            "bold" => "じゅん 501"
          ]
        ],
        "japan_style" => [
          "name" => "和風",
          "fonts" => [
            "title" => "隷書101",
            "lead" => "正楷書CB1",
            "content" => "リュウミン R-KL",
            "bold" => "リュウミン M-KL"
          ]
        ],
        "modern" => [
          "name" => "モダン",
          "fonts" => [
            "title" => "すずむし",
            "lead" => "トーキング",
            "content" => "ナウ-GM",
            "bold" => "ナウ-GM"
          ]
        ],
        "novels" => [
          "name" => "小説",
          "fonts" => [
            "title" => "見出ミンMA31",
            "lead" => "解ミン 宙 B",
            "content" => "A1明朝",
            "bold" => "A1明朝"
          ]
        ],
        "smartphone" => [
          "name" => "スマホ",
          "fonts" => [
            "title" => "UD新ゴ M",
            "lead" => "新丸ゴ R",
            "content" => "UD新ゴ コンデンス90 L",
            "bold" => "UD新ゴ コンデンス90 M"
          ]
        ],
        "retromodern" => [
          "name" => "レトロモダン",
          "fonts" => [
            "title" => "解ミン 宙 B",
            "lead" => "すずむし",
            "content" => "しまなみ JIS2004",
            "bold" => "リュウミン M-KL"
          ]
        ],
        "casual" => [
          "name" => "カジュアル",
          "fonts" => [
            "title" => "G2サンセリフ-B",
            "lead" => "フォーク M",
            "content" => "ヒラギノ丸ゴ W4 JIS2004",
            "bold" => "じゅん 501"
          ]
        ],
        "friendly" => [
          "name" => "フレンドリー",
          "fonts" => [
            "title" => "じゅん 501",
            "lead" => "トーキング",
            "content" => "UDデジタル教科書体 R JIS2004",
            "bold" => "じゅん 501"
          ]
        ]
      );
    }

  public function get_url()
    {
      return array(
        "file_domain" => "",
        "font_css" => "",
	      "font_json" => ""
      );
    }
}