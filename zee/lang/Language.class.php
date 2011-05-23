<?php
abstract class Language {
  static public function content($code) {
    $languageContentService = new LanguageContentService();
    $languageContentVo = $languageContentService->getByLangIdAndCode(Zee::getCurrentLanguageId(), $code);
    if (Config::LANG_EDIT_MODE) {
      if ($languageContentVo instanceof LanguageContentValue) {
        $displayString = $languageContentVo->content;
      }
      $displayString = $code;
      $outHTML = "<a href=\"javascript:void(0);\" onclick=\"window.open ('lang.php?code={$code}', 'modifiy_languages', 'height=450, width=650, top=150, left=250, toolbar=no, menubar=no, scrollbars=no, resizable=yes, location=no, status=no')\">{$displayString}</a>";
      return $outHTML;
    }
    if ($languageContentVo instanceof LanguageContentValue) {
      return $languageContentVo->content;
    }
    return $code;
  }
  static public function show($code) {
    echo self::content($code);
  }
  static public function get($code) {
    return self::content($code);
  }
}