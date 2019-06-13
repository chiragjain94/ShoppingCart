<?php


class View
{
  private static $instance;
  private static $twig;

  public static function initializeTwig($template = "\..\\views") //  '\..\'.'views'
  {
    if (!isset(self::$instance)) {
      self::$instance = new View();
      self::$instance->initTwig($template);
    }
    return self::$instance;
  }

  private function initTwig($template)
  {
    $loader = new Twig_Loader_Filesystem(__DIR__ . $template);
    self::$twig = new Twig_Environment($loader, ['debug' => true]);
    self::$twig->addExtension(new \Twig\Extension\DebugExtension());
    $twig = new \Twig\Environment($loader);
  }

  public static function getTwig()
  {
    if (empty(self::$instance)) {
      throw new Exception("Please init View");
    }
    return self::$twig;
  }
}
